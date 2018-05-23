@extends('layouts.master')
@section('title',$title)
@yield('navigation')
@section('content')
<div class="col-sm-9">
@if(!isset($search_result))
<h1 class="jumbotron alert alert-info">
	Search result returned <em>0</em> results
	<a class="btn btn-custom" href="{{url()->previous()}}">go back</a>
</h1>
@else
@foreach($search_result as $p)
<div class="col-sm-4">
	<h4 class="postLink" style="display: inline-block;"><a href="{{url('/post/'.$p->id.'-'.str_slug($p->title,'~'))}}" id="postid{{$p->id}}">{!!strlen($p->title) >120 ? substr($p->title,0,50).'...' : $p->title!!}</a></h4>
	<p class="postBody">{!!substr(strip_tags($p->body), 0, 460) !!}</p>
	<p class="postOther btn-group" style="text-align: justify;">
		<a class="btn btn-react btn-flat btn-xs" id="{{$p->id}}like" title="like"><i class="fa fa-thumbs-o-up"></i> <span class="badge" id="like{{$p->id}}">{{$p->likes}}</span></a>
		<a class="btn btn-react btn-flat btn-xs" id="{{$p->id}}dislike" title="dislike"><i class="fa fa-thumbs-o-down"></i> <span class="badge" id="dislike{{$p->id}}">{{$p->dislikes}}</span></a>
		<a class="btn btn-warning btn-flat btn-xs" id="{{$p->id}}comment" title="comment"><i class="fa fa-comments-o"></i> <span class="badge">@if(isset($comment[$p->id])){{$comment[$p->id]}}@else{{"0"}}@endif</span></a>
		<a class="btn btn-info btn-flat btn-xs" title="views"><i class="fa fa-mouse-pointer"></i> <span class="badge">{{$p->clicked}}</span></a>
	</p>
</div>
<script type="text/javascript">
$('#postid{{$p->id}}').click(function(){
	$.ajax({
		type: 'get',
		url: '/post/{{$p->id}}/click',			
		error: function (xhr, ajaxOptions, thrownError) {
			// console.log(xhr.status);
			// console.log(JSON.stringify(xhr.responseText));
		}
	});
});
</script>
@endforeach
@endif
</div>
<h5>Search result took {{round($elapsed,4)}} seconds</h5>
@stop