@extends('adminMain')

@section('stylesheets')
    {{ Html::style('css/admin.css') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="modal-header">Dashboard</h1>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>
                            <span class="glyphicon glyphicon-list-alt"></span>
                            At a glance
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>
                                    <span class="glyphicon glyphicon-th-list"></span><a href="{{ route('categories.index') }}"> {{ $categories->count() }} Categories</a>
                                </td>
                                <td>
                                    <span class="glyphicon glyphicon-pushpin"></span><a href="{{ route('posts.index') }}"> {{ $posts->count() }} Posts</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

