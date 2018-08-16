@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <h1 class="page-title">
            Сделка
        </h1>
    </div>
    <div class="row justify-content-center deal-detail post-list">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (!empty($deal))
            <div class="mdl-card col-sm-12 mdl-shadow--6dp">
                <div class="mdl-card__title" style="background-image: url({{ asset('img/deal.jpeg') }})">
                    <h2 class="mdl-card__title-text">{!! $deal->title !!}</h2>
                </div>

                <div class="mdl-card__supporting-text">
                    <div>Дата создания: {{ $deal->date_create->format('d.m.Y') }}</div>
                    <div>Сумма: {{ $deal->opportunity }}</div>
                    <div>Стадия: {{ $deal->stage }}</div>
                    <div>Менеджер: <br><img src="{{ $deal->createdBy->photo }}"> {{ $deal->createdBy->name }} {{ $deal->createdBy->last_name }}</div>
                    <div>Ответственный: <br><img src="{{ $deal->assignedBy->photo }}"> {{ $deal->assignedBy->name }} {{ $deal->assignedBy->last_name }}</div>
                    @if($deal->contact)
                        <div>
                            <a href="{{ url('contact', $deal->contact->contact_id) }}">Контакт: {{ $deal->contact->name }} {{ $deal->contact->last_name }}</a>
                        </div>
                    @endif
                    @if($deal->company)
                        <div>
                            <a href="{{ url('company', $deal->company->company_id) }}">Компания: {{ $deal->company->title }}</a>
                        </div>
                    @endif
                    @if($deal->phone)
                        <div>Телефон: {{ $deal->phone }}</div>
                    @endif
                    @if($deal->email)
                        <div>E-mail: {{ $deal->email }}</div>
                    @endif
                    @if($deal->web)
                        <div>Сайт: {{ $deal->web }}</div>
                    @endif
                    @if($deal->comments)
                        <div>
                            Комментарии:<br> {!! $deal->comments !!}
                        </div>
                    @endif
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a href="{{ \Illuminate\Support\Facades\URL::previous() }}" class="mdl-button mdl-js-button mdl-js-ripple-effect">
                        Назад
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
