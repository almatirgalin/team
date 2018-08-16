@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <h1 class="page-title">
                Компания
            </h1>
        </div>
        <div class="row justify-content-center deal-detail post-list">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if (!empty($company))
                <div class="mdl-card col-sm-12 mdl-shadow--6dp">
                    <div class="mdl-card__title" style="background-image: url({{ asset('img/company.jpg') }})">
                        <h2 class="mdl-card__title-text">{{ $company->name }} {{ $company->last_name }}</h2>
                    </div>

                    <div class="mdl-card__supporting-text">
                        <div>Дата создания: {{ $company->date_create->format('d.m.Y') }}</div>
                        <div>Менеджер: <br><img src="{{ $company->createdBy->photo }}"> {{ $company->createdBy->name }} {{ $company->createdBy->last_name }}</div>
                        <div>Ответственный: <br><img src="{{ $company->assignedBy->photo }}"> {{ $company->assignedBy->name }} {{ $company->assignedBy->last_name }}</div>
                        @if($company->contact)
                            <div>
                                <a href="{{ url('contact', $company->contact->contact_id) }}">Контакт: {{ $company->contact->name }} {{ $company->contact->last_name }}</a>
                            </div>
                        @endif
                        @if($company->phone)
                            <div>Телефон: {{ $company->phone['value'] }}</div>
                        @endif
                        @if($company->email)
                            <div>E-mail: {{ $company->email['value'] }}</div>
                        @endif
                        @if($company->web)
                            <div>Сайт: {{ $company->web['value'] }}</div>
                        @endif
                        @if($company->comments)
                            <div>
                                Комментарии:<br> {!! $company->comments !!}
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
