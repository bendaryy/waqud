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
        </div>
        <div class="col-3">
            <button type="button" class="btn btn-success" style="padding: 20px;margin:20px" data-bs-toggle="modal"
                data-bs-target="#addCompany">@lang('messages.addCompany')</button>
        </div>

    </div>

    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header table-card-header">
                    <h4 style="color: white;text-align: center">@lang('messages.companies')</h4>
                </div>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="basic-btn2" class="table table-bordered nowrap" style="color:white;text-align: center">
                            <thead>
                                <tr>
                                    <th id="thead">@lang('messages.Name')</th>
                                    <th id="thead">@lang('messages.Email')</th>
                                    <th id="thead">@lang('messages.phone')</th>
                                    <th id="thead">@lang('messages.companyAddress')</th>
                                    <th id="thead">@lang('messages.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->email }}</td>
                                        <td>{{ $company->phone }}</td>
                                        <td>{{ $company->address }}</td>
                                        <td>
                                            <form method="post" action="{{ route('company.destroy', $company->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button style="padding: 10px" onclick="return confirm('@lang('messages.sure')');"
                                                    class="btn btn-danger">@lang('messages.delete')</button>
                                                    <a  style="padding: 10px" class="btn btn-primary" href="{{ route('company.edit',$company->id) }}">@lang('messages.edit')</a>
                                            </form>
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






    <div class="modal fade" id="addCompany" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">@lang('messages.addNewRole')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('company.store') }}">
                        @method('post')
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">@lang('messages.companyName')</label>
                            <input type="text" required name="name" class="form-control" id="name">
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-form-label">@lang('messages.Email')</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-form-label">@lang('messages.phone')</label>
                            <input type="phone" name="phone" class="form-control" id="phone">
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
