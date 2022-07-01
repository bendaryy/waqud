@extends('layouts.main')
@section('style')
    <style>
        .table thead th, .jsgrid .jsgrid-table thead th {
            color: white
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-9" style="margin:auto">
            <table class="table responsive text-center">
                <thead>
                    @foreach ($company as $com)
                        <tr>
                            <th>@lang('messages.companyCode')</th>
                            <th>{{ $com->companies->id }}</th>
                        </tr>
                        <tr>
                            <th>@lang('messages.companyName')</th>
                            <th>{{ $com->companies->name }}</th>
                        </tr>
                        <tr>
                            <th>@lang('messages.Email')</th>
                            <th>{{ $com->companies->email }}</th>
                        </tr>
                        <tr>
                            <th>@lang('messages.phone')</th>
                            <th>{{ $com->companies->phone }}</th>
                        </tr>
                        <tr>
                            <th>@lang('messages.taxNumber')</th>
                            <th>{{ $com->companies->tax_number }}</th>
                        </tr>
                        <tr>
                            <th>@lang('messages.segalTogary')</th>
                            <th>{{ $com->companies->segal_togary }}</th>
                        </tr>
                        <tr>
                            <th>@lang('messages.companyAddress')</th>
                            <th>{{ $com->companies->address }}</th>
                        </tr>
                        <tr>
                            <th>@lang('messages.show all petrol status')</th>
                            <th>
                            <a class="btn btn-success" href="{{ route('companypetrol', $com->companies->id) }}">@lang('messages.show')</a>
                            </th>
                        </tr>
                    @endforeach

            </table>

        </div>
    </div>
@endsection
