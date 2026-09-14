<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/*
 | Запрет индексации тестовой копии.
 |
 | robots.txt на тестовом хосте уже закрывает обход, но этого мало:
 | если на адрес копии где-то стоит ссылка, поисковик может показать её
 | в выдаче без содержимого — прочитать запрет в разметке он не сможет,
 | потому что обход закрыт. Заголовок X-Robots-Tag приходит вместе с
 | ответом и снимает этот случай.
 |
 | Боевой домен ничего этого не получает: список хостов в config/seo.php.
 */
class NoIndexOnStaging
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (in_array($request->getHost(), config('seo.noindex_hosts', []), true)) {
            $response->headers->set('X-Robots-Tag', 'noindex, nofollow');
        }

        return $response;
    }
}
