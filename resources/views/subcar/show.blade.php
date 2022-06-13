@extends('layouts.main')

@section('style')
    <style>
        table,
        td,
        tr,
        th,
        #thead {
            border: 1px solid #aaa !important;
            color: white;
            opacity: 0.9;
        }

        td,
        th {
            padding: 20px !important;
        }

        th {
            font-size: 20px !important;
        }
    </style>
@endsection

@section('content')
    <div class="col-12">
        <div style="margin:30px auto;text-align: center">

            <img id='barcode'
            src="https://api.qrserver.com/v1/create-qr-code/?data={{ URL::current() }}&amp;size=200x200"
            alt="" title="HELLO"  />
        </div>

        <table style="margin: auto;text-align: center;width:100%">
            <tr>
                <th>@lang('messages.companyName')</th>
                <td> {{ $subCar->companies->name }}</td>
            </tr>
            <tr>
                <th>@lang('messages.carId')</th>
                <td> {{ $subCar->id }}</td>
            </tr>
            <tr>
                <th>@lang('messages.car type')</th>
                <td> {{ $subCar->main_car }}</td>
            </tr>
            <tr>
                <th>@lang('messages.car name')</th>
                <td> {{ $subCar->sub_car }}</td>
            </tr>
            <tr>
                <th>@lang('messages.car letters')</th>
                <td> {{ $subCar->car_letters }}</td>
            </tr>
            <tr>
                <th>@lang('messages.car numbers')</th>
                <td> {{ $subCar->car_numbers }}</td>
            </tr>
            <tr>
                <th>@lang('messages.car model')</th>
                <td> {{ $subCar->model }}</td>
            </tr>
            <tr>
                <th>@lang('messages.engine type')</th>
                <td> {{ $subCar->engine_type }}</td>
            </tr>
            <tr>
                <th>@lang('messages.car image')</th>
                <td>
                    <a href="{{ url($subCar->image) }}" target="_blank">
                        <img src="{{ url($subCar->image) }}" width=300 height=300 alt="car image">
                    </a>
                </td>
            </tr>

        </table>

        {{-- <img id='barcode' src="https://api.qrserver.com/v1/create-qr-code/?data={{ url("public/storage/$proposal->file") }}&amp;size=100x100" --}}



    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function generateBarCode() {
            var nric = $('#text').val();
            var url = 'https://api.qrserver.com/v1/create-qr-code/?data=' + nric + '&amp;size=50x50';
            $('#barcode').attr('src', url);
        }
    </script>
@endsection
