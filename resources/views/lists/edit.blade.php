@extends('app')
 
@section('content')
    <h2>Edit shopping list "{{ $list->name }}"</h2>
 
    {!! Form::model($list, ['method' => 'PATCH', 'route' => ['shops.lists.update', $shop->slug, $list->slug]]) !!}
        @include('lists/partials/_form', ['submit_text' => 'Edit shopping list', 'items' => $shop->products, 'slist' => $list])
    {!! Form::close() !!}
@endsection