@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <h1 class="page-title">
            Сообщение ленты
        </h1>
    </div>
    <div class="row justify-content-center post-list">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (!empty($post))
            <div class="mdl-card col-sm-12 mdl-shadow--6dp">
                <div class="mdl-card__title">
                    <div class="post-user">
                        <div class="user-post-avatar" style="background: url({{ $post->user['photo'] }}) no-repeat center;
                                background-size: cover;"></div>
                        <div>
                            <a href="{{ url('worker', $post->user['worker_id']) }}">
                                {{ $post->user['name'] }} {{ $post->user['last_name'] }}
                            </a>
                        </div>
                    </div>
                    <h2 class="mdl-card__title-text">{!! $post->title !!}</h2>
                </div>

                <div class="mdl-card__supporting-text">
                    {!! \PheRum\BBCode\Facades\BBCode::parse($post->message) !!}
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a href="/" class="mdl-button mdl-js-button mdl-js-ripple-effect">
                        Назад
                    </a>
                </div>
                <div class="mdl-card__menu">
                    <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                        <i class="material-icons">share</i>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
