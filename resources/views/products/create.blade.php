@extends('app')
 
@section('content')
    <h2>Register Product for "{{ $shop->name }}"</h2>
 
    {!! Form::model(new App\Task, ['route' => ['shops.products.store', $shop->slug], 'class'=>'']) !!}
        @include('products/partials/_form', ['submit_text' => 'Register Product'])
    {!! Form::close() !!}
@endsection