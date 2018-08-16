@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <h1 class="page-title">
                Лиды
            </h1>
        </div>
        @if (!empty($leads))
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
                    @foreach($leads as $lead)
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">
                                <div>
                                    <a href="{{ url('lead', $lead->lead_id) }}">{{ $lead->title }}</a>
                                </div>

                                @if ($lead->contact)
                                    <div class="min-text">
                                        Контакт: {{ $lead->contact->last_name }} {{ $lead->contact->name }}</div>
                                @endif

                                @if ($lead->company)
                                    <div class="min-text">Компания: {{ $lead->company->title }}</div>
                                @endif</td>
                            <td>
                                @if($lead->createdBy)
                                    <div>{{ $lead->createdBy->last_name }} {{ $lead->createdBy->name }}</div>
                                    <div><img src="{{ $lead->createdBy->photo }}" class="img-thumbnail img-fluid"
                                          style="width: 50px;"/></div>
                                @endif
                            </td>
                            <td>
                                @if($lead->assignedBy)
                                    <div>{{ $lead->assignedBy->last_name }} {{ $lead->assignedBy->name }}</div>
                                    <div><img src="{{ $lead->assignedBy->photo }}" class="img-thumbnail img-fluid"
                                          style="width: 50px;"/></div>
                                @endif
                            </td>
                            <td>{{ $lead->opportunity }}</td>
                            <td>{{ $lead->date_create ? $lead->date_create->format('d.m.y') : '' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="row justify-content-center">
                {{ $leads->links() }}
            </div>
        @endif
    </div>
@endsection
