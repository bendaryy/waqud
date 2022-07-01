@extends('layouts.main')

@section('content')
    <div class="container">

        <div class="row text-center">

            @foreach ($petrols as $petrol)
                <div class="card col-lg-4 col-sm-12" style="margin:2px;width: 25rem;">
                    <div class="card-body">
                        <h4 class="card-title">{{ $petrol->company->name }}</h4>
                        {{-- <a href="{{ route('companyUserSection.show', $petrol->company->id) }}"
                            class="card-link btn btn-success">@lang('messages.show company details')</a> --}}
                        <a href="{{ route('companyCars', $petrol->company->id) }}"
                            class="card-link btn btn-success">@lang('messages.show company cars')</a>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
@endsection
