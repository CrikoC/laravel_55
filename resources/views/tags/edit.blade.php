@extends('main')

@section('title', '| $tag->name Tag')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>Edit {{ $tag->name }}</h1>
            {{ Form::model($tag, ['route'=>['tags.update', $tag->id],  'method' =>'PUT']) }}
                {{ Form::label('name', 'Title:') }}
                {{ Form::text('name', null, ['class'=>'form-control']) }}
                <br/>
                {{ Form::submit('Save changes', ['class'=>'btn btn-primary btn-block']) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection
