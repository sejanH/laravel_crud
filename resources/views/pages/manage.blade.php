@extends('layouts.master')
@section('title',$title)
@yield('navigation')
@section('content')
<style type="text/css">
	span.btn-group{
		float: right;
	}
</style>
<div class="col-sm-9">
<h4>Manage posts made by &raquo; <strong>{{Auth::user()->username}}</strong><small style="float: right;">total posts: 
{{count($user_data)}}</small></h4>
@if(isset($user_data))
@foreach($user_data as $p)
       <h4 class="postLink" style="display: inline-block;"><a href="/post/{!!$p->id.'-'.str_slug($p->title,'~')!!}">{!!strlen($p->title) >150 ? substr($p->title,0,50).'...' : $p->title!!}</a></h4>
       <span class="btn-group">
			{{Form::open(array('method'=>'post','route'=>['post.update',$p->id]))}}
			<a href="javascript:;" class="btn btn-md btn-danger" onclick="confirmDelete('{{$p->id}}');"><i class="fa fa-trash"></i></a>
			<button id="btnEdit" class="btn btn-md btn-custom" title="Edit post"><i class="fa fa-pencil-square"></i></button>
			{{Form::close()}}
		</span>
       <div class="postBody">{!!$p->body!!}</div><hr>
@endforeach
@endif
</div>
<script type="text/javascript">
	function confirmDelete(post_id) {
			swal({
				title: "Delete this post",
				text: "Are you sure?",
				buttons:{
					cancel: true,
					confirm:{
						text: "Yes delete",
						closeModal: false,
					},
				},
			})
			.then((confirm)=>{
				if(confirm){
					setTimeout(function(){location.href="post/delete/"+post_id;},1300);
				}
		});
	}
</script>
@stop