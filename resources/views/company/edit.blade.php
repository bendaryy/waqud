@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <h5 class="modal-title text-center" id="ModalLabel">{{ $company->name }}</h5>


            <div class="modal-body">
                <form method="post" action="{{ route('company.update',$company->id) }}">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-form-label">@lang('messages.companyName')</label>
                        <input type="text" required name="name" value="{{ $company->name }}" class="form-control" id="name">
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-form-label">@lang('messages.Email')</label>
                        <input type="email" name="email" value="{{ $company->email }}" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-form-label">@lang('messages.phone')</label>
                        <input type="phone" name="phone" value="{{ $company->phone }}" class="form-control" id="phone">
                    </div>

                     <div class="form-group">
                        <label for="address" class="col-form-label">@lang('messages.companyAddress')</label>
                        <input type="text" required name="address" value="{{ $company->address }}" class="form-control" id="name">
                    </div>


            </div>
            <div class="modal-footer text-center" >
                <button type="submit" class="btn btn-success text-center" style="margin: auto">@lang('messages.edit')</button>
            </div>
            </form>
        </div>
    </div>
@endsection
