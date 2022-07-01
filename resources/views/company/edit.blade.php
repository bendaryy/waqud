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
                        <input type="text"  name="address" value="{{ $company->address }}" class="form-control" id="name">
                    </div>

                      <div class="form-group">
                            <label for="tax_number" class="col-form-label">@lang('messages.taxNumber')</label>
                            <input type="text"  name="tax_number" value="{{ $company->tax_number }}" class="form-control" id="tax_number">
                        </div>

                         <div class="form-group">
                            <label for="segal_togary" class="col-form-label">@lang('messages.segalTogary')</label>
                            <input type="text"  name="segal_togary" value="{{ $company->segal_togary }}" class="form-control" id="segal_togary">
                        </div>


            </div>
            <div class="modal-footer text-center" >
                <button type="submit" class="btn btn-success text-center" style="margin: auto">@lang('messages.edit')</button>
            </div>
            </form>
        </div>
    </div>
@endsection
