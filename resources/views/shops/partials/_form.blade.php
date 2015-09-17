<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name') !!}
</div>
<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug') !!}
</div>
<div class="form-group">
    {!! Form::label('latitude', 'Latitude:') !!}
    {!! Form::text('latitude') !!}
</div>
<div class="form-group">
    {!! Form::label('longitude', 'Longitude:') !!}
    {!! Form::text('longitude') !!}
</div>
<div class="form-group">
    {!! Form::submit($submit_text, ['class'=>'btn primary']) !!}
</div>