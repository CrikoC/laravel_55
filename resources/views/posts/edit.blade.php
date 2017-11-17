@extends('adminMain')

@section('title', '| Edit Post')

@section('stylesheets')
    {!! Html::style('css/admin.css') !!}
@endsection
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector:'textarea',
        toolbars: "image",
        plugins: "link, code image imagetools",
    });
</script>

@section('content')
    <div class="row">
        {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method'=> 'PUT', 'files' => true]) !!}
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Edit Post</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="input-group has-feedback">
                                <div class="input-group-addon">
                                    <label for="title"><i class="fa fa-id-card" aria-hidden="true"></i></label>
                                </div>
                                {{ Form::text('title', null, ['placeholder' => 'post name (GR)' ,'class' => 'form-control', 'required' => '', 'maxlength'=> '255']) }}
                                <span id="title-block" class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group has-feedback">
                                <div class="input-group-addon">
                                    <label  for="slug"><i class="fa fa-laptop" aria-hidden="true"></i></label>
                                </div>
                                {{ Form::text('slug', null, ['placeholder' => 'Computer friendly name' ,'class' => 'form-control', 'required' => '', 'maxlength'=> '255']) }}
                                <span id="slug-block" class="help-block"></span>
                            </div>
                        </div>
                        {{ Form::textarea('body', null, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="well">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group  input-append">
                                <div class="input-group-addon">
                                    <label for="'category_id">Category:</label>
                                </div>
                                <select class="form-control" name="category_id">
                                    <option value="{{ $post->category->id }}">{{ $post->category->name }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4>Current Image</h4>
                    @if($post->image != null)
                    <p><img src="{{ url('gallery_images/thumbnails/'.$post->thumbnail) }}" width="200"></p>
                    @endif
                    <hr>
                    <label for="featured_file">New Image:</label>
                    {{ Form::file('featured_image') }}
                    <hr>
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
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Html::linkRoute('posts.show','Cancel', [$post->id], ['class' => 'btn btn-danger btn-block']) !!}
                        </div>
                        <div class="col-sm-6">
                            {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#title').keyup(autoFillSlug);
        });
        function autoFillSlug() {
            var title = $('#title');
            var slug = $('#slug');
            /* replace spaces with "_", uppercase letters with lowercase */
            var titleValue = title.val().replace(/ +/g, "_").toLowerCase();
            slug.val(titleValue);
        }
    </script>
@endsection
