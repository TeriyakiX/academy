<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Приём и рассылка заявок с сайта.
 *
 * Один вход для всех форм: модалка, блок «Поможем выбрать курс», конструктор.
 * Каналы включаются в .env по отдельности — можно подключать по мере готовности.
 *
 * Как раньше: JS отправлял заявку прямо в Telegram, токен бота лежал
 * в /assets/send-form-telegram.js и был виден любому. Теперь токен на сервере.
 */
class LeadService
{
    public function handle(array $lead): void
    {
        // В лог пишем всегда — это страховка, если внешний канал недоступен.
        Log::channel('single')->info('Заявка с сайта', $lead);

        $this->sendTelegram($lead);
        $this->sendBitrix($lead);
    }

    /** Уведомление менеджеру в Telegram. */
    private function sendTelegram(array $lead): void
    {
        $token = config('leads.telegram.token');
        $chat  = config('leads.telegram.chat_id');

        if (!$token || !$chat) {
            return;
        }

        try {
            Http::timeout(8)->post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id'    => $chat,
                'parse_mode' => 'HTML',
                'text'       => $this->message($lead),
            ])->throw();
        } catch (Throwable $e) {
            Log::warning('Заявка не ушла в Telegram: ' . $e->getMessage());
        }
    }

    /** Создание лида в Битрикс24 через входящий вебхук. */
    private function sendBitrix(array $lead): void
    {
        $webhook = config('leads.bitrix.webhook');

        if (!$webhook) {
            return;
        }

        try {
            Http::timeout(10)->post(rtrim($webhook, '/') . '/crm.lead.add.json', [
                'fields' => [
                    'TITLE'      => 'Заявка с сайта: ' . ($lead['source'] ?? 'сайт'),
                    'NAME'       => $lead['name'] ?? '',
                    'PHONE'      => [['VALUE' => $lead['phone'] ?? '', 'VALUE_TYPE' => 'WORK']],
                    'COMMENTS'   => $this->comments($lead),
                    'SOURCE_ID'  => 'WEB',
                    'ASSIGNED_BY_ID' => config('leads.bitrix.assigned_to') ?: null,
                ],
                'params' => ['REGISTER_SONET_EVENT' => 'Y'],
            ])->throw();
        } catch (Throwable $e) {
            Log::warning('Заявка не ушла в Битрикс24: ' . $e->getMessage());
        }
    }

    private function message(array $lead): string
    {
        $rows = [
            '<b>Новая заявка с сайта</b>',
            'Имя: ' . e($lead['name'] ?? '—'),
            'Телефон: ' . e($lead['phone'] ?? '—'),
            'Откуда: ' . e($lead['source'] ?? '—'),
        ];

        if (!empty($lead['page']))    $rows[] = 'Страница: ' . e($lead['page']);
        if (!empty($lead['comment'])) $rows[] = 'Комментарий: ' . e($lead['comment']);
        if (!empty($lead['courses'])) $rows[] = 'Курсы: ' . e($lead['courses']);

        return implode("\n", $rows);
    }

    private function comments(array $lead): string
    {
        return collect([
            'Страница'    => $lead['page'] ?? null,
            'Комментарий' => $lead['comment'] ?? null,
            'Курсы'       => $lead['courses'] ?? null,
        ])
            ->filter()
            ->map(fn ($v, $k) => "{$k}: {$v}")
            ->implode("\n");
    }
}
