@extends('layouts.main')

@section('content')
    <div class="col-3" style="margin:auto">



        <form method="post" action="{{ route('companyUserSection.update',$petrol->id) }}">

            @method('PUT')
            @csrf



            <div class="form-group">
                <label for="carName" class="col-form-label">@lang('messages.car name')</label>
                <p class="form-control text-center">{{ $petrol->car->sub_car }}</p>


            </div>


            <div class="form-group">
                <label for="carName" class="col-form-label">@lang('messages.car letters')</label>
                <p class="form-control text-center">{{ $petrol->car->car_letters }}</p>
            </div>

            <div class="form-group">
                <label for="carName" class="col-form-label">@lang('messages.car numbers')</label>
                <p class="form-control text-center">{{ $petrol->car->car_numbers }}</p>
            </div>



            <div class="form-group">
                <label for="engineType" class="col-form-label">@lang('messages.liter')</label>
                <input type="text" readonly id="litre" value="{{ $petrol->litre }}" style="background-color:#222"
                    class="form-control">
            </div>
            <div class="form-group">
                <label for="engineType" class="col-form-label">@lang('messages.date')</label>
                <input type="date" name="created_at"  id="created_at" value="{{ Carbon\Carbon::parse($petrol['created_at'])->format('Y-m-d') }}" style="background-color:#222"
                    class="form-control">
            </div>


            <div class="form-group">
                <label for="model" class="col-form-label">@lang('messages.kilometres')</label>
                <input type="number" required onkeyup="proccess(this.value),safyha(), hundredKilo()" onmouseover="proccess(this.value),safyha(), hundredKilo()"
                    name="kiloNumbers" class="form-control" id="kiloNumbers">
            </div>

            <div class="form-group">
                <label for="engineType" class="col-form-label">@lang('messages.kilos per liter')</label>
                <input readonly id="kiloLiters" name="kilosperliter" style="background-color:#222" class="form-control">
            </div>

            <div class="form-group">
                <label for="engineType" class="col-form-label">@lang('messages.kilos per safy7a')</label>
                <input readonly id="safy7a" name="safy7aNumbers" style="background-color:#222" class="form-control">
            </div>

            <div class="form-group">
                <label for="engineType" class="col-form-label">@lang('messages.litres per 100 kilo')</label>
                <input readonly id="hundredNumbers" name="hundredNumbers" style="background-color:#222" class="form-control">
            </div>



    </div>
    <div class="modal-footer" style="justify-content: center">
        <button type="submit" class="btn btn-success">@lang('messages.edit')</button>
    </div>
    </form>
    </div>

    <script>
        function proccess(value) {
            var x, y, z;
            var litre = document.getElementById("litre").value;
            y = value / litre;
            document.getElementById("kiloLiters").value = y.toFixed(2);
        };

        function safyha() {
            var x, y, z;
            var kilo = document.getElementById("kiloLiters").value;
            y = kilo * 20;
            document.getElementById("safy7a").value = y.toFixed(2);
        };
        function hundredKilo() {
            var x, y, z;
            var kilo = document.getElementById("kiloLiters").value;
            y = 100 / kilo;
            document.getElementById("hundredNumbers").value = y.toFixed(2);
        };
    </script>
@endsection
