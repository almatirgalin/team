@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <h1 class="page-title">
            Контакт
        </h1>
    </div>
    <div class="row justify-content-center deal-detail post-list">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (!empty($contact))
            <div class="mdl-card col-sm-12 mdl-shadow--6dp">
                <div class="mdl-card__title" style="background-image: url({{ asset('img/contact.jpg') }})">
                    <h2 class="mdl-card__title-text">{{ $contact->name }} {{ $contact->last_name }}</h2>
                </div>

                <div class="mdl-card__supporting-text">
                    <div>Дата создания: {{ $contact->date_create->format('d.m.Y') }}</div>
                    <div>Менеджер: <br><img src="{{ $contact->createdBy->photo }}"> {{ $contact->createdBy->name }} {{ $contact->createdBy->last_name }}</div>
                    <div>Ответственный: <br><img src="{{ $contact->assignedBy->photo }}"> {{ $contact->assignedBy->name }} {{ $contact->assignedBy->last_name }}</div>
                    @if($contact->contact)
                        <div>
                            <a href="{{ url('contact', $contact->contact->contact_id) }}">Контакт: {{ $contact->contact->name }} {{ $contact->contact->last_name }}</a>
                        </div>
                    @endif
                    @if($contact->company)
                        <div>
                            <a href="{{ url('company', $contact->company->company_id) }}">Компания: {{ $contact->company->title }}</a>
                        </div>
                    @endif
                    @if($contact->phone)
                        <div>Телефон: {{ $contact->phone['value'] }}</div>
                    @endif
                    @if($contact->email)
                        <div>E-mail: {{ $contact->email['value'] }}</div>
                    @endif
                    @if($contact->web)
                        <div>Сайт: {{ $contact->web['value'] }}</div>
                    @endif
                    @if($contact->comments)
                        <div>
                            Комментарии:<br> {!! $contact->comments !!}
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
