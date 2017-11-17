@extends('adminMain')

@section('title', '| $category->name Category')

@section('stylesheets')
    {!! Html::style('css/parsley.css')  !!}
    {!! Html::style('css/select2.min.css')  !!}
    {!! Html::style('css/admin.css') !!}
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector:'textarea',
            toolbars: "image",
            plugins: "link, code image imagetools",
        });
    </script>
@endsection

@section('content')
    <div class="row">
        {{ Form::model($category, ['route'=>['categories.update', $category->id],  'method' =>'PUT']) }}
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Edit {{ $category->name }}</h1>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <label for="name"><i class="fa fa-id-card" aria-hidden="true"></i></label>
                            </div>
                            {{ Form::text('name', null, ['placeholder' => 'Name of the category' ,'class' => 'form-control', 'required' => '', 'maxlength'=> '255']) }}
                            <div class="input-group-addon"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <label  for="slug"><i class="fa fa-laptop" aria-hidden="true"></i></label>
                            </div>
                            {{ Form::text('slug', null, ['placeholder' => 'Computer friendly name', 'class' => 'form-control', 'required' => '', 'maxlength'=> '255']) }}
                            <div class="input-group-addon"></div>
                        </div>
                    </div>
                    <hr>
                    {{ Form::textarea('body', null, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="well">
                {{ Form::label('parent_id', 'Parent:' ) }}
                <select class="form-control" name="parent_id">
                    <option value="{{ $category->parent['id'] }}">{{ $category->parent['name'] }}</option>
                    @foreach($parents as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                    @endforeach
                </select>
                <hr>
                <dl class="dl-horizontal">
                    <dt>Created At:</dt>
                    <dd>
                        <small>
                            {{ date('M j, Y - h:i a', strtotime($category->created_at)) }}
                        </small>
                    </dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Last Updated:</dt>
                    <dd>
                        <small>
                            {{ date('M j, Y - h:i a', strtotime($category->updated_at)) }}
                        </small>
                    </dd>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        {!! Html::linkRoute('categories.show','Cancel', [$category->id], ['class' => 'btn btn-danger btn-block']) !!}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection
