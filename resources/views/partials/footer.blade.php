<div class="footer">&copy; S.M.Mominul Haque 2017-{{date('Y')}}</div>
<script async type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

@if(Auth::check())
<script type="text/javascript" src="{{URL::asset('plugins/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
	$('.postOther a.btn-react').click(function(e){
		var ids = $(this).attr('id');
		var strSize = ids.length;
		var action = ids.substring(10,strSize);
		var postID = ids.substring(0,10);
		e.preventDefault();
		var token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: 'get',
			data: {"_token": token},
			dataType: 'json',
			url: '/post/'+ action +'/' + postID,
			success: function(data){
				if(data==false){
				//	$('#'+ids).unbind("click");
					$('#'+ids).removeClass('btn-react').addClass('btn-reacted');
					swal({
						icon: 'warning',
						text:  "Already "+action+"d",
						buttons: false,
						timer:1000,
					});
				}else{
					document.getElementById('like'+postID).innerHTML = data[0].likes;
					document.getElementById('dislike'+postID).innerHTML = data[0].dislikes;
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.status);
				console.log(JSON.stringify(xhr.responseText));
			}
		});
	});

	//commenting
	$('.postOther a.btn-warning').click(function(e){
		e.preventDefault;
		var ids = $(this).attr('id');
		var strSize = ids.length;
		var action = ids.substring(10,strSize);
		var postID = ids.substring(0,10);
		var ckeditorInstace = 	'<script type="text/javascript">'+
        						'CKEDITOR.replace( "commentBox",{height:"180",toolbar:"basic"});<\/script>';
 

var data =  '{{Form::open(array("method" => "POST","route" => ["post.comment",'+postID+'],"class" => "form-horizontal"))}}'+
			'{{Form::textarea("comment", null,array("required","id"=>"commentBox","class"=>"form-control","placeholder"=>"Add a comment"))}}'+
			'{{Form::submit("Comment",array("class"=>"btn btn-info"))}}'+
			'{{Form::close()}}';

		var $form = $(data);
		$form.attr('action', function(_, action){
			return action.replace('+postID+', postID)
		});

		$('#comment').modal();
		$('#comment').on('shown.bs.modal', function(){
			$('#comment .modal-body').html($form);
			$('#comment .modal-footer #cke').html(ckeditorInstace);
		});
		$("#comment").on('hidden.bs.modal', function(){
                $('#comment .modal-body').html('');
            });
	});

</script>
@else
<script type="text/javascript">
$('.postOther a.btn-react,.postOther a.btn-warning').click(function(e){
	swal({
		icon: 'error',
		text:  "This feature is for registered members only",
		buttons: false,
		timer:1200,
	});
});
</script>
@endif
<script type="text/javascript">

$("#logout").click(function(){
	swal({
		title: "Are you sure?",
		text: "You want to logout!",
		icon: "warning",
		buttons: {
			cancel: true,
			confirm: {
				text: "Logout",
				closeModal: false,
			},
		},
	})
	.then((confirm) => {
		if (confirm) {
			setTimeout(function(){window.location.href="{{url('/')}}/Auth/logout"},1600);
		} else {
			swal("Logout","Cancelled","error",{
				buttons: false,
				timer:800,
			});
		}
	});
});
</script>
<!-- top bar animated text codes -->
<script>
document.documentElement.className = 'js';
</script>
<script src="{{URL::asset('js/segment.min.js')}}"></script>
<script src="{{URL::asset('js/d3-ease.v0.6.js')}}"></script>
<script src="{{URL::asset('js/letters.js')}}"></script>
<!-- top bar animated text codes -->
<script type="text/javascript">
	$('document').ready(function() {
		var path = window.location.pathname;
		var page = path.split("/").pop();
		if(page!='')
		{
			$('#'+page).addClass("active");
		}

	});
</script>
<script type="text/javascript">
	(function() {

	var items = [].slice.call(document.querySelectorAll('div.grid > div.grid__item'));

	function init() {
		items.forEach(function(item) {
			var word = item.querySelector('.grid__heading'),
				// initialize the plugin
				instance = new Letters(word, {
					size : 75,
					weight : 10,
					color: '#E65454',
					duration: 0.8,
					delay: 0.1,
					individualDelays: 1.2,
					fade: 0,
					easing: d3_ease.easeElasticInOut.ease
				});

			// show word
			instance.showInstantly();


			item.addEventListener('click', function() {
				instance.hide({
					duration: 1.2,
					delay: 0,
					fade: 1,
					easing: d3_ease.easeBounceOut.ease,
					callback: function() {
						instance.show();
					}
				});
			});
			setInterval(function(){
				instance.toggle({
					duration: 2.0,
					delay: 0,
					fade: 1,
					easing: d3_ease.easePolyInOut.ease
				});
			}, 2500);
		});

	}

	init();
})();

</script>