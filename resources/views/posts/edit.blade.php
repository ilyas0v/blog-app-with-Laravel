@extends("main")

@section("title", " | Edit post")

@section('stylesheets')
  {!! Html::style('css/select2.min.css') !!}
@endsection

@section("content")

	<div class="row">
    {!! Form::model($post , ["route"=>["posts.update" , $post->id ], "method"=>"PUT"]) !!}
    <div class="col-md-8">
        {{ Form::label("title", "Title: ")}}
        {{ Form::text("title", null , array("class"=>"form-control input-lg"))  }}

				{{ Form::label("slug", "Slug: ")}}
        {{ Form::text("slug", null , array("class"=>"form-control input-lg"))  }}

				{{ Form::label("category_id", "Category: ")}}
				{{ Form::select("category_id" , $categories , null ,['class'=>'form-control'])}}

        {{ Form::label("tags", "Tags: ")}}
				{{ Form::select("tags[]" , $tags , null ,['class'=>'select2-multi form-control','multiple'=>'multiple'])}}

        {{ Form::label("body", "Body: ")}}
        {{ Form::textarea("body", null , array("class"=>"form-control"))  }}
    </div>

    <div class="col-md-4">
        <div class="well">
            <dl class="dl-horizontal">
                <dt>Create at:</dt>
                <dd>{{date('M j, Y h:ia' , strtotime($post->created_at))}}</dd>
            </dl>

            <dl class="dl-horizontal">
                <dt>Last updated:</dt>
                <dd>{{date('M j, Y h:ia' , strtotime($post->updated_at))}}</dd>
            </dl>
            <hr>
            <div class="row">

                <div class="col-sm-6">
                    {!! Html::linkRoute("posts.show" , "Cancel" , array($post->id),
                    array("class"=>"btn btn-danger btn-block")) !!}

                </div>

                <div class="col-sm-6">

                  {{ Form::submit("Save changes", array("class"=>"btn btn-success btn-block"))  }}

                </div>


            </div>
        </div>
    </div>
    {!!Form::close()!!}
</div>
@endsection

@section('scripts')
{!! Html::script('js/select2.min.js') !!}
<script>

    $('.select2-multi').select2();
    
</script>
@endsection
