<?php

namespace App\Support;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

/**
 * Встречи для страниц сайта.
 *
 * Источник — CRM или файл настроек, и поля там могут прийти неполными:
 * у старой записи нет ни адреса страницы, ни даты. Поэтому список
 * проходит через одно место, где недостающее достраивается, а записи
 * без даты отбрасываются: без неё карточку не показать.
 */
class Meetings
{
    /** Встречи по месяцам, как их ждут шаблоны. */
    public static function months(): array
    {
        $months = [];

        foreach (config('home.events.months', []) as $month => $list) {
            foreach ((array) $list as $event) {
                $ready = self::normalize((array) $event);

                if ($ready) {
                    $months[$month][] = $ready;
                }
            }
        }

        return $months;
    }

    /** Все встречи одним списком. */
    public static function all(): Collection
    {
        return collect(self::months())->flatMap(fn ($list) => $list);
    }

    public static function find(string $slug): ?array
    {
        return self::all()->firstWhere('slug', $slug);
    }

    private static function slug(string $title, Carbon $at): string
    {
        return Str::slug($title) ?: 'vstrecha-' . $at->format('d-m-Y');
    }

    /**
     * Недостающие поля достраиваем из даты и названия, чтобы шаблоны
     * не разваливались на неполной записи.
     */
    private static function normalize(array $e): ?array
    {
        $date = $e['date'] ?? null;

        if (!$date) {
            return null;
        }

        $at = Carbon::parse($date)->locale('ru');

        return [
            /* Адрес страницы: если из источника не пришёл, собираем из
               названия — иначе карточке некуда вести. */
            'slug'        => ($e['slug'] ?? null) ?: self::slug($e['title'] ?? '', $at),
            'date'        => $at->format('Y-m-d'),
            'day'         => $e['day']     ?? $at->format('d'),
            'month'       => $e['month']   ?? $at->translatedFormat('M'),
            'weekday'     => $e['weekday'] ?? $at->translatedFormat('l'),
            'time'        => $e['time']    ?? $at->format('H:i'),
            'title'       => $e['title']   ?? '',
            'text'        => $e['text']    ?? '',
            'section'     => $e['section'] ?? null,
            'photo'       => $e['photo']   ?: '/assets/master-class.webp',
            'price'       => (int) ($e['price'] ?? 0),
            'duration'    => $e['duration'] ?? null,
            'place'       => $e['place']    ?? null,
            'seats_total' => $e['seats_total'] ?? null,
            'seats_left'  => $e['seats_left']  ?? null,
            'about'       => (array) ($e['about'] ?? []),
            'for_whom'    => $e['for_whom'] ?? null,
        ];
    }
}
