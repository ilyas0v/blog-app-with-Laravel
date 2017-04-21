@extends("main")
@section("title" , " | Create new post")

@section('stylesheets')
  {!! Html::style('css/select2.min.css') !!}
@endsection

@section("content")

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1>Create new post</h1>
        <hr>
        {!! Form::open(['route' => 'posts.store']) !!}
          {{ Form::label("title", "Title:") }}
          {{ Form::text("title",null ,array("class"=>"form-control" , "required"=>"")) }}

          {{ Form::label("slug","Slug:") }}
          {{ Form::text("slug",null,["class"=>"form-control" , "required"=>""]) }}

          {{ Form::label("category_id","Post category:") }}
          <select class="form-control" name="category_id">
            @foreach($categories as $c)
              <option value="{{$c->id}}">{{$c->name}}</option>
            @endforeach
          </select>

          {{ Form::label("tags","Tags:") }}
          <select class="form-control select2-multi" multiple="multiple" name="tags[]">
            @foreach($tags as $t)
              <option value="{{$t->id}}">{{$t->name}}</option>
            @endforeach
          </select>

          {{ Form::label("body","Post body:") }}
          {{ Form::textarea("body", null , array("class"=>"form-control","required"=>"")) }}


          {{ Form::submit("Create post" , array("class"=>"btn btn-success btn-lg btn-block",
          "style"=>"margin-top:15px;")) }}
        {!! Form::close() !!}
    </div>
  </div>

@endsection
@section('scripts')
{!! Html::script('js/select2.min.js') !!}
<script>
  $(document).ready(function(){
    $('.select2-multi').select2();
  });
</script>
@endsection
