@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <h1 class="page-title">
                Живая лента
            </h1>
        </div>
        <div class="row justify-content-center">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if (!empty($posts))
                <ul class="post-list">
                    @foreach ($posts as $post)
                        <div class="mdl-card col-sm-12 mdl-shadow--6dp">
                            <div class="mdl-card__title">
                                <div class="post-user">
                                    @if (!empty($post->user['photo']))
                                        <div class="user-post-avatar" style="background: url({{ $post->user['photo'] }}) no-repeat center;
                                        background-size: cover;"></div>
                                    @endif
                                        <div>
                                            <a href="{{ url('worker', $post->user['worker_id'] ?? '') }}">
                                                {{ $post->user['name'] ?? '' }} {{ $post->user['last_name'] ?? '' }}
                                            </a>
                                        </div>
                                </div>
                                <h2 class="mdl-card__title-text">{!! $post->title !!}</h2>
                            </div>

                            <div class="mdl-card__supporting-text">
                                {!! substr(\PheRum\BBCode\Facades\BBCode::parse($post->message), 0, 1000) !!} ...
                            </div>
                            <div class="mdl-card__actions mdl-card--border">
                                <a href="{{ url('post', $post->post_id) }}"
                                   class="mdl-button mdl-js-button mdl-js-ripple-effect">
                                    Подробнее
                                </a>
                            </div>
                            <div class="mdl-card__menu">
                                <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                                    <a href="tg://share?url=www.example.com?t=12&text=Check out this url"><i
                                                class="material-icons">share</i></a>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </ul>
                {{ $posts->links() }}
            @endif
        </div>
    </div>
@endsection
