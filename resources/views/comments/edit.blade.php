@extends('adminMain')

@section('title', '| Edit Comment')

@section('stylesheets')
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
        <h3>Edit Comment</h3>
        {!! Form::model($comment, ['route' => ['comments.update', $comment->id], 'method'=> 'PUT']) !!}
            <div class="col-md-8">
                {{ Form::label('name', 'Name:') }}
                {{ Form::text("name", null, ['class' => 'form-control input' , 'disabled' => 'disabled']) }}

                {{ Form::label('email', 'Email:', ['class' => 'form-spacing-top']) }}
                {{ Form::text('email', null, ['class' => 'form-control' , 'disabled' => 'disabled']) }}

                {{ Form::label('comment', 'Comment:', ['class' => 'form-spacing-top']) }}
                {{ Form::textarea('comment', null, ['class' => 'form-control']) }}
            </div>
            <div class="col-md-4">
                <div class="well">
                    <dl class="dl-horizontal">
                        <dt>Created At:</dt>
                        <dd>{{ date('M j, Y - h:i a', strtotime($comment->created_at)) }}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Last Updated:</dt>
                        <dd>{{ date('M j, Y - h:i a', strtotime($comment->updated_at)) }}</dd>
                    </dl>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Html::linkRoute('posts.show','Cancel', [$comment->post_id], ['class' => 'btn btn-danger btn-block']) !!}
                        </div>
                        <div class="col-sm-6">
                            {{ Form::submit('Update Comment', ['class' => 'btn btn-success btn-block']) }}
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection
