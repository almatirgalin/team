@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <h1 class="page-title">
                Сделки
            </h1>
        </div>
        @if (!empty($deals))
            <div class="row justify-content-center">
                <table class="mdl-data-table mdl-js-data-table mdl-shadow--6dp">
                    <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">Название</th>
                        <th class="mdl-data-table__cell--non-numeric">Постановщик</th>
                        <th class="mdl-data-table__cell--non-numeric">Ответственный</th>
                        <th>Сумма</th>
                        <th class="mdl-data-table__cell--non-numeric">Дата создания</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($deals as $deal)
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">
                                <div>
                                    <a href="{{ url('deal', $deal->deal_id) }}">{{ $deal->title }}</a>
                                </div>

                                @if ($deal->contact)
                                    <div class="min-text">
                                        Контакт: {{ $deal->contact->last_name }} {{ $deal->contact->name }}</div>
                                @endif

                                @if ($deal->company)
                                    <div class="min-text">Компания: {{ $deal->company->title }}</div>
                                @endif</td>
                            <td>
                                <div>{{ $deal->createdBy->last_name }} {{ $deal->createdBy->name }}</div>
                                <div><img src="{{ $deal->createdBy->photo }}" class="img-thumbnail img-fluid"
                                          style="width: 50px;"/></div>
                            </td>
                            <td>
                                <div>{{ $deal->assignedBy->last_name }} {{ $deal->assignedBy->name }}</div>
                                <div><img src="{{ $deal->assignedBy->photo }}" class="img-thumbnail img-fluid"
                                          style="width: 50px;"/></div>
                            </td>
                            <td>{{ $deal->opportunity }}</td>
                            <td>{{ $deal->date_create ? $deal->date_create->format('d.m.y') : '' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="row justify-content-center">
                {{ $deals->links() }}
            </div>
        @endif
    </div>
@endsection
