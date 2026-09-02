import"./modulepreload-polyfill.js";import{c as v,a as p}from"./categories.js";import{a as l}from"./articles.js";import{a as w}from"./auth.js";document.addEventListener("DOMContentLoaded",async()=>{if(!await v())return;const i=document.getElementById("categoryFilter"),c=document.getElementById("tagFilter"),d=document.getElementById("sortFilter"),m=document.getElementById("logout"),s=document.querySelector(".admin__articles-grid");async function u(){try{const e=await p.getAll();i.innerHTML='<option value="">Все категории</option>'+e.map(t=>`<option value="${t.id}">${t.name}</option>`).join("")}catch{o("Ошибка при загрузке категорий")}}async function g(){try{const t=await(await fetch("/api/tags.php")).json();t.success&&(c.innerHTML='<option value="">Все теги</option>'+t.data.map(a=>`<option value="${a.id}">${a.name}</option>`).join(""))}catch{o("Ошибка при загрузке тегов")}}const o=e=>{const t=document.createElement("div");t.className="error-message",t.textContent=e,s.insertAdjacentElement("beforebegin",t),setTimeout(()=>t.remove(),3e3)},_=e=>{const t=document.createElement("div");t.className="success-message",t.textContent=e,s.insertAdjacentElement("beforebegin",t),setTimeout(()=>t.remove(),3e3)},h=e=>`
      <div class="admin__article-card">
        <div class="admin__article-image">
          <img src="${e.img||"/assets/images/no-image.jpg"}" alt="${e.title}">
        </div>
        <div class="admin__article-content">
          <h3 class="admin__article-title">${e.title}</h3>
          <p class="admin__article-category">${e.category_name||"Без категории"}</p>
          <div class="admin__article-actions">
            <a href="/admin/article-edit.html?id=${e.id}" class="admin__article-button admin__article-button--edit">
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M14.5 2.5L17.5 5.5M2.5 17.5L5.5 14.5M17.5 5.5L14.5 2.5M17.5 5.5L14.5 8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Редактировать
            </a>
            <button class="admin__article-button admin__article-button--delete" onclick="deleteArticle(${e.id})">
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M3 5H17M7 5V3C7 2.44772 7.44772 2 8 2H12C12.5523 2 13 2.44772 13 3V5M15 5V17C15 17.5523 14.5523 18 14 18H6C5.44772 18 5 17.5523 5 17V5H15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Удалить
            </button>
          </div>
        </div>
      </div>
    `,r=async()=>{try{const e={category_id:i.value,tag_id:c.value,sort:d.value},t=await l.getAll(e);t.sort((a,n)=>{switch(e.sort){case"date_desc":return new Date(n.created_at)-new Date(a.created_at);case"date_asc":return new Date(a.created_at)-new Date(n.created_at);case"title_asc":return a.title.localeCompare(n.title,"ru");case"title_desc":return n.title.localeCompare(a.title,"ru");case"category_asc":return a.category_name.localeCompare(n.category_name,"ru");case"category_desc":return n.category_name.localeCompare(a.category_name,"ru");default:return 0}}),s.innerHTML=t.map(a=>h(a)).join("")}catch{o("Ошибка при загрузке статей")}};i.addEventListener("change",r),c.addEventListener("change",r),d.addEventListener("change",r),window.editArticle=e=>{window.location.href=`/admin/article-edit.html?id=${e}`},window.deleteArticle=async e=>{if(confirm("Вы уверены, что хотите удалить эту статью?"))try{await l.delete(e),_("Статья успешно удалена"),r()}catch{o("Ошибка при удалении статьи")}},window.removeTag=async(e,t)=>{try{await l.removeTag(e,t),r()}catch(a){console.error("Ошибка при удалении тега:",a)}},u(),g(),r(),m.addEventListener("click",async e=>{e.preventDefault();try{await w.logout(),window.location.href="/admin/login.html"}catch{o("Ошибка при выходе")}})});
