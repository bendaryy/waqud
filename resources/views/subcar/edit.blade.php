@extends('layouts.main')

@section('content')
    <div class="container">
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
            <div class="col-9" style="margin: auto;text-align: center">

                <h3>{{ $subcar->companies->name }}</h3>

                <div class="modal-body">
                    <form method="post" action="{{ route('subcar.update', $subcar->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf


                        <div class="form-group">
                            <label for="carName" class="col-form-label">@lang('messages.car type')</label>
                            <input type="text" readonly name="main_car" style="text-align: center;background-color: #aaa" value="{{ $subcar->main_car }}" class="form-control"
                                id="carName">
                            @error('sub_car')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="carName" class="col-form-label">@lang('messages.car name')</label>
                            <input type="text" readonly name="sub_car" style="text-align: center;background-color: #aaa" value="{{ $subcar->sub_car }}" class="form-control"
                                id="carName">
                            @error('sub_car')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="carName" class="col-form-label">@lang('messages.average')</label>
                            <input type="text"  name="average" style="text-align: center" value="{{ $subcar->average }}" class="form-control"
                                id="carName">
                            @error('sub_car')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="carLetters" class="col-form-label">@lang('messages.car letters')</label>
                            <input type="text" style="text-align: center" value="{{ $subcar->car_letters }}" name="car_letters" class="form-control" id="carName">
                            @error('car_letters')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="carName" class="col-form-label">@lang('messages.car numbers')</label>
                            <input type="number" style="text-align: center" value="{{ $subcar->car_numbers }}"  name="car_numbers" class="form-control" id="carName">
                            @error('car_numbers')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>




                        <div class="form-group">
                            <label for="model" class="col-form-label">@lang('messages.car model')</label>
                            <input type="number" style="text-align: center" value="{{ $subcar->model }}" name="model" class="form-control" id="model">
                        </div>

                        <div class="form-group">
                            <label for="engineType" class="col-form-label">@lang('messages.engine type')</label>
                            <input type="text" style="text-align: center" value="{{ $subcar->engine_type }}" name="engine_type" class="form-control" id="engineType">
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
                        @if(isset($subcar->image))
                        <img src="{{ url($subcar->image) }}" alt="لا يوجد صورة للسيارة">
                        @else
                        <h3>لا يوجد صورة للسيارة</h3>
                        @endif

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">@lang('messages.edit')</button>
                </div>
                </form>

            </div>
        </div>
    </div>
@endsection
