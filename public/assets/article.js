import"./modulepreload-polyfill.js";import{m as l,t as n,b as d,a as m,h}from"./accordion-footer.js";import{y as _}from"./yandex-maps.js";import{s as p}from"./send-form-telegram.js";import"./_commonjsHelpers.js";const o=s=>{const t=new Date(s),a=["января","февраля","марта","апреля","мая","июня","июля","августа","сентября","октября","ноября","декабря"];return`${t.getDate()} ${a[t.getMonth()]} ${t.getFullYear()}`},g=async s=>{try{const a=await(await fetch(`/api/articles.php?id=${s}`)).json();if(a.success&&a.data){const e=a.data;document.title=`${e.title} | Блог`;const c=document.querySelector(".article");c&&(c.innerHTML=`
          <div class="article__container">
            <header class="article__header">
              <div class="article__meta">
                <time class="article__date">${o(e.created_at)}</time>
                <div class="article__tags">
                  ${(e.tag_names||[]).map(r=>`
                    <a href="/blogs.html?tag=${r}" class="article__tag">${r}</a>
                  `).join("")}
                </div>
              </div>
              <h1 class="article__title">${e.title}</h1>
            </header>

            ${e.img?`
              <img src="${e.img}"
                   alt="${e.title}"
                   class="article__image">
            `:""}

            <div class="article__content">
              ${e.content}
            </div>

            <div class="article__share">
              <span class="article__share-text">Поделиться:</span>
              <div class="article__share-buttons">
                <a href="https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}" 
                   class="article__share-button" 
                   title="Поделиться в Facebook"
                   target="_blank">
                  <svg viewBox="0 0 24 24">
                    <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                  </svg>
                </a>
                <a href="https://twitter.com/intent/tweet?url=${encodeURIComponent(window.location.href)}&text=${encodeURIComponent(e.title)}" 
                   class="article__share-button" 
                   title="Поделиться в Twitter"
                   target="_blank">
                  <svg viewBox="0 0 24 24">
                    <path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/>
                  </svg>
                </a>
                <a href="https://t.me/share/url?url=${encodeURIComponent(window.location.href)}&text=${encodeURIComponent(e.title)}" 
                   class="article__share-button" 
                   title="Поделиться в Telegram"
                   target="_blank">
                  <svg viewBox="0 0 24 24">
                    <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.325.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                  </svg>
                </a>
              </div>
            </div>
          </div>
        `),v(e.category_id,e.id)}}catch(t){console.error("Ошибка при загрузке статьи:",t)}},v=async(s,t)=>{try{const e=await(await fetch(`/api/articles.php?category_id=${s}&limit=3`)).json();if(e.success&&e.data){const c=e.data.filter(i=>i.id!==t).slice(0,3),r=document.querySelector(".article-sidebar__list");r&&(r.innerHTML=c.map(i=>`
          <article class="article-sidebar__item">
            <a href="/article.html?id=${i.id}" class="article-sidebar__link">
              <img src="${i.img||"/images/placeholder.jpg"}"
                   alt="${i.title}"
                   class="article-sidebar__image">
              <div class="article-sidebar__content">
                <h4 class="article-sidebar__item-title">${i.title}</h4>
                <time class="article-sidebar__date">${o(i.created_at)}</time>
              </div>
            </a>
          </article>
        `).join(""))}}catch(a){console.error("Ошибка при загрузке похожих статей:",a)}};document.addEventListener("DOMContentLoaded",()=>{const t=new URLSearchParams(window.location.search).get("id");t&&g(t),_(),l(),n(),d(),m(),h(),p()});
