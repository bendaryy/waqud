{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         @lang('messages.Dashboard')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout> --}}

@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <a href="{{ route('dashboard') }}" style="text-decoration: none;color:white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">@lang('messages.Dashboard')</h3>
                                    {{-- <p class="text-success ms-2 mb-0 font-weight-medium">+11%</p> --}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">@lang('messages.go to') @lang('messages.Dashboard')</h6>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <a href="{{ route('users.index') }}" style="text-decoration: none;color:white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">@lang('messages.users')</h3>
                                    {{-- <p class="text-success ms-2 mb-0 font-weight-medium">+11%</p> --}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">@lang('messages.go to') @lang('messages.users')</h6>
                    </div>
                </a>
            </div>
        </div>


         <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <a href="{{ route('permissions.index') }}" style="text-decoration: none;color:white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">@lang('messages.permissions')</h3>
                                    {{-- <p class="text-success ms-2 mb-0 font-weight-medium">+11%</p> --}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">@lang('messages.go to') @lang('messages.permissions')</h6>
                    </div>
                </a>
            </div>
        </div>


           <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <a href="{{ route('roles.index') }}" style="text-decoration: none;color:white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">@lang('messages.roles')</h3>
                                    {{-- <p class="text-success ms-2 mb-0 font-weight-medium">+11%</p> --}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">@lang('messages.go to') @lang('messages.roles')</h6>
                    </div>
                </a>
            </div>
        </div>

    </div>
@endsection
