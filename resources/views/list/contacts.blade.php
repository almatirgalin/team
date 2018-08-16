@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <h1 class="page-title">
                Контакты
            </h1>
        </div>
        @if (!empty($contacts))
            <div class="row justify-content-center">
                <table class="mdl-data-table mdl-js-data-table mdl-shadow--6dp">
                    <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">Имя</th>
                        <th class="mdl-data-table__cell--non-numeric">Постановщик</th>
                        <th class="mdl-data-table__cell--non-numeric">Ответственный</th>
                        <th class="mdl-data-table__cell--non-numeric">Дата создания</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">
                                <div>
                                    <a href="{{ url('contact', $contact->contact_id) }}">{{ $contact->last_name }} {{ $contact->name }}</a>
                                </div>

                                @if ($contact->company)
                                    <div class="min-text">
                                        Компания: {{ $contact->company->title }}</div>
                                @endif

                                @if ($contact->company)
                                    <div class="min-text">Компания: {{ $contact->company->title }}</div>
                                @endif</td>
                            <td>
                                <div>{{ $contact->createdBy->last_name }} {{ $contact->createdBy->name }}</div>
                                <div><img src="{{ $contact->createdBy->photo }}" class="img-thumbnail img-fluid"
                                          style="width: 50px;"/></div>
                            </td>
                            <td>
                                <div>{{ $contact->assignedBy->last_name }} {{ $contact->assignedBy->name }}</div>
                                <div><img src="{{ $contact->assignedBy->photo }}" class="img-thumbnail img-fluid"
                                          style="width: 50px;"/></div>
                            </td>
                            <td>{{ $contact->date_create ? $contact->date_create->format('d.m.y') : '' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="row justify-content-center">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>
@endsection
