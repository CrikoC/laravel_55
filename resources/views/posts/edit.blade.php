@extends('main')

@section('title', '| Edit Post')

@section('stylesheets')
    {!! Html::style('css/select2.min.css')  !!}
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
        <h3>Edit Post</h3>
        {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method'=> 'PUT']) !!}
            <div class="col-md-8">
                {{ Form::label('title', 'Title:') }}
                {{ Form::text("title", null, ['class' => 'form-control input-lg']) }}

                {{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top'] ) }}
                {{ Form::text('slug', null, ['class' => 'form-control']) }}

                {{ Form::label('category_id', 'Category:',['class' => 'form-spacing-top']) }}
                {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

                {{ Form::label('body', 'Body:', ['class' => 'form-spacing-top']) }}
                {{ Form::textarea('body', null, ['class' => 'form-control']) }}

                {{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
                {{ Form::select('tags[]', $tags, null, ['class'=> 'form-control select2-multi', 'multiple' => 'multiple']) }}
            </div>
            <div class="col-md-4">
                <div class="well">
                    <dl class="dl-horizontal">
                        <dt>Created At:</dt>
                        <dd>{{ date('M j, Y - h:i a', strtotime($post->created_at)) }}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Last Updated:</dt>
                        <dd>{{ date('M j, Y - h:i a', strtotime($post->updated_at)) }}</dd>
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
    {!! Html::script('js/select2.min.js')  !!}

    <script type="text/javascript">
        $('select').select2();
        $('select').select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
    </script>
@endsection