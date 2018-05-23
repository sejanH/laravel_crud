@extends('layouts.master')
@section('title',$title)
@yield('navigation')
@section('content')
<div class="row col-sm-10">
@if(isset($posts[0]))
@php ($comment_count = array())
@foreach($posts as $p)
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
<!-- Modal -->
<div id="comment" class="modal fade" role="dialog">
  <div class="modal-dialog" style="position: absolute;bottom: 10%;left: 0;right: 0;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add a quick comment</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
      	 <span id="cke"></span>
        <code>don't post offensive comments or spam</code>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->

@stop