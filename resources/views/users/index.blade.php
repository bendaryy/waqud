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


    </div>

    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header table-card-header">
                    <h4 style="color: white;text-align: center">@lang('messages.users')</h4>
                </div>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="basic-btn2" class="table table-bordered nowrap" style="color:white;text-align: center">
                            <thead>
                                <tr>
                                    <th id="thead">@lang('messages.Name')</th>
                                    <th id="thead">@lang('messages.Email')</th>
                                    <th id="thead">@lang('messages.phone')</th>
                                    <th id="thead">@lang('messages.address')</th>
                                    <th id="thead">@lang('messages.action')</th>
                                    <th id="thead">@lang('messages.delete')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user)
                                    @if (!$user->hasRole('super_admin'))
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>
                                                <a class="btn btn-secondary" style="padding: 10px"
                                                    href="{{ route('users.edit', $user->id) }}">@lang('messages.edit')</a>
                                                <a class="btn btn-info" style="padding: 10px"
                                                    href="{{ route('AddsyncCompany', $user->id) }}">@lang('messages.addCompanyUser')</a>
                                                <a class="btn btn-danger" style="padding: 10px"
                                                    href="{{ route('EditDetachCompany', $user->id) }}">@lang('messages.deleteCompanyUser')</a>
                                            </td>
                                            <td>
                                                <form method="post" action={{ route('users.destroy', $user->id) }}>
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger" style="padding: 10px"
                                                        onclick="return confirm('@lang('messages.sure')');">@lang('messages.delete user')</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
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
                    <form method="post" action="{{ route('roles.store') }}">
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
    {{-- <script src="{{ asset('backend2/files/assets/pages/data-table/extensions/buttons/js/extension-btns-custom.js') }}"> --}}
    </script>
    {{-- <script type="text/javascript" src="{{ asset('backend2/files/assets/js/script.js') }}"></script> --}}
    <script>
        $("#basic-btn2").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel"],

        });
    </script>
    <script></script>
@endsection
