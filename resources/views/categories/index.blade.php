@extends("main")
@section("title" , "| All categories")

@section("content")

  <div class="row">
    <div class="col-md-8">
      <h1>Categories</h1>
      <table class="table">
        <thead>
          <th>#</th>
          <th>Name</th>
        </thead>

        <tbody>
          @foreach($categories as $c)
          <tr>
            <th>{{$c->id}}</th>
            <td>{{$c->name}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="col-md-3">
      <div class="well">
        {!! Form::open(['route'=>'categories.store','method'=>'POST']) !!}
          <h2>New category</h2>
          {{Form::label("name","Name:")}}
          {{Form::text('name',null,['class'=>'form-control'])}}
          {{Form::submit("Create new category",['class'=>'btn btn-success btn-block'])}}
          {!!Form::close()!!}
      </div>
    </div>


  </div>

@endsection
