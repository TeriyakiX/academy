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
     * `nav.main` - порядок и названия пунктов меню: школа их переставляет
     * сама, адреса (`href`) при этом менять нельзя, иначе пункт уводит
     * в никуда. `courses.schools` и `nav.footer` сюда не берём: это
     * опоры разметки, а не тексты.
     * Списки программ и каталог сюда не входят — они ведутся своими
     * разделами CRM.
     */
    private const BLOCKS = [
        'home.hero'             => 'Главная: первый экран',
        'home.promo'            => 'Всплывающее предложение',
        'home.lines'            => 'Главная: чем занимается школа',
        'home.reasons'          => 'Главная: почему мы',
        'home.about'            => 'Главная: об академии',
        'home.about_process'    => 'О нас: как проходит занятие',
        'home.about_profession' => 'О нас: профессия бариста',
        'home.faq'              => 'Главная: вопросы и ответы',
        'home.steps'            => 'Главная: как проходит обучение',
        'home.schedule'         => 'Главная: график занятий',
        'home.reviews'          => 'Главная: отзывы',
        'home.ratings'          => 'Главная: рейтинги',
        'home.stats'            => 'Главная: цифры',
        'home.teachers'         => 'Главная: преподаватели',
        'home.partners'         => 'Главная: партнёры',
        'home.business'         => 'Главная: блок для бизнеса',

        'business.items' => 'Для бизнеса: услуги',

        'service.hero'      => 'Сервис: первый экран',
        'service.benefits'  => 'Сервис: почему мы',
        'service.works'     => 'Сервис: какие работы делаем',
        'service.prices'    => 'Сервис: порядок работ и цены',
        'service.steps'     => 'Сервис: как проходит ремонт',
        'service.equipment' => 'Сервис: с какой техникой работаем',

        'courses.discounts' => 'Скидки за несколько программ',
        'courses.path'      => 'Курсы: с чего начать',
        'courses.path_note' => 'Курсы: примечание к пути',

        'nav.main'     => 'Меню сайта: порядок и названия',
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
