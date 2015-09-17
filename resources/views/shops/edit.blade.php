@extends('app')
 
@section('content')
    <h2>Edit Shop</h2>
 
    {!! Form::model($shop, ['method' => 'PATCH', 'route' => ['shops.update', $shop->slug]]) !!}
        @include('shops/partials/_form', ['submit_text' => 'Edit Shop'])
    {!! Form::close() !!}
@endsection