@extends('adminMain')
@section('title','| Create Post')
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
        {!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true]) !!}
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Create New Post</h1>
                </div>
                <div class="panel-body">
                     <div class="form-group">
                         <div class="input-group has-feedback">
                            <div class="input-group-addon">
                                <label for="title"><i class="fa fa-id-card" aria-hidden="true"></i></label>
                            </div>
                            <input type="text" name="title" id="title" class="form-control" placeholder="post name" required maxlength="255"">
                            <span id="title-block" class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group has-feedback">
                            <div class="input-group-addon">
                                <label  for="slug"><i class="fa fa-laptop" aria-hidden="true"></i></label>
                            </div>
                            <input type="text" name="slug" id="slug" class="form-control" placeholder="Computer friendly name" required maxlength="255"">
                            <span id="slug-block" class="help-block"></span>
                        </div>
                    </div>
                    <textarea id="body" name="body"></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="well">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                    <label for="'category_id">Category:</label>
                            </div>
                            <select class="form-control" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <label for="'tags[]">Tags:</label>
                            </div>
                            <select class="form-control select2-multi" name="tags[]" multiple="true">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <label for="featured_image">Image:</label>
                    {{ Form::file('featured_file') }}
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        {{ Form::submit('Create New Post', ['class' => 'btn btn-success btn-block']) }}
                    </div>
                    <div class="col-sm-6">
                        <a class="btn btn-danger btn-block" href="{{route('posts.index')}}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('scripts')
    {!! Html::script('js/jquery.min.js') !!}
    {!! Html::script('js/select2.min.js')  !!}
    {!! Html::script('js/parsley.min.js')  !!}
    <script>
        $(document).ready(function(){
            $('#title').keyup(autoFillSlug);
        });
        function autoFillSlug() {
            var title = $('#title');
            var slug = $('#slug');
            /* replace spaces with "_", uppercase letters with lowercase */
            var newTitleValue = title.val().replace(/ +/g, "_").toLowerCase();
            //convert utf characters

            slug.val(newTitleValue);
        }
    </script>
@endsection