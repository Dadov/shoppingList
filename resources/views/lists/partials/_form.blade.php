<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
	{!! Form::label('products', 'Products:') !!}

</div>
@foreach($items as $item)
<div class="form-group">
	{!! Form::label('test', $item->name) !!}
	{!! Form::checkbox($item->slug, $item->id, ($list->products()->where('product_id', $item->id)->exists()), ['onchange' => 'showNumber("'.$item->slug.'")'])!!}
	@if($list->products()->where('product_id', $item->id)->exists())
		{!! Form::input('number', $item->slug, $list->products()->where('product_id', $item->id)->first()->pivot->quantity, ['id' => $item->slug ])!!}
	@else
		{!! Form::input('number', $item->slug, null, ['id' => $item->slug, 'disabled' => true ])!!}
	@endif

</div>
@endforeach
<div class="form-group">
    {!! Form::submit($submit_text, ['class'=>'btn primary']) !!}
    <a href="{{URL::previous()}}" class="btn primary">Cancel</a>
</div>
<script type="text/javascript">
	function showNumber(id) {
		if(document.getElementById(id).disabled == false){
			document.getElementById(id).disabled = true;
			document.getElementById(id).value = "";
		}
		else{
			document.getElementById(id).disabled = false;
		}
	}
</script>