@extends('layouts.main')
@section('content')
@foreach ($petrols as $petrol)
    {{ $petrol }}
@endforeach
@endsection
