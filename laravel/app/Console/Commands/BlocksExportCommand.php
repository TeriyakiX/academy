<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Выгрузка текстов сайта для переноса в CRM.
 *
 * Тексты страниц лежат в конфигах проекта, и школа их править не может.
 * Команда отдаёт их одним json, который на той стороне принимает
 * `site:blocks-import`. Ключ блока совпадает с ключом настройки:
 * home.faq → config('home.faq'), поэтому обратная подстановка работает
 * без правки шаблонов.
 */
class BlocksExportCommand extends Command
{
    protected $signature = 'site:blocks-export {--file= : куда записать (по умолчанию в вывод)}';

    protected $description = 'Выгрузить тексты сайта в json для CRM';

    /**
     * Что выгружаем: ключ настройки → человеческое название раздела.
     * Списки программ и каталог сюда не входят — они ведутся своими
     * разделами CRM.
     */
    private const BLOCKS = [
        'home.hero'     => 'Главная: первый экран',
        'home.lines'    => 'Главная: чем занимается школа',
        'home.reasons'  => 'Главная: почему мы',
        'home.about'    => 'Главная: об академии',
        'home.faq'      => 'Главная: вопросы и ответы',
        'home.steps'    => 'Главная: как проходит обучение',
        'home.reviews'  => 'Главная: отзывы',
        'home.stats'    => 'Главная: цифры',
        'home.teachers' => 'Главная: преподаватели',
        'home.lead'     => 'Главная: блок заявки',

        'business.intro' => 'Для бизнеса: вступление',
        'business.items' => 'Для бизнеса: услуги',
        'business.faq'   => 'Для бизнеса: вопросы',

        'service.intro'  => 'Сервис: вступление',
        'service.prices' => 'Сервис: порядок работ и цены',
        'service.tech'   => 'Сервис: с какой техникой работаем',
        'service.faq'    => 'Сервис: вопросы',

        'nav.contacts' => 'Контакты: телефон, почта, адрес, часы',
        'nav.socials'  => 'Контакты: соцсети',
    ];

    public function handle(): int
    {
        $blocks = [];

        foreach (self::BLOCKS as $key => $title) {
            $value = config($key);

            /* Пустую настройку не выгружаем: в CRM появился бы блок,
               который нечем заполнить. */
            if ($value === null || $value === []) {
                continue;
            }

            $blocks[] = [
                'key'   => $key,
                'title' => $title,
                'data'  => is_array($value) ? $value : ['value' => $value],
            ];
        }

        $json = json_encode(['blocks' => $blocks], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $file = $this->option('file');

        if ($file) {
            file_put_contents($file, $json);
            $this->info('Записано: ' . $file . ' (блоков: ' . count($blocks) . ')');

            return self::SUCCESS;
        }

        $this->line($json);

        return self::SUCCESS;
    }
}
