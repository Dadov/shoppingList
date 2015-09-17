@extends('app')
 
@section('content')
    <h2>Edit Product "{{ $product->name }}"</h2>
 
    {!! Form::model($product, ['method' => 'PATCH', 'route' => ['shops.products.update', $shop->slug, $product->slug]]) !!}
        @include('products/partials/_form', ['submit_text' => 'Edit Product'])
    {!! Form::close() !!}
@endsection