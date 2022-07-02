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
        {{-- <div class="row">
            <div class="col-9" style="margin: auto">
              <span>@lang('messages.car letters') :  {{ $car->car_letters }}</span></br>
              <span>@lang('messages.car numbers') :  {{ $car->car_numbers }}</span></br>
              <span>@lang('messages.car brand') :  {{ $car->main_car }}</span></br>
              <span>@lang('messages.car type') :  {{ $car->sub_car }}</span></br>
              <span>@lang('messages.car model') :  {{ $car->model }}</span></br>
            </div>
        </div> --}}

        <div class="row" style="">
            <div class="col-9 grid-margin" style="margin:30px auto; ">
                <div class="card" style="border-radius: 50px">
                    <div class="card-body">
                        <h4 class="card-title text-center">@lang('messages.show car details')</h4>
                        <div class="table-responsive">
                            <table class="table text-center" style="border: none !important">

                                    <tr style="border: none !important">
                                        <td style="border: none !important">@lang('messages.companyName') </td>
                                        <td style="border: none !important">{{$car->companies->name}} </td>
                                    </tr>
                                    <tr style="border: none !important">
                                        <td style="border: none !important">@lang('messages.car brand') </td>
                                        <td style="border: none !important">{{$car->main_car}} </td>
                                    </tr>

                                    <tr style="border: none !important">
                                        <td style="border: none !important">@lang('messages.car type') </td>
                                        <td style="border: none !important">{{$car->sub_car}} </td>
                                    </tr>

                                    <tr style="border: none !important">
                                        <td style="border: none !important">@lang('messages.car letters') </td>
                                        <td style="border: none !important">{{$car->car_letters}} </td>
                                    </tr>

                                    <tr style="border: none !important">
                                        <td style="border: none !important">@lang('messages.car numbers') </td>
                                        <td style="border: none !important">{{$car->car_numbers}} </td>
                                    </tr>

                                    <tr style="border: none !important">
                                        <td style="border: none !important">@lang('messages.car model') </td>
                                        <td style="border: none !important">{{$car->model}} </td>
                                    </tr>
                                    <tr style="border: none !important">
                                        <td style="border: none !important">@lang('messages.engine type') </td>
                                        <td style="border: none !important">{{$car->engine_type}} </td>
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

    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header table-card-header">
                    <h4 style="color: white;text-align: center">@lang('messages.follow petrol')</h4>
                </div>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="basic-btn2" class="table table-bordered nowrap" style="color:white;text-align: center">
                            <thead>
                                <tr>
                                    <th id="thead">@lang('messages.date')</th>
                                    <th id="thead">@lang('messages.liter')</th>
                                    <th id="thead">@lang('messages.price')</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($petrols as $petrol)
                                    <tr>
                                        <td> {{ Carbon\Carbon::parse($petrol->created_at)->format('d-m-Y') }}</td>
                                        <td>{{ $petrol->litre }}</td>
                                        <td>{{ $petrol->pound }}</td>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
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

            });
        </script>
        <script></script>
    @endsection