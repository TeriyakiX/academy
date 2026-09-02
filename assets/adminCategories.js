import"./modulepreload-polyfill.js";import{c as l,a}from"./categories.js";import{a as u}from"./auth.js";document.addEventListener("DOMContentLoaded",async()=>{if(!await l())return;const s=document.getElementById("logout"),c=document.getElementById("categoryForm"),i=document.getElementById("addCatButton"),d=document.querySelector(".admin__categories-grid"),n=e=>{const t=document.createElement("div");t.className="error-message",t.textContent=e,c.insertAdjacentElement("beforebegin",t),setTimeout(()=>t.remove(),3e3)},r=e=>{const t=document.createElement("div");t.className="success-message",t.textContent=e,c.insertAdjacentElement("beforebegin",t),setTimeout(()=>t.remove(),3e3)},m=e=>`
      <div class="admin__category-card">
        <h3 class="admin__category-name">${e.name}</h3>
        <div class="admin__category-meta">
          <span class="admin__category-count">${e.articles_count||0} статей</span>
        </div>
        <div class="admin__category-actions">
          <button class="admin__category-button admin__category-button--delete" onclick="deleteCategory(${e.id})">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
              <path d="M3 5H17M7 5V3C7 2.44772 7.44772 2 8 2H12C12.5523 2 13 2.44772 13 3V5M15 5V17C15 17.5523 14.5523 18 14 18H6C5.44772 18 5 17.5523 5 17V5H15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </button>
        </div>
      </div>
    `,o=async()=>{try{const e=await a.getAll();d.innerHTML=e.map(t=>m(t)).join("")}catch(e){console.log(e),n("Ошибка при загрузке категорий")}};o(),i.addEventListener("click",async()=>{try{const e=document.getElementById("name"),t=e.value.trim();if(!t){n("Название категории не может быть пустым");return}await a.create(t),r("Категория успешно создана"),e.value="",o()}catch{n("Ошибка при создании категории")}}),window.deleteCategory=async e=>{if(confirm("Вы уверены, что хотите удалить эту категорию?"))try{await a.delete(e),r("Категория успешно удалена"),o()}catch{n("Ошибка при удалении категории")}},s.addEventListener("click",async e=>{e.preventDefault();try{await u.logout(),window.location.href="/admin/login.html"}catch{n("Ошибка при выходе")}})});
