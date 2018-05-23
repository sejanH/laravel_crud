@extends('layouts.chatting')
@section('title',$title)
@yield('navigation')
@section('content')
<div class="container">

<div class="columns">
<div class="column">
	<section class="section">
		<div class="msgLists">
	Chat lists
			<ul>
				@foreach($msg as $chat)
				<li class="messageBox" id="{{Auth::check()? $chat['sender'].'-'.$chat['receipient']:''}}">
					<div class="level" style="margin-bottom:0">
						<div class="level-left">
							<div class="level-item"><strong>{{$chat['receipient']}}</strong></div>
						</div>
						<div class="level-right">
							<div class="level-item" style="font-size:9px">
								{!!$chat['ago']!!}
							</div>
						</div>
					</div>
						<div class="level" style="font-size: 11px">{{substr(strip_tags($chat['message']),0,50)}}</div>
				</li>
				@endforeach
			</ul>
		</div>
	</section>
</div>
<div class="column is-three-quarters">
	<i class="fa fa-list"></i>  Chatting history 
	<div class="column is-three-quarters">
		<div id="chatHistory">
		</div>
	</div>
</div>
</div>

</div>
<script type="text/javascript">
	$(function(){
		function getMessages(participants){
			$.ajax({
				type: "GET",
				url: participants,
				success: function(data){
					var sendNew = '{{Form::open(["class"=>"form-horizontal","method"=>"POST","route"=>["chat.send",'+send+'],"id"=>"send"])}}'+
									'<textarea class="textarea" rows="1"></textarea>'+
									'<button class="button is-danger is-outlined" id="'+participants+'">'+
									'<i class="fa fa-paper-plane"></i> &nbsp; Send</button>'+
									'{{Form::close()}}';
				var $form = $(sendNew);
				$form.attr('action', function(_, action){
					return action.replace('+send+', participants);
				});
					$("#chatHistory").html(data).append($form);
				}
			});
		}

		function sendMessages(participants,token){
			$.ajax({
				type: "POST",
				url: 'send/'+participants,
				data: {'_token':token},
				success: function(data){
					getMessages(participants);
				}
			});
		}
var participants;
		$("li.messageBox").click(function(){
			participants = $(this).attr('id');
			getMessages(participants);

		});

		//send text
		$(document).on('click','button',function(e){
			var id = $(this).attr('id');
			e.preventDefault();
			if(id==participants){
				var value = $("#send").serialize();
				value = value.replace('_token=','');
				sendMessages(participants,value);
			}
		});
	});
</script>
@stop