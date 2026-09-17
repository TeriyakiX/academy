<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <title>Сертификат — бланк для печати</title>

    {{--
        Бланк сертификата для печати и выдачи на руки.
        Отдельная страница без шапки и подвала: всё в миллиметрах,
        чтобы на бумаге получилось то же, что на экране.

        Печать: A4, ландшафт, поля «Нет», «Фоновая графика» включена.
        Из этой же страницы делается PDF.

        Значения можно подставить через адрес:
        ?to=Иван Иванов&program=Бариста базовый&number=0007&date=12.10.2026
    --}}
    <style>
        @page { size: A4 landscape; margin: 0; }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            padding: 0;
            background: #ece7e1;
            font-family: 'Trebuchet MS', 'Segoe UI', Arial, sans-serif;
            color: #1f1a16;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .sheet {
            position: relative;
            width: 297mm;
            height: 210mm;
            margin: 0 auto;
            padding: 14mm;
            background: #fdfbf7;
            overflow: hidden;
        }

        /* Лёгкая бумажная подложка, чтобы лист не выглядел пустым белым. */
        .sheet::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(120% 90% at 50% 0%, #fffefb 0%, #f7f1e9 70%, #f1e9de 100%);
        }

        .frame {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100%;
            padding: 12mm 16mm 10mm;
            border: 1.2mm double #b9805a;
        }

        .corner {
            position: absolute;
            width: 9mm;
            height: 9mm;
            border: 0 solid #b9805a;
        }

        .corner--tl { top: 4mm; left: 4mm; border-top-width: .7mm; border-left-width: .7mm; }
        .corner--tr { top: 4mm; right: 4mm; border-top-width: .7mm; border-right-width: .7mm; }
        .corner--bl { bottom: 4mm; left: 4mm; border-bottom-width: .7mm; border-left-width: .7mm; }
        .corner--br { bottom: 4mm; right: 4mm; border-bottom-width: .7mm; border-right-width: .7mm; }

        .logo { width: 22mm; height: auto; margin-bottom: 4mm; }

        .title {
            margin: 0;
            font-size: 19mm;
            font-weight: 800;
            letter-spacing: .12em;
            line-height: 1;
            text-transform: uppercase;
            color: #241c16;
        }

        .subtitle {
            margin-top: 3mm;
            font-size: 4.6mm;
            letter-spacing: .08em;
            color: #8a7466;
        }

        .lines { width: 100%; margin-top: 10mm; }

        .label {
            font-size: 3.4mm;
            font-weight: 700;
            letter-spacing: .16em;
            text-transform: uppercase;
            color: #a9907d;
        }

        .line {
            margin: 1.5mm 0 7mm;
            padding-bottom: 2mm;
            border-bottom: .3mm solid #cbb49f;
            min-height: 9mm;
            font-size: 7mm;
        }

        /* Пустая строка подсказывает, что в неё вписать; на печать подсказка не идёт. */
        .line:empty::before {
            content: attr(data-empty);
            font-family: Georgia, 'Times New Roman', serif;
            font-style: italic;
            color: #c3b1a1;
        }

        [contenteditable]:focus {
            outline: none;
            background: #fdf6ec;
        }

        .foot {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            width: 100%;
            margin-top: auto;
            gap: 10mm;
        }

        .meta { font-size: 3.6mm; line-height: 1.6; color: #8a7466; }

        .seal { width: 34mm; height: 34mm; color: #8e4b3d; opacity: .8; }

        .sign { width: 70mm; text-align: center; }

        .sign__line { height: .3mm; margin-bottom: 2mm; background: #b9a18b; }

        .sign__text { font-size: 3.6mm; color: #8a7466; }

        /* Подсказка видна на экране, но не печатается. */
        .hint {
            max-width: 297mm;
            margin: 6mm auto;
            padding: 0 14mm;
            font-size: 14px;
            line-height: 1.5;
            color: #5a4a3f;
        }

        @media print {
            .hint { display: none; }
            body { background: none; }
            /* Подсказки в пустых строках на бумаге не нужны. */
            .line:empty::before { content: ''; }
            [contenteditable]:focus { background: none; }
        }
    </style>
</head>
<body>
<div class="sheet">
    <div class="frame">
        <span class="corner corner--tl"></span>
        <span class="corner corner--tr"></span>
        <span class="corner corner--bl"></span>
        <span class="corner corner--br"></span>

        <img class="logo" src="/assets/logo.svg" alt="Академия Бариста">

        <h1 class="title">Сертификат</h1>
        <span class="subtitle">на обучение в Академии Бариста</span>

        <div class="lines">
            <span class="label">Выдан</span>
            <div class="line" contenteditable="true" data-empty="имя получателя">{{ $to }}</div>

            <span class="label">Программа</span>
            <div class="line" contenteditable="true" data-empty="выбранные курсы и мастер-классы">{{ $program }}</div>
        </div>

        <div class="foot">
            <div class="meta">
                <div>Москва</div>
                <div>№ <span contenteditable="true">{{ $number }}</span></div>
                <div contenteditable="true">{{ $date }}</div>
            </div>

            {{-- Печать: круговая надпись вокруг знака. --}}
            <svg class="seal" viewBox="0 0 100 100" aria-hidden="true">
                <defs>
                    <path id="seal-print" d="M50 50 m-36 0 a36 36 0 1 1 72 0 a36 36 0 1 1 -72 0" />
                </defs>
                <circle cx="50" cy="50" r="47" fill="none" stroke="currentColor" stroke-width="2" />
                <circle cx="50" cy="50" r="27" fill="none" stroke="currentColor" stroke-width="1.4" />
                <text font-size="9.4" letter-spacing="1.6" fill="currentColor">
                    <textPath href="#seal-print">АКАДЕМИЯ БАРИСТА · МОСКВА ·</textPath>
                </text>
                <text x="50" y="47" text-anchor="middle" font-size="9" font-weight="700" fill="currentColor">С 2019</text>
                <text x="50" y="58" text-anchor="middle" font-size="7" fill="currentColor">ГОДА</text>
            </svg>

            <div class="sign">
                <div class="sign__line"></div>
                <div class="sign__text">Руководитель школы</div>
            </div>
        </div>
    </div>
</div>

<p class="hint">
    <b>Как выписать сертификат.</b> Нажмите на строку «Выдан» и впишите имя, потом программу,
    номер и дату — прямо на листе. Затем Ctrl+P: размер A4, ориентация «Альбомная»,
    поля «Нет», отметка «Фоновая графика». Можно и распечатать пустой бланк, а строки заполнить от руки.
</p>
</body>
</html>
