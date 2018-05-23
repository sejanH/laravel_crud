@extends('layouts.master')
@section('title',$title)
@yield('navigation')
@section('content')
@if (Session::has('msg'))
<script type="text/javascript">
  swal({
    content: {
      element: "p",
      attributes:{
        innerText:  "{{ Session::get('msg') }}",
      },
    },
    buttons: false,
    timer:1200,
  });
</script>
@endif
{{ Form::open(array('method' => 'POST','route'=>['post.update',$postDetails[0]->id],'class' => 'form-horizontal col-md-8'))}}
{!! Form::hidden('id', $postDetails[0]->id) !!}
<div class="form-group">
    {{ Form::label('Title') }}
    {{ Form::text('title', $postDetails[0]->title, 
        array( 'required',
              'class'=>'form-control', 
              'placeholder'=>'Give it a title')) }}
</div>
<div class="form-group">
    {{ Form::label('Body') }}
    {{ Form::textarea('body', $postDetails[0]->body, 
        array('id' => 'postBody',
              'required', 
              'class'=>'form-control', 
              'placeholder'=>'Insert a post body')) }}
</div>
<div class="form-group">
    {{ Form::submit('Update',
      array('id'=>'update','class'=>'btn btn-custom'))
  	}}
</div>
{{ Form::close()}}

<script type="text/javascript" src="{{URL::asset('plugins/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
   CKEDITOR.replace( 'postBody' );
</script>
@stop