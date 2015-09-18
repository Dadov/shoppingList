@extends('app')
 
@section('content')
    <h2>Create shopping list for "{{ $shop->name }}"</h2>
 
    {!! Form::model(new App\Product, ['route' => ['shops.lists.store', $shop->slug], 'class'=>'']) !!}
        @include('lists/partials/_form', ['submit_text' => 'Create shopping list', 'items' => $shop->products->lists('name','id')])
    {!! Form::close() !!}
@endsection