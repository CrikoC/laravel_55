@extends('adminMain')

@section('title','| Create Category')

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
        {!! Form::open(['route' => 'categories.store', 'data-parsley-validate' => '']) !!}
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Add New Category</h1>
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
                <div class="row">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                {{ Form::label('parent_id', 'Parent:', ['placeholder'=>'Parent Category'] ) }}
                            </div>
                            <select class="form-control" name="parent_id">
                                <option value="0"></option>
                                @foreach($parents as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                <div class="row"><hr></div>
                <div class="row">
                    <div class="col-sm-6">
                        {{ Form::submit('Create Category', ['class' => 'btn btn-success btn-block']) }}
                    </div>
                    <div class="col-sm-6">
                        <a class="btn btn-danger btn-block" href="{{route('categories.index')}}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

