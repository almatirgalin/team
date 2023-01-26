@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <h1 class="page-title">
            {{ $worker->name }} {{ $worker->second_name }} {{ $worker->last_name }}
        </h1>
    </div>
    <div class="row justify-content-center post-list">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
            <div class="user-block">
                <div class="user-block__photo">
                    <img src="{{ $worker->photo }}">
                </div>
                <div class="user-block__desc">
                    @if($worker->post)
                        <div class="user-info">Должность: {{ $worker->post }}</div>
                    @endif
                    @if($worker->email)
                        <div class="user-info">E-mail: {{ $worker->email }}</div>
                    @endif
                    @if($worker->phone)
                        <div class="user-info">Телефон: {{ $worker->phone }}</div>
                    @endif
                    @if($worker->skype)
                        <div class="user-info">Скайп: {{ $worker->skype }}</div>
                    @endif
                    @if($worker->skills)
                        <div class="user-info">Умения: {{ $worker->skills }}</div>
                    @endif
                    @if($worker->interests)
                        <div class="user-info">Интересы: {{ $worker->interests }}</div>
                    @endif
                        <div>
                            @if (!empty($worker->register_date))
                                Дата регистрации: {{ \Carbon\Carbon::createFromTimeString($worker->register_date)
                                       ->format('d.m.Y')}}
                            @endif
                        </div>
                </div>
            </div>
    </div>
</div>
@endsection
