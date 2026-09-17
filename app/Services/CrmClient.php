<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Запросы к CRM.
 *
 * Сайт не должен падать, если CRM недоступна. Поэтому каждый ответ
 * хранится в двух копиях: свежая живёт несколько минут, запасная —
 * без срока. Когда CRM не отвечает, отдаём запасную и какое-то время
 * не стучимся повторно, чтобы не тормозить каждую страницу.
 */
class CrmClient
{
    /** Пауза после неудачного запроса, секунды. */
    private const RETRY_AFTER = 60;

    public function enabled(): bool
    {
        return (bool) (config('crm.url') && config('crm.token'));
    }

    /** Данные из CRM с кэшем; null — если их нет ни свежих, ни запасных. */
    public function cached(string $path, array $query = []): ?array
    {
        if (!$this->enabled()) {
            return null;
        }

        $key = 'crm:' . md5($path . '?' . http_build_query($query));

        $fresh = Cache::get($key);
        if ($fresh !== null) {
            // Пустой массив — отметка «CRM недавно не ответила».
            return $fresh ?: null;
        }

        $data = $this->get($path, $query);
        $stale = Cache::get($key . ':stale');

        if ($data === null) {
            // Пока CRM лежит, отдаём последнее, что получили.
            Cache::put($key, $stale ?? [], self::RETRY_AFTER);

            return $stale;
        }

        Cache::put($key, $data, config('crm.ttl'));
        Cache::forever($key . ':stale', $data);

        return $data;
    }

    /** Отправить данные в CRM; false — если не получилось. */
    public function post(string $path, array $payload): bool
    {
        if (!$this->enabled()) {
            return false;
        }

        try {
            $this->request()->post($this->url($path), $payload)->throw();

            return true;
        } catch (Throwable $e) {
            Log::warning('CRM не приняла данные: ' . $e->getMessage(), ['path' => $path]);

            return false;
        }
    }

    private function get(string $path, array $query): ?array
    {
        try {
            return $this->request()->get($this->url($path), $query)->throw()->json();
        } catch (Throwable $e) {
            Log::warning('CRM не ответила: ' . $e->getMessage(), ['path' => $path]);

            return null;
        }
    }

    private function request()
    {
        return Http::timeout(config('crm.timeout'))
            ->acceptJson()
            ->withHeaders(['X-Site-Token' => config('crm.token')]);
    }

    private function url(string $path): string
    {
        return rtrim(config('crm.url'), '/') . '/' . ltrim($path, '/');
    }
}
