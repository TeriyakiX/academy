# Академия Бариста

Сайт школы бариста: каталог курсов, конструктор программ, приём заявок.

## Стек

- Laravel 13, PHP 8.2+
- Vue 3 точечными компонентами (без SPA — HTML отдаёт сервер, это важно для поисковой выдачи)
- Vite

## Запуск

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
npm run build
php artisan serve
```

## Структура

| Путь | Что внутри |
|---|---|
| `config/site.php` | Карта страниц: URL, мета-теги, подключаемые стили и скрипты |
| `config/nav.php` | Меню, контакты, соцсети |
| `config/home.php` | Данные блоков главной |
| `config/courses.php` | Курсы, цены, пороги скидок конструктора |
| `config/course-pages.php` | Содержимое страниц курсов |
| `config/documents.php` | Блок «Какой документ вы получите» |
| `config/leads.php` | Каналы, куда уходят заявки |
| `resources/src/` | Фронтенд: слои app / modules / shared, см. [resources/src/README.md](resources/src/README.md) |
| `resources/views/partials/blocks/` | Блоки страниц |

## Адреса страниц

URL повторяют адреса прежней версии сайта, включая расширение `.html`.
Менять их нельзя — это условие сохранения позиций в поиске.

## Заявки

Формы отправляются на `POST /lead`, дальше их разбирает `app/Services/LeadService.php`:
запись в лог, уведомление в Telegram, создание лида в Битрикс24.
Каналы включаются в `.env`:

```
TELEGRAM_BOT_TOKEN=
TELEGRAM_CHAT_ID=
BITRIX_WEBHOOK=
BITRIX_ASSIGNED_TO=
```

Формы защищены от автоматических отправок: скрытое поле-ловушка и проверка
времени заполнения.
