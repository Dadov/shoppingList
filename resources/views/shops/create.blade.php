@extends('app')
 
@section('content')
   <h2>Register Shop</h2>
 
    {!! Form::model(new App\Shop, ['route' => ['shops.store']]) !!}
        @include('shops/partials/_form', ['submit_text' => 'Register Shop'])
    {!! Form::close() !!}
@endsection