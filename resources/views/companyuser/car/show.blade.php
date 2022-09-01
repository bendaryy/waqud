@extends('layouts.main')
@section('style')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend2/files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend2/files/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend2/files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend2/files/assets/pages/data-table/extensions/buttons/css/buttons.dataTables.min.css') }}">

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('backend2/files/assets/css/style.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('backend2/files/assets/css/pages.css') }}">
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

        .dt-button,
        .buttons-copy,
        .buttons-html5 {
            background: black !important;
            color: white !important;
            margin: 10px
        }

        #basic-btn2_wrapper {
            margin: 20px
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row" style="margin: auto">
            <div class="card col-3 text-center" style="width: 23rem;margin:3px">
                <div class="card-body">
                    <h3> @lang('messages.allLitres')</h3> <br>
                    {{ number_format($sumPetrol,2) }}

                </div>
            </div>
            <div class="card col-3 text-center" style="width: 23rem;margin:3px">
                <div class="card-body">
                    <h3> @lang('messages.all_costs')</h3> <br>
                    {{ number_format($sumPaid,2)}}

                </div>
            </div>
            <div class="card col-3 text-center" style="width: 23rem;margin:3px">
                <div class="card-body">
                    <h3> @lang('messages.allKilometers')</h3> <br>
                    {{ number_format($sumAllKilo,2) }}

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" style="text-align: center;margin: 50px">
            @if (Route::is('searchbydate'))
                <div class="col-12" style="margin-bottom: 50px">
                    <h3> @lang('messages.dateFrom') {{ $from }} @lang('messages.dateTo') {{ $to }}</h3>
                </div>
            @else
                <div class="col-6">
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#showDate"
                        aria-expanded="false" aria-controls="showDate">
                        بحث من تاريخ الى تاريخ
                </div>
            @endif

            @if (Route::is('searchbydate'))
                <div class="col-12">
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        @lang('messages.show car details')
                    </button>
                </div>
            @else
                <div class="col-6">
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        @lang('messages.show car details')
                    </button>
                </div>
            @endif


        </div>

        <form action="{{ route('searchbydate', $car->id) }}">
            <div class="row collapse" style="margin:50px" id="showDate">

                </button>
                <div class="col-5">
                    <label for="from" style="text-align: center;margin: auto">من تاريخ</label>
                    <input type="date" class="form-control" name="dateFrom">
                </div>

                <div class="col-5">
                    <label for="from" style="text-align: center;margin: auto">الى تاريخ</label>
                    <input type="date" class="form-control" name="dateTo">
                </div>
                <div class="col-2">
                    <button style="margin-top: 27px" class="btn btn-success" type="submit">بحث</button>
                </div>

            </div>
        </form>

        <p>


        </p>

        <div class="row collapse" style="" id="collapseExample">
            <div class="col-9 grid-margin" style="margin:30px auto; ">
                <div class="card" style="border-radius: 50px">
                    <div class="card-body">
                        <h4 class="card-title text-center">@lang('messages.show car details')</h4>
                        <div class="table-responsive">
                            <table class="table text-center" style="border: none !important">

                                <tr style="border: none !important">
                                    <td style="border: none !important">@lang('messages.companyName') </td>
                                    <td style="border: none !important">{{ $car->companies->name }} </td>
                                </tr>
                                <tr style="border: none !important">
                                    <td style="border: none !important">@lang('messages.car brand') </td>
                                    <td style="border: none !important">{{ $car->main_car }} </td>
                                </tr>

                                <tr style="border: none !important">
                                    <td style="border: none !important">@lang('messages.car type') </td>
                                    <td style="border: none !important">{{ $car->sub_car }} </td>
                                </tr>

                                <tr style="border: none !important">
                                    <td style="border: none !important">@lang('messages.car letters') </td>
                                    <td style="border: none !important">{{ $car->car_letters }} </td>
                                </tr>

                                <tr style="border: none !important">
                                    <td style="border: none !important">@lang('messages.car numbers') </td>
                                    <td style="border: none !important">{{ $car->car_numbers }} </td>
                                </tr>

                                <tr style="border: none !important">
                                    <td style="border: none !important">@lang('messages.car model') </td>
                                    <td style="border: none !important">{{ $car->model }} </td>
                                </tr>
                                <tr style="border: none !important">
                                    <td style="border: none !important">@lang('messages.engine type') </td>
                                    <td style="border: none !important">{{ $car->engine_type }} </td>
                                </tr>



                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            @if (session()->has('success'))
                <div class="alert alert-success"
                    style="background-color: green;text-align: center;color: white;padding: 10px;margin:10px">
                    {{ session('success') }}
                </div>
            @endif



            @if (session()->has('delete'))
                <div class="alert alert-success"
                    style="background-color: red;text-align: center;color: white;padding: 10px;margin:10px">
                    {{ session('delete') }}
                </div>
            @endif
        </div>
        {{-- <div class="col-3">
            <button type="button" class="btn btn-success" style="padding: 20px;margin:20px" data-bs-toggle="modal"
                data-bs-target="#addRole">@lang('messages.addNewRole')</button>
        </div> --}}

    </div>
    @if (Route::is('carpetrol'))
        <a style="padding:10px" class="btn btn-secondary" href="{{ route('carpetrol', $id) }}">@lang('messages.follow petrol all time')</a>
    @else
        <a class="btn btn-success" href="{{ route('carpetrol', $id) }}">@lang('messages.follow petrol all time')</a>
    @endif
    @if (Route::is('carPetrolThisWeek'))
        <a style="padding:10px" class="btn btn-secondary"
            href="{{ route('carPetrolThisWeek', $id) }}">@lang('messages.follow petrol this week')</a>
    @else
        <a class="btn btn-success" href="{{ route('carPetrolThisWeek', $id) }}">@lang('messages.follow petrol this week')</a>
    @endif


    @if (Route::is('carPetrolThisMonth'))
        <a style="padding:10px" class="btn btn-secondary"
            href="{{ route('carPetrolThisMonth', $id) }}">@lang('messages.follow petrol this month')</a>
    @else
        <a class="btn btn-success" href="{{ route('carPetrolThisMonth', $id) }}">@lang('messages.follow petrol this month')</a>
    @endif


    @if (Route::is('carPetrolLastWeek'))
        <a style="padding:10px" class="btn btn-secondary"
            href="{{ route('carPetrolLastWeek', $id) }}">@lang('messages.follow petrol last week')</a>
    @else
        <a class="btn btn-success" href="{{ route('carPetrolLastWeek', $id) }}">@lang('messages.follow petrol last week')</a>
    @endif

    @if (Route::is('carPetrolLastMonth'))
        <a style="padding:10px" class="btn btn-secondary"
            href="{{ route('carPetrolLastMonth', $id) }}">@lang('messages.follow petrol last month')</a>
    @else
        <a class="btn btn-success" href="{{ route('carPetrolLastMonth', $id) }}">@lang('messages.follow petrol last month')</a>
    @endif
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header table-card-header">
                    @if (Route::is('carPetrolThisWeek'))
                        <h4 style="color: white;text-align: center">@lang('messages.follow petrol this week')</h4>
                    @else
                        <h4 style="color: white;text-align: center">@lang('messages.follow petrol')</h4>
                    @endif
                </div>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="basic-btn2" class="table table-bordered nowrap"
                            style="color:white;text-align: center">
                            <thead>
                                <tr>
                                    <th id="thead">@lang('messages.date')</th>
                                    <th id="thead">@lang('messages.station name')</th>
                                    <th id="thead">@lang('messages.liter')</th>
                                    <th id="thead">@lang('messages.price')</th>
                                    <th id="thead">@lang('messages.ekramyat')</th>
                                    <th id="thead">@lang('messages.all_costs')</th>
                                    <th id="thead">@lang('messages.kilometres')</th>
                                    <th id="thead">@lang('messages.consumption rate')</th>
                                    {{-- <th id="thead">@lang('messages.Consumption rate per plate')</th>
                                    <th id="thead">@lang('messages.Consumption rate per 100 kilo')</th>
                                    <th id="thead">@lang('messages.kilos per liter')</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($petrols as $index => $petrol)
                                    <tr>
                                        <td> {{ Carbon\Carbon::parse($petrol->created_at)->format('d-m-Y') }}</td>
                                        @if ($petrol->user_id == null)
                                            <td></td>
                                        @else
                                            <td>{{ $petrol->user['name'] }}</td>
                                        @endif
                                        <td>{{ $petrol->litre }}</td>
                                        <td>{{ $petrol->pound }}</td>
                                        <td>{{ $petrol->ekramyat }}</td>

                                        <td>{{ $petrol->all_costs }}</td>
                                        {{-- @if ($petrol->kiloNumbers == null)
                                            <td> <a class="btn btn-success" style="padding:10px"
                                                    href="{{ route('kilopetrol', $petrol->id) }}">@lang('messages.add kilometres')</a>
                                            </td>
                                        @else --}}
                                        <td>{{ $petrol->all_kilometers }}</td>
                                        {{-- @endif --}}
                                        {{-- <td>{{ $petrol->safy7aNumbers }}</td>
                                        <td>{{ $petrol->hundredNumbers }}</td>
                                        <td>{{ $petrol->kilosperliter }}</td> --}}

                                        <td>{{ isset( $petrols[$index - 1]) ? number_format(($petrols[$index - 1]['all_kilometers'] - $petrol->all_kilometers) / $petrol->litre,2): "" }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">@lang('messages.addNewRole')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <form method="post" action="{{ route('roles.store') }}">
                        @method('post')
                        @csrf
                        <div class="form-group">
                            <label for="role-name" class="col-form-label">@lang('messages.roleName')</label>
                            <input type="text" name="name" class="form-control" id="role-name">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">@lang('messages.submit')</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">@lang('messages.close')</button>
                </div>
                </form> --}}
                </div>
            </div>
        </div>
    @endsection



    @section('script')
        <script src="{{ asset('backend2/files/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('backend2/files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}">
        </script>
        <script src="{{ asset('backend2/files/assets/pages/data-table/js/jszip.min.js') }}"></script>
        <script src="{{ asset('backend2/files/assets/pages/data-table/js/pdfmake.min.js') }}"></script>
        <script src="{{ asset('backend2/files/assets/pages/data-table/js/vfs_fonts.js') }}"></script>
        <script src="{{ asset('backend2/files/assets/pages/data-table/extensions/buttons/js/dataTables.buttons.min.js') }}">
        </script>
        <script src="{{ asset('backend2/files/assets/pages/data-table/extensions/buttons/js/buttons.flash.min.js') }}">
        </script>
        <script src="{{ asset('backend2/files/assets/pages/data-table/extensions/buttons/js/jszip.min.js') }}"></script>
        <script src="{{ asset('backend2/files/assets/pages/data-table/extensions/buttons/js/vfs_fonts.js') }}"></script>
        <script src="{{ asset('backend2/files/assets/pages/data-table/extensions/buttons/js/buttons.colVis.min.js') }}">
        </script>
        <script src="{{ asset('backend2/files/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('backend2/files/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('backend2/files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}">
        </script>
        {{-- <script src="{{ asset('backend2/files/assets/pages/data-table/extensions/buttons/js/extension-btns-custom.js') }}">
    </script> --}}
        <script type="text/javascript" src="{{ asset('backend2/files/assets/js/script.js') }}"></script>
        <script>
            $("#basic-btn2").DataTable({
                dom: "Bfrtip",
                buttons: ["copy", "csv", "excel"],
                ordering: false
            });
        </script>
        <script></script>
    @endsection
