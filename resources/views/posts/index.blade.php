@extends('adminMain')
@section('title', '| All Posts')
@section('stylesheets')
    {!! Html::style('css/admin.css') !!}
@endsection
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12">
                    <h1>All Posts <a href="{{ route('posts.create') }}" class="btn btn-success""><span class="glyphicon glyphicon-import"></span>&nbsp;Add New</a></h1>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Thumbnail</th>
                            <th width="250"></th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($posts as $post)
                                <tr>
                                    <th>{{ $i++ }}</th>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->category['name'] }}</td>
                                    <td><img src="{{url("images/thumbnails/".$post->thumbnail) }}" width="100"></td>
                                    <td>
                                        <a class="btn btn-warning" href="{{ route('posts.show', $post->id) }}"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;View</a>
                                        <a class="btn btn-primary" href="{{ route('posts.edit', $post->id) }}"><span class="glyphicon glyphicon-edit"></span>&nbsp;Edit</a>
                                        <a class="btn btn-danger" href="{{ route('posts.destroy',$post->id) }}"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
