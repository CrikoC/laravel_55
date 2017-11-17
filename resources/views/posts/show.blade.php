@extends('adminMain')

@section('stylesheets')
    {!! Html::style('css/admin.css') !!}
@endsection

@section('title', '| View Post')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>{{ $post->title }}</h1></div>
                <div class="panel-body">
                    @if($post->thumbnail)
                        <p><img src="{{ url('images/thumbnails/'.$post->thumbnail) }}"></p>
                    @endif
                    <p class="lead">{!! $post->body !!}</p>
                        <hr>
                        <div class="tag">
                            @foreach($post->tags as $tag)
                                <span class="label label-default">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                        <hr>
                        <div id="backend-comments">
                            <h3>Comments <small>{{ $post->comments()->count() }} total</small></h3>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Comment</th>
                                    <th width="60px"></th>
                                </tr>
                                </head>
                                <tbody>
                                @foreach($post->comments as $comment)
                                    <tr>
                                        <th>{{ $comment->name }}</th>
                                        <td>{{ $comment->email }}</td>
                                        <td>
                                            {{ $comment->comment }}
                                        </td>
                                        <td>
                                            <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                                            <a href="{{ route('comments.delete' , $comment->id) }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>URL:</dt>
                    <dd><a href="{{ route('posts.show', $post->slug) }}">{{ $post->slug }}</a></dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Created At:</dt>
                    <dd>
                        <small>
                            {{ date('M j, Y - h:i a', strtotime($post->created_at)) }}
                        </small>
                    </dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Last Updated:</dt>
                    <dd>
                        <small>
                            {{ date('M j, Y - h:i a', strtotime($post->updated_at)) }}
                        </small>
                    </dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Posted on:</dt>
                    <dd><a href="{{ route('categories.show', $post->category->id) }}">{{ $post->category->name }}</a></dd>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        {!! Html::linkRoute('posts.edit','Edit', [$post->id], ['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="row"><hr></div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('posts.index') }}" class="btn btn-default btn-block">Show all posts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
