import"./modulepreload-polyfill.js";import{m as b,t as p,b as m,a as _,h as u}from"./accordion-footer.js";import{y as $}from"./yandex-maps.js";import{s as v}from"./send-form-telegram.js";import"./_commonjsHelpers.js";let r="all",i=1,c=null,d=null;const y=a=>{const t=new Date(a),o=["января","февраля","марта","апреля","мая","июня","июля","августа","сентября","октября","ноября","декабря"];return`${t.getDate()} ${o[t.getMonth()]} ${t.getFullYear()}`},f=(a,t=150)=>{const o=document.createElement("div");o.innerHTML=a;let s=o.textContent||o.innerText||"";return s=s.replace(/\s+/g," ").trim(),s.length>t&&(s=s.substr(0,t)+"..."),s},h=async()=>{try{const t=await(await fetch("/api/categories.php")).json();if(t.success){d=t.data;const o=d.find(n=>n.id===1),s=d.filter(n=>n.id!==1).slice(0,5),e=o?[o,...s]:s,l=document.querySelector(".blog-categories");l&&(l.innerHTML=`
          <button class="blog-category-btn active" data-category="all">Все</button>
          ${e.map(n=>`
            <button class="blog-category-btn" data-category="${n.id}">${n.name}</button>
          `).join("")}
        `)}}catch(a){console.error("Ошибка при загрузке категорий:",a)}},L=(a,t)=>{const o=document.querySelector(".blog-pagination");if(!o)return;let s="";s+=`
    <button class="blog-pagination__btn ${t===1?"disabled":""}" 
            data-page="${t-1}" 
            ${t===1?"disabled":""}>
      Предыдущая
    </button>
  `;for(let e=1;e<=a;e++)e===1||e===a||e>=t-1&&e<=t+1?s+=`
        <button class="blog-pagination__btn ${e===t?"active":""}" 
                data-page="${e}">
          ${e}
        </button>
      `:(e===t-2||e===t+2)&&(s+='<span class="blog-pagination__dots">...</span>');s+=`
    <button class="blog-pagination__btn ${t===a?"disabled":""}" 
            data-page="${t+1}" 
            ${t===a?"disabled":""}>
      Следующая
    </button>
  `,o.innerHTML=s},g=async(a="all",t=1)=>{try{const o=a==="all"?`/api/articles.php?page=${t}&limit=9`:`/api/articles.php?category_id=${a}&page=${t}&limit=9`,e=await(await fetch(o)).json();e.success&&(c=e,M())}catch(o){console.error("Ошибка при загрузке статей:",o)}},M=()=>{if(!c)return;const a=document.getElementById("blog-list");if(!a)return;const t=Array.isArray(c.data)?c.data:[],o=c.total||t.length;a.innerHTML=t.map((e,l)=>`
    <div class="blog-card" style="animation-delay: ${l*.1}s;">
      <a href="/article.html?id=${e.id}" class="blog-card__link">
        <div class="blog-card__innerimg">
          <img class="blog-card__img" src="${e.img||"/images/placeholder.jpg"}" alt="${e.title}">
        </div>
        <div class="blog-card__content">
          <div class="blog-card__date">${y(e.created_at)}</div>
          <div class="blog-card__title">${e.title}</div>
          <div class="blog-card__desc">${f(e.content)}</div>
          <div class="blog-card__tags">
            ${(e.tag_names||[]).map(n=>`
              <span class="blog-card__tag">${n}</span>
            `).join("")}
          </div>
        </div>
      </a>
    </div>
  `).join("");const s=Math.ceil(o/9);L(s,i)},T=async()=>{await Promise.all([h(),g(r,i)])};document.addEventListener("DOMContentLoaded",()=>{document.addEventListener("click",a=>{a.target.classList.contains("blog-category-btn")&&(document.querySelectorAll(".blog-category-btn").forEach(o=>o.classList.remove("active")),a.target.classList.add("active"),i=1,r=a.target.dataset.category,g(r,i))}),document.addEventListener("click",a=>{if(a.target.classList.contains("blog-pagination__btn")&&!a.target.disabled){const t=parseInt(a.target.dataset.page);t&&(i=t,g(r,i),window.scrollTo({top:0,behavior:"smooth"}))}}),$(),b(),p(),m(),_(),u(),v()});T();
