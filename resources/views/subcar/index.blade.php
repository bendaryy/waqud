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


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>


    </div>

    <div class="row">
        <div class="col-3">
            <button type="button" class="btn btn-success" style="padding: 20px;margin:20px" data-bs-toggle="modal"
                data-bs-target="#addRole">@lang('messages.addNewCompanyCars')</button>
        </div>
        <div class="col-12">

            <div class="card">
                <div class="card-header table-card-header">
                    <h4 style="color: white;text-align: center">@lang('messages.companyCars')</h4>
                </div>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="basic-btn2" class="table table-bordered nowrap" style="color:white;text-align: center">
                            <thead>
                                <tr>
                                    <th id="thead">@lang('messages.companyName')</th>
                                    <th id="thead">@lang('messages.mainCars')</th>
                                    <th id="thead">@lang('messages.car name')</th>
                                    <th id="thead">@lang('messages.car letters')</th>
                                    <th id="thead">@lang('messages.car numbers')</th>
                                    <th id="thead">@lang('messages.average')</th>
                                    <th id="thead">@lang('messages.car model')</th>
                                    <th id="thead">@lang('messages.engine type')</th>
                                    <th id="thead">@lang('messages.image')</th>
                                    <th id="thead">@lang('messages.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subCars as $car)
                                    <tr>
                                        <td>{{ $car->companies->name }}</td>
                                        <td>{{ $car->main_car }}</td>
                                        <td>{{ $car->sub_car }}</td>
                                        <td>{{ $car->car_letters }}</td>
                                        <td>{{ $car->car_numbers }}</td>
                                        <td>{{ $car->average }}</td>
                                        <td>{{ $car->model }}</td>
                                        <td>{{ $car->engine_type }}</td>
                                        <td>
                                            @if ($car->image != null)
                                                <a href="{{ url($car->image) }}" target="_blank">
                                                    <img src="{{ url($car->image) }}" alt="car image">

                                                </a>
                                            @else
                                                <p>@lang('messages.no car')</p>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- <a class="btn btn-secondary" style="padding: 10px" href="{{ route('users.edit',$user->id) }}">@lang('messages.edit')</a>
                                        <a class="btn btn-info" style="padding: 10px" href="{{ route('AddsyncCompany',$user->id) }}">@lang('messages.addCompanyUser')</a> --}}
                                            <form method="POST" action="{{ route('subcar.destroy', $car->id) }}" style="display: inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger" style="padding: 10px"
                                                    onclick="return confirm('@lang('messages.sure')');">@lang('messages.delete')</button>
                                            </form>
                                            {{-- <a class="btn btn-primary" style="padding:10px" href="{{URL::route('subcar.show', [$car->id, $car->company] )}}">show</a> --}}
                                            <a class="btn btn-primary" style="padding:10px" href="{{ route('subcar.show',[$car->id,$car->company,$car->car_letters,$car->car_numbers,$car->sub_car]) }}">@lang('messages.show car details')</a>
                                            <a class="btn btn-secondary" style="padding:10px" href="{{ route('subcar.edit',$car->id) }}">@lang('messages.edit')</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <div class="modal fade" id="addRole" role="dialog" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">@lang('messages.companyCars')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('subcar.store') }}" enctype="multipart/form-data">
                        @method('post')
                        @csrf

                        <div class="form-group">
                            <label>@lang('messages.companyName')</label>
                            <select class="js-example-basic-single" style="width:100%" required name="company">
                                @foreach ($companyUser as $company)
                                    <option value="{{ $company->companies->id }}">
                                        {{ $company->companies->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label>@lang('messages.car type')</label>
                            <select class="js-example-basic-single2" style="width:100%" name="main_car">
                                @foreach ($mainCars as $car)
                                    <option value="{{ $car->name }}">
                                        {{ $car->name }}</option>
                                @endforeach
                            </select>
                            @error('main_car')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="carName" class="col-form-label">@lang('messages.car name')</label>
                            <input type="text" name="sub_car" class="form-control" id="carName">
                            @error('sub_car')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="carName" class="col-form-label">@lang('messages.car letters')</label>
                            <input type="text" name="car_letters" class="form-control" id="carName">
                            @error('car_letters')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="carName" class="col-form-label">@lang('messages.car numbers')</label>
                            <input type="number" name="car_numbers" class="form-control" id="carName">
                            @error('car_numbers')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="average" class="col-form-label">@lang('messages.average')</label>
                            <input type="number" name="average" class="form-control" id="average">
                            @error('average')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>




                        <div class="form-group">
                            <label for="model" class="col-form-label">@lang('messages.car model')</label>
                            <input type="number" name="model" class="form-control" id="model">
                        </div>

                        <div class="form-group">
                            <label for="engineType" class="col-form-label">@lang('messages.engine type')</label>
                            <input type="text" name="engine_type" class="form-control" id="engineType">
                        </div>

                        <div class="form-group">
                            <label>@lang('messages.upload image')</label>
                            <input type="file" name="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary"
                                        type="button">@lang('messages.upload image')</button>
                                </span>
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">@lang('messages.submit')</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">@lang('messages.close')</button>
                </div>
                </form>
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    {{-- <script src="{{ asset('backend2/files/assets/pages/data-table/extensions/buttons/js/extension-btns-custom.js') }}"> --}}
    </script>
    {{-- <script type="text/javascript" src="{{ asset('backend2/files/assets/js/script.js') }}"></script> --}}
    <script>
        $("#basic-btn2").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel"],

        });
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                dropdownParent: $('#addRole')
            });
        });
        $(document).ready(function() {
            $('.js-example-basic-single2').select2({
                dropdownParent: $('#addRole')
            });
        });
    </script>
@endsection
