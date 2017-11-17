@extends('adminMain')
@section('title','| Categories')
@section('stylesheets')
    {!! Html::style('css/parsley.css')  !!}
    {!! Html::style('css/admin.css') !!}
@endsection
@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h1>All Categories <a href="{{ route('categories.create') }}" class="btn btn-success""><span class="glyphicon glyphicon-import"></span>&nbsp;Add New</a></h1></h1>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <th>#</th>
                        <th>Title</th>
                        <th>Body</th>
                        <th>Parent</th>
                        <th>Created At</th>
                        <th width="250"></th>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <th>{{ $category->id }}</th>
                                <td>{{ $category->name }}</td>
                                <td>
                                    {{ substr(strip_tags($category->body), 0, 50 ) }}
                                    {{ strlen(strip_tags($category->body)) > 50 ? '...' : '' }}
                                </td>
                                <td>{{ $category->parent['name'] }}</td>
                                <td>{{ date('M j, Y - h:i a',strtotime($category->created_at)) }}</td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('categories.show', $category->id) }}"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;View</a>
                                    <a class="btn btn-primary" href="{{ route('categories.edit', $category->id) }}"><span class="glyphicon glyphicon-edit"></span>&nbsp;Edit</a>
                                    <a class="btn btn-danger" href="{{ route('categories.destroy',$category->id) }}"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! Html::script('js/parsley.min.js')  !!}
@endsection
