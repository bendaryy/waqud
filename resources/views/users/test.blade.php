@foreach ($companies as $company )
    @foreach ($company->users as $c )
    {{ $c->pivot->user_id }}
    @endforeach



@endforeach
