@extends('adminMain')
<?php $nameTag = htmlspecialchars($category->name); ?>
@section('title', '| $nameTag Category')

@section('stylesheets')
    {!! Html::style('css/admin.css') !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="page-header">{{ $category->name }} <small>{{ $category->posts()->count() }} Posts</small></h1>
                    </div>
                    <div class="panel-body">
                        {!! $category->body !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="well">
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
                            {!! Html::linkRoute('categories.edit','Edit', [$category->id], ['class' => 'btn btn-primary btn-block']) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::open(['route' => ['posts.destroy', $category->id], 'method' => 'DELETE']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="row"><hr></div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('categories.index') }}" class="btn btn-default btn-block">Show all categories</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Posts</h1>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($category->posts as $post)
                                <tr>
                                    <th>{{ $post->id }}</th>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-sm">View</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
