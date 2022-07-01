@extends('layouts.main')

@section('style')
    <style>
       .row {
    --bs-gutter-x: 0rem;
        }

    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12" style="text-align:center;margin: 30px">
            <h3> {{ $company->name }}</h3>

        </div>
    </div>
    <div class="container">

        <div class="row" style="margin: auto">

            @foreach ($cars as $car)
                <div class="card col col-12 col-lg-3 text-center" style="margin:5px;width: 18rem;">
                    @if ($car->image != null)
                        <img src="{{ URL::to($car->image) }}" height="300px" class="card-img-top" alt="...">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}" height="300px" class="card-img-top"
                            alt="...">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">@lang('messages.car brand') : {{ $car->main_car }}</h5>
                        <h5 class="card-title">@lang('messages.car type') : {{ $car->sub_car }}</h5>
                        <h5 class="card-title">@lang('messages.car letters') : {{ $car->car_letters }}</h5>
                        <h5 class="card-title">@lang('messages.car numbers') : {{ $car->car_numbers }}</h5>
                        {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the.
                    </p> --}}
                        <a href="{{ route('carpetrol',$car->id) }}" class="btn btn-primary">متابعة السيارة</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
