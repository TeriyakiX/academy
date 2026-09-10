@extends('layouts.app')

@push('head')
    @vite(['resources/src/app/assets/styles/constructor.css', 'resources/src/app/assets/styles/reviews.css', 'resources/src/app/assets/styles/home-blocks.css'])
@endpush

@push('scripts')
    <script type="module" src="/assets/reviewsSlider.js"></script>
@endpush
@section('content')
<div class="wrapper">@include('partials.site.header')<main class="main">@include('partials.blocks.hero')

@include('partials.blocks.license-bar')

@include('partials.blocks.stats')

@include('partials.blocks.courses-tabs')

@include('partials.blocks.constructor-cta')

@include('partials.blocks.schedule')

@include('partials.blocks.steps')

@include('partials.blocks.reviews')

@include('partials.blocks.teachers')

@include('partials.blocks.about')

@include('partials.blocks.reasons')

@include('partials.blocks.directions')

@include('partials.blocks.business-cta')

@include('partials.blocks.events')

@include('partials.blocks.certificate')

@include('partials.blocks.partners')

@include('partials.blocks.faq')

@include('partials.blocks.lead')

@include('partials.blocks.contacts')

</main></div>@include('partials.site.footer')<div id="eventModal" class="event-modal" style="display:none"><div class="event-modal-overlay"></div><div class="event-modal-container"><button class="event-modal-close"><svg width="20" height="20" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 5L5 15M5 5L15 15" stroke="#999" stroke-width="2" stroke-linecap="round"></path></svg></button><div class="event-modal-header"><svg width="48" height="48" viewbox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="48" height="48" rx="24" fill="#514442"></rect><path d="M24 16C22 16 18.5 17.5 18.5 22C18.5 26.5 24 32 24 32C24 32 29.5 26.5 29.5 22C29.5 17.5 26 16 24 16Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><circle cx="24" cy="22" r="3" stroke="white" stroke-width="1.5"></circle></svg><h3 id="eventModalTitle">Запись на мероприятие</h3></div><div id="eventModalDesc" class="event-modal-desc"></div><form id="eventRegistrationForm"><input type="hidden" id="eventId" name="event_id"><div class="form-group"><label for="userName">Ваше имя</label> <input type="text" id="userName" name="name" required placeholder="Иван Иванов"></div><div class="form-group"><label for="userPhone">Телефон</label> <input type="tel" id="userPhone" name="phone" required placeholder="+7 (___) ___-__-__"></div><div class="form-group"><label for="userEmail">Email</label> <input type="email" id="userEmail" name="email" placeholder="ivan@example.com"></div><div class="form-group"><label for="userComment">Комментарий</label> <textarea id="userComment" name="comment" rows="3" placeholder="Ваши пожелания или вопросы"></textarea></div><div class="event-modal-buttons"><button type="button" class="btn-cancel">Отмена</button> <button type="submit" class="btn-submit">Записаться</button></div></form><div id="eventModalResult" style="display:none"></div></div></div><style>.event-modal{position:fixed;top:0;left:0;width:100%;height:100%;z-index:10000;display:flex;align-items:center;justify-content:center}.event-modal-overlay{position:absolute;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.7)}.event-modal-container{position:relative;background:#fff;border-radius:24px;padding:32px;max-width:520px;width:90%;max-height:90vh;overflow-y:auto;z-index:10001;box-shadow:0 20px 40px rgba(0,0,0,.2)}.event-modal-close{position:absolute;top:20px;right:20px;cursor:pointer;background:0 0;border:none;padding:8px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:background .2s}.event-modal-close:hover{background:#f5f5f5}.event-modal-close svg{width:20px;height:20px}.event-modal-header{text-align:center;margin-bottom:24px}.event-modal-header svg{margin-bottom:16px}.event-modal-header h3{font-size:24px;font-weight:600;color:#514442;margin:0;font-family:inherit}.event-modal-desc{background:#f5f2f0;border-radius:16px;padding:16px 20px;margin-bottom:24px;font-size:14px;line-height:1.6;color:#333}.event-modal-desc strong{color:#514442;font-weight:600}.event-modal-container .form-group{margin-bottom:20px}.event-modal-container label{display:block;margin-bottom:8px;font-weight:500;font-size:14px;color:#333}.event-modal-container input,.event-modal-container textarea{width:100%;padding:12px 16px;border:1px solid #e0dcd9;border-radius:12px;font-size:14px;font-family:inherit;transition:border-color .2s}.event-modal-container input:focus,.event-modal-container textarea:focus{outline:0;border-color:#514442}.event-modal-container input::placeholder,.event-modal-container textarea::placeholder{color:#b8b2ac}.event-modal-buttons{display:flex;gap:12px;justify-content:flex-end;margin-top:28px}.btn-cancel{padding:12px 28px;background:0 0;border:1px solid #d4cfca;border-radius:40px;cursor:pointer;font-size:14px;font-weight:500;color:#7a736e;transition:all .2s}.btn-cancel:hover{background:#f5f5f5;border-color:#b8b2ac}.btn-submit{padding:12px 32px;background:#514442;color:#fff;border:none;border-radius:40px;cursor:pointer;font-size:14px;font-weight:500;transition:background .2s}.btn-submit:hover{background:#3a302f}.btn-submit:disabled{opacity:.6;cursor:not-allowed}#eventModalResult{margin-top:20px;padding:14px 16px;border-radius:12px;text-align:center;font-size:14px}#eventModalResult.success{background:#e8f5e9;color:#2e7d32}#eventModalResult.error{background:#ffebee;color:#c62828}</style>
@endsection
