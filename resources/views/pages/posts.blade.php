@extends('layouts.master')
@section('title',$title)
@yield('navigation')
@section('content')
@if(isset($post_data[0]))
<div class="col-sm-9">
		<h2 id="postTitle" style="display: inline-block;">Title: {!!$post_data[0]->title!!}</h2>
		<span style="float: right; display: inline-block;">
			@if(Auth::check())
			@if($post_data[0]->postedby==Auth::user()->username)
			<span class="btn-group">
				<button id="btnDelete" class="btn btn-md btn-link" title="Delete post"><i class="fa fa-trash"></i></button>
				<button id="btnEdit" class="btn btn-md btn-link" title="Edit post"><i class="fa fa-pencil-square"></i></button>
			</span>
			<script type="text/javascript">
				$("#btnEdit").click(function(){
					location.href="{{url('/post/edit')}}/{{$post_data[0]->id."-".str_slug($post_data[0]->title,'~')}}";
				});
				$("#btnDelete").click(function(){
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
							setTimeout(function(){location.href="{{url('/post/delete')}}/{{$post_data[0]->id}}";},1300);
						}
					});
					// location.href="{{url('/post/delete')}}/{{$post_data[0]->id}}";
				});
			</script>
			@endif
			@endif
			posted by: <a href="/profile/{!!$post_data[0]->postedby!!}">{!!$post_data[0]->postedby!!}</a>
		</span>
	<p class="postById">{!!$post_data[0]->body!!}</p>
	<p class="postOther btn-group" style="text-align: justify;">
   	<a class="btn btn-react btn-md" id="{{$post_data[0]->id}}like" title="like"><i class="fa fa-thumbs-o-up"></i> <span class="badge" id="like{{$post_data[0]->id}}">{{$post_data[0]->likes}}</span></a>
   	<a class="btn btn-react btn-md" id="{{$post_data[0]->id}}dislike" title="dislike"><i class="fa fa-thumbs-o-down"></i> <span class="badge" id="dislike{{$post_data[0]->id}}">{{$post_data[0]->dislikes}}</span></a>
   	<a class="btn btn-info  btn-md" title="views"><i class="fa fa-mouse-pointer"></i> <span class="badge">{{$post_data[0]->clicked}}</span></a>
   </p>
	<p></p>
</div>
<div class="col-sm-9" >
	<h4>Other posts by {{$post_data[0]->postedby}}</h4>
	other posts by this user 
	other posts by this user 
		other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 	other posts by this user 
</div>

<div class="comment col-sm-9" >
		<h4><i class="fa fa-comments"></i>Comments</h4>
		<p class="old_comments">
			@foreach($post_comments as $comments)
			<span class="commentBy"><a href="{{url('/profile/'.$comments['user'])}}">{{$comments['user']}} : </a></span>
			<span class="commentTime">{{$comments['created_at']}}</span>
			<p class="commentBody"><i class="fa fa-comment-o"></i>{!!$comments['comment']!!}</p>
			@endforeach
		</p> 
		@if(Auth::check())
		{{Form::open(array('method' => 'POST','route' => ['post.comment',$post_data[0]->id],'class' => 'form-horizontal'))}}
        {{Form::textarea('comment', null, array( 'required','class'=>'form-control','placeholder'=>'Add a comment'))}}
        {{Form::submit('Comment',array('class'=>'btn btn-info'))}}
        {{Form::close()}}
        <script type="text/javascript" src="{{URL::asset('plugins/ckeditor/ckeditor.js')}}"></script>
        <script type="text/javascript">
        	CKEDITOR.replace( 'comment',{height:'180',toolbar:'basic'});
        </script>
        @endif
	</div>
<script type="text/javascript" src="{{URL::asset('plugins/ckeditor/ckeditor.js')}}"></script>
@else
<div class="col-md-4" style="position: relative;margin-top: 10%;">
	<div class="jumbotron alert alert-custom">
		The post you are looking for doesn't exist.
	</div>
</div>
@endif
@stop