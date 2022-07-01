@extends('layouts.main')

@section('content')
<div class="row text-center">

    @foreach ($companies as $company)
    <div class="card col-lg-4 col-sm-12" style="margin:2px;width: 25rem;">
        <div class="card-body">
            <h4 class="card-title">{{ $company->companies->name }}</h4>
            {{-- <h6 class="card-subtitle mb-2 text-muted">{{ $company->companies->email }}</h6>
            <h6 class="card-subtitle mb-2 text-muted">{{ $company->companies->phone }}</h6>
            <p class="card-text">{{ $company->companies->address }}</p> --}}
            <a href="{{ route('companyUserSection.show',$company->companies->id) }}" class="card-link btn btn-success">@lang('messages.show company details')</a>
            <a href="{{ route('companyCars',$company->companies->id) }}" class="card-link btn btn-success">@lang('messages.show company cars')</a>
        </div>
    </div>
    @endforeach


</div>
@endsection
