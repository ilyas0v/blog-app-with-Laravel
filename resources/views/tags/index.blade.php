@extends("main")
@section("title" , "| All tags")

@section("content")

  <div class="row">
    <div class="col-md-8">
      <h1>Tags</h1>
      <table class="table">
        <thead>
          <th>#</th>
          <th>Name</th>
        </thead>

        <tbody>
          @foreach($tags as $t)
          <tr>
            <th>{{$t->id}}</th>
            <td><a href="{{route('tags.show',$t->id)}}">{{$t->name}}</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="col-md-3">
      <div class="well">
        {!! Form::open(['route'=>'tags.store','method'=>'POST']) !!}
          <h2>New tag</h2>
          {{Form::label("name","Name:")}}
          {{Form::text('name',null,['class'=>'form-control'])}}
          {{Form::submit("Create new tag",['class'=>'btn btn-success btn-block'])}}
          {!!Form::close()!!}
      </div>
    </div>


  </div>

@endsection
