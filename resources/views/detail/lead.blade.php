@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <h1 class="page-title">
            Лид
        </h1>
    </div>
    <div class="row justify-content-center deal-detail post-list">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (!empty($lead))
            <div class="mdl-card col-sm-12 mdl-shadow--6dp">
                <div class="mdl-card__title" style="background-image: url({{ asset('img/lead.jpg') }})">
                    <h2 class="mdl-card__title-text">{!! $lead->title !!}</h2>
                </div>

                <div class="mdl-card__supporting-text">
                    <div>Дата создания: {{ $lead->date_create->format('d.m.Y') }}</div>
                    <div>Сумма: {{ $lead->opportunity }}</div>
                    <div>Стадия: {{ $lead->stage }}</div>
                    <div>Менеджер: <br><img src="{{ $lead->createdBy->photo }}"> {{ $lead->createdBy->name }} {{ $lead->createdBy->last_name }}</div>
                    <div>Ответственный: <br><img src="{{ $lead->assignedBy->photo }}"> {{ $lead->assignedBy->name }} {{ $lead->assignedBy->last_name }}</div>
                    @if($lead->contact)
                        <div>
                            <a href="{{ url('contact', $lead->contact->contact_id) }}">Контакт: {{ $lead->contact->name }} {{ $lead->contact->last_name }}</a>
                        </div>
                    @endif
                    @if($lead->company)
                        <div>
                            <a href="{{ url('company', $lead->company->company_id) }}">Компания: {{ $lead->company->title }}</a>
                        </div>
                    @endif
                    @if($lead->phone)
                        <div>Телефон: {{ $lead->phone['value'] }}</div>
                    @endif
                    @if($lead->email)
                        <div>E-mail: {{ $lead->email['value'] }}</div>
                    @endif
                    @if($lead->web)
                        <div>Сайт: {{ $lead->web['value'] }}</div>
                    @endif
                    @if($lead->comments)
                        <div>
                            Комментарии:<br> {!! $lead->comments !!}
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
