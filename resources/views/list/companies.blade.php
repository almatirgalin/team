@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <h1 class="page-title">
                Компании
            </h1>
        </div>
        @if (!empty($companies))
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
                    @foreach($companies as $company)
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">
                                <div>
                                    <a href="{{ url('company', $company->company_id) }}">{{ $company->title }} </a>
                                </div>

                                @if ($company->contact)
                                    <div class="min-text">
                                        Контакт: {{ $company->contact->last_name }} {{ $company->contact->name }}</div>
                                @endif
                            <td>
                                <div>{{ $company->createdBy->last_name }} {{ $company->createdBy->name }}</div>
                                <div><img src="{{ $company->createdBy->photo }}" class="img-thumbnail img-fluid"
                                          style="width: 50px;"/></div>
                            </td>
                            <td>
                                <div>{{ $company->assignedBy->last_name }} {{ $company->assignedBy->name }}</div>
                                <div><img src="{{ $company->assignedBy->photo }}" class="img-thumbnail img-fluid"
                                          style="width: 50px;"/></div>
                            </td>
                            <td>{{ $company->date_create ? $company->date_create->format('d.m.y') : '' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="row justify-content-center">
                {{ $companies->links() }}
            </div>
        @endif
    </div>
@endsection
