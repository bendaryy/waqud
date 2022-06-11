@extends('layouts.main')
@section('content')

<div class="col-12">

        <div class="col-6" style="margin:auto">

            <form method="post" action="{{ route('roles.store') }}">
                @method('post')
                @csrf
                <div class="form-group text-center">
                    <label for="exampleInputEmail1">اسم القاعدة</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="إسم القاعدة" name="name">
                </div>

                <div style="text-align:center">

                    <button type="submit" class="btn btn-primary">إضافة</button>
                </div>
            </form>

        </div>
    </div>

@endsection
