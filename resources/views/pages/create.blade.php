@extends('layouts.master')
@section('title',$title)
@yield('navigation')
@section('content')
@if (Session::has('msg'))
<script type="text/javascript">
  swal({
    icon: 'success',
    text:  "{{ Session::get('msg') }}",
    buttons: false,
    timer:1200,
  });
</script>
@endif
{{ Form::open(array('method' => 'POST','action' => 'BlogController@store','class' => 'form-horizontal col-md-8'))}}
<br>
<div class="form-group">
<div class="col-md-7"> 
    {{ Form::label('Title') }}
    {{ Form::text('title', null, 
        array( 'required',
              'class'=>'form-control', 
              'placeholder'=>'Give it a title')) }}
</div>
<div class="col-md-3"> 
  {{ Form::label('Category') }}
  <select required="true" class="form-control" name="category">
    <option value="" hidden="true">Select Post Category</option>
    @if(isset($site_data[1]))
    <?php $size = count($site_data[1]);?>
    @for($i = 0;$i<$size;$i++)
    <option value="{{$site_data[1][$i]->category_name}}">{{ucfirst($site_data[1][$i]->category_name)}}</option>
    @endfor
    @endif
  </select>
</div>
</div>
<br>
<div class="form-group">
    {{ Form::label('Body') }}
    {{ Form::textarea('body', null, 
        array('id' => 'postBody',
              'required', 
              'class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::submit('Submit', 
      array('class'=>'btn btn-primary')) }}
</div>
{{ Form::close()}}

<script type="text/javascript" src="{{URL::asset('plugins/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
   CKEDITOR.replace( 'postBody' );
</script>

@stop