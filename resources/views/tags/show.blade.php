@extends('adminMain')
<?php $nameTag = htmlspecialchars($tag->name); ?>
@section('title', '| $nameTag Tag')

@section('stylesheets')
    {!! Html::style('css/admin.css')  !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>{{ $tag->name }} <small>{{ $tag->posts()->count() }} Posts</small></h1>
        </div>
        <div class="col-md-2">
            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary btn-block pull-right" style="margin-top:20px;">Edit</a>
        </div>
        <div class="col-md-2">
            {{ Form::open(['route'=>['tags.destroy', $tag->id,], 'method' => 'DELETE']) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block', 'style' => 'margin-top:20px']) }}
            {{ Form::close() }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Posts</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Tags</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tag->posts as $post)
                        <tr>
                            <th>{{ $post->id }}</th>
                            <td>{{ $post->title }}</td>
                            <td>
                                @foreach($post->tags as $tag)
                                    <a href="{{ route('tags.show', $tag->id) }}"><span class="label label-default">{{ $tag->name }}</span></a>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
