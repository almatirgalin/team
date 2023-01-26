@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <h1 class="page-title">
            Сотрудники
        </h1>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-faded">
        <div class="nav navbar-nav">
            <a class="@if (empty($active)) active @endif" href="{{ url('workers') }}">Сотрудники</a>
            <a class="@if (!empty($active)) active @endif" href="{{ url('workers') }}?fired=y">Уволенные</a>
        </div>
    </nav>
      @if (!empty($workers))
          <div class="mdl-grid">
              @foreach($workers as $worker)
                  <div class="mdl-card mdl-cell mdl-cell--4-col mdl-shadow--6dp">
                      <div class="mdl-card__title"
                           style="background-image: url(@if (!empty($worker->photo)){{ $worker->photo }}
                           @else {{ asset('img/no-image.jpg') }}
                           @endif">
                      </div>
                      <div class="mdl-card__subtitle-text">
                          <h2 class="mdl-card__title-text">{{ $worker->last_name }} {{ $worker->name }} {{ $worker->second_name }}</h2>
                      </div>

                      <div class="mdl-card__supporting-text">
                          <div>
                          @if (!empty($worker->email))
                              Email: {{ $worker->email }}
                          @endif
                          </div>
                          <div>
                          @if (!empty($worker->phone))
                              Телефон: {{ $worker->phone }}
                          @else
                              &nbsp;
                          @endif
                          </div>
                          <div>
                              @if (!empty($worker->register_date))
                                  Дата регистрации: {{ \Carbon\Carbon::createFromTimeString($worker->register_date)
                                       ->format('d.m.Y')}}
                              @endif
                          </div>
                          <div>
                              @if (!empty($worker->position))
                                  Должность: {{ $worker->position }}
                              @endif
                          </div>
                      </div>
                      <div class="mdl-card__actions mdl-card--border">
                          <a href="{{ url('worker', $worker->worker_id) }}" class="mdl-button mdl-js-button mdl-js-ripple-effect">
                              Подробнее
                          </a>
                      </div>
                  </div>
              @endforeach
          </div>
     @endif


        {{--<table class="table table-striped">
            @foreach($workers as $worker)
                <tr>
                    <td>
                        <img src="@if (!empty($worker->photo)){{ $worker->photo }}@else {{ asset('img/no-image.jpg') }} @endif" class="img-thumbnail img-fluid" style="min-width: 200px;max-width: 200px"/>
                    </td>
                    <td>
                        <div>{{ $worker->last_name }} {{ $worker->name }} {{ $worker->second_name }}</div>
                        @if (!empty($worker->position))
                            <div class="min-text">Должность: {{ $worker->position }}</div>
                        @endif
                    </td>
                    <td>
                        @if (!empty($worker->email))
                            <div>Email: {{ $worker->email }}</div>
                        @endif
                        @if (!empty($worker->phone))
                            <div>Телефон: {{ $worker->phone }}</div>
                        @endif
                    </td>
                    <td>
                        @if (!empty($worker->skills))
                            <div>Умения:<br> {{ $worker->skills }}</div>
                        @endif
                    </td>
                    <td>
                        @if (!empty($worker->interests))
                            <div>Интересы:<br> {{ $worker->interests }}</div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>--}}
    <div class="row justify-content-center">
        @if (empty($active))
            {{ $workers->links() }}
        @else
            {{ $workers->appends(['fired' => 'y'])->links() }}
        @endif
    </div>
</div>
@endsection
