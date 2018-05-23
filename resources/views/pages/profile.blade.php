@extends('layouts.master')
@section('title',$title)
@yield('navigation')
@section('content')
@if(isset($post_data[0]))
<br>
<div class="col-sm-10">
	<div class="row">
		<div class="col-md-3">
			<img src="{{isset($post_data[0]->profile_pic)&& $post_data[0]->profile_pic!='' ? URL::asset('images/user_profile/'.$post_data[0]->profile_pic): URL::asset('images/user_profile/profile-pic.png')}}" class="profile-pic" alt="profile-pic"/>
			<form action="{{ URL::to('profile/'.$post_data[0]->username.'/upload') }}" method="post" enctype="multipart/form-data">
				<label>Change profile image:</label>
			    	<input type="file" name="image" id="file" class="form-control" style="">
				    <input type="submit" value="Upload" name="submit" class="btn btn-custom">
				<input type="hidden" value="{{ csrf_token() }}" name="_token">
			</form>
		</div>
		<div class="col-sm-7">
				<table class="table table-responsive table-striped">
		<tr>
			<th width="150px">Username:</th>
			<td>{!!$post_data[0]->username!!}</td>
		</tr>
		<tr>
			<th>User Type:</th>
			<td>{!!$post_data[0]->userType!!}</td>
		</tr>
		<tr>
			<th>Email:</th>
			<td>{!!$post_data[0]->email!!}</td>
			<td><a id="email" href="javascript:void(0);" title="change"><span class="fa fa-envelope"></span></a></td>
		</tr>
		<tr>
			<th>Favourite color:</th>
			<td>{!!$post_data[0]->securityQA!!}</td>
			<td><a id="sQA" href="javascript:void(0);" title="change"><span class="fa fa-search"></span></a></td>
		</tr>
		<tr>
			<th>Registered on:</th>
			<td>{!!$post_data[0]->created_at!!}</td>
		</tr>
	</table>
		</div>
	</div>
</div>
@else
<div class="col-md-4">
	<div class="jumbotron alert alert-custom">
		The person you are looking for doesn't exist.
	</div>
</div>
@endif
<script type="text/javascript"> 
	$("td a").click(function(){
	var ids = $(this).attr('id');
	alert(ids);
	});
</script>
@stop