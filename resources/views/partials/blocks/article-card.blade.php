{{-- Карточка статьи в списке блога и в блоке «Читайте также». --}}
<article class="ab-blog-card">
    <a class="ab-blog-card__media" href="/blog/{{ $article['slug'] }}.html" tabindex="-1" aria-hidden="true">
        @if (!empty($article['image']))
            <img src="{{ $article['image'] }}" alt="" width="600" height="340" loading="lazy" decoding="async">
        @endif
    </a>

    <div class="ab-blog-card__body">
        <p class="ab-blog-card__meta">
            <span>{{ $article['category'] }}</span>
            <time datetime="{{ $article['date'] }}">
                {{ \Illuminate\Support\Carbon::parse($article['date'])->locale('ru')->translatedFormat('j F Y') }}
            </time>
        </p>

        <h2 class="ab-blog-card__title">
            <a href="/blog/{{ $article['slug'] }}.html">{{ $article['title'] }}</a>
        </h2>

        <p class="ab-blog-card__text">{{ $article['excerpt'] }}</p>
    </div>
</article>
