@extends('adminMain')

@section('title','| Tags')

@section('stylesheets')
    {!! Html::style('css/parsley.css')  !!}
    {!! Html::style('css/admin.css')  !!}
@endsection


@section('content')
    <div class="row">
        <div class="col-mb-8">
            <h1>Tags</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                    <tr>
                        <th>{{ $tag->id }}</th>
                        <td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> <!--- End of col-md-8 -->
        <div class="col-mb-3">
            <div class="well">
                <h1>Add New Tag</h1>
                {!! Form::open(['route' => 'tags.store', 'data-parsley-validate' => '']) !!}
                    {{ Form::label('name', 'Name:' ) }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength'=> '255']) }}

                    {{ Form::submit('Create New Tag', ['class' => 'btn btn-primary btn-block', 'style'=> 'margin-top:20px;']) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('js/parsley.min.js')  !!}
@endsection
