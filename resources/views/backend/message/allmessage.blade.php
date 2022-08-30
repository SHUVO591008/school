
@extends('layouts.app')


@section('web')

<?php
$recever=Route::input('id');
$id=Auth::id();
$userFind = DB::table('users')->where('id',$recever)->first();

?>

<style>
    span.bage {
        background: yellow;
        color: black;
        margin-left: 11px;
        padding: 5px;
        border-radius: 50%;
        font-size: 13px;
    }
	   .content-main { background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);min-height: 60vw};
	   .card {

		}

		.card {
			height: 500px!important;
			border-radius: 15px !important;
			background-color: rgba(0,0,0,0.4) !important;

			position: relative;
			display: -ms-flexbox;
			display: flex;
			-ms-flex-direction: column;
			flex-direction: column;
			min-width: 0;
			word-wrap: break-word;
			background-color: #fff;
			background-clip: border-box;
			border: 1px solid rgba(0,0,0,.125);
			border-radius: .25rem;
		}

		.card-header {
			padding: .75rem 1.25rem;
			margin-bottom: 0;
			background-color: rgba(0,0,0,.03);
			border-bottom: 1px solid rgba(0,0,0,.125);
			border-radius: 15px 15px 0 0 !important;

		}

		.input-group {
			position: relative;
			display: -ms-flexbox;
			display: flex;
			-ms-flex-wrap: wrap;
			flex-wrap: wrap;
			-ms-flex-align: stretch;
			align-items: stretch;
			width: 100%;
		}

		.input-group>.custom-file, .input-group>.custom-select, .input-group>.form-control {
			position: relative;
			-ms-flex: 1 1 auto;
			flex: 1 1 auto;
			width: 1%;
			margin-bottom: 0;
		}

		.search {
			border-radius: 15px 0 0 15px !important;
			background-color: rgba(0,0,0,0.3) !important;
			border: 0 !important;
			color: white !important;
		}

		.input-group-prepend {
			margin-right: -1px;
		}

		.input-group-append, .input-group-prepend {
			display: -ms-flexbox;
			display: flex;
		}

		.search_btn {
			border-radius: 0 15px 15px 0 !important;
			background-color: rgba(0,0,0,0.3) !important;
			border: 0 !important;
			color: white !important;
			cursor: pointer;
		}

		.input-group-text {
		display: -ms-flexbox;
		display: flex;
		-ms-flex-align: center;
		align-items: center;
		padding: .375rem .75rem;
		margin-bottom: 0;
		font-size: 1rem;
		font-weight: 400;
		line-height: 1.5;
		color: #495057;
		text-align: center;
		white-space: nowrap;
		background-color: #e9ecef;
		border: 1px solid #ced4da;
		border-radius: .25rem;
	}

	.contacts_body {
		padding: 0.75rem 0 !important;
		overflow-y: auto;
		white-space: nowrap;
	}

	.contacts {
		list-style: none;
		padding: 0;
	}

	.contacts_body {
		padding: 0.75rem 0 !important;
		overflow-y: auto;
		white-space: nowrap;
	}

	.contacts li {
		width: 100% !important;
		padding: 5px 10px;
		margin-bottom: 15px !important;
	}

	.active {
		background-color: rgba(0,0,0,0.3);
	}

	.d-flex {
		display: -ms-flexbox!important;
		display: flex!important;
	}

	.img_cont {
		position: relative;
		height: 70px;
		width: 70px;
	}

	.user_img {
		height: 70px;
		width: 70px;
		border: 1.5px solid #f5f6fa;
	}

	.rounded-circle {
		border-radius: 50%!important;
	}
	img {
		vertical-align: middle;
		border-style: none;
	}
	.online_icon {
		position: absolute;
		height: 15px;
		width: 15px;
		background-color: #4cd137;
		border-radius: 50%;
		bottom: 0.2em;
		right: 0.4em;
		border: 1.5px solid white;
	}
	.user_info {
		margin-top: auto;
		margin-bottom: auto;
		margin-left: 15px;
	}
	.user_info span {
		font-size: 20px;
		color: white;
	}
	.user_info p {
		font-size: 10px;
		color: rgba(255,255,255,0.6);
	}

	.card-footer {
			border-radius: 0 0 15px 15px !important;
			border-top: 0 !important;
		}

		.card-footer {
			padding: .75rem 1.25rem;
			background-color: rgba(0,0,0,.03);
			border-top: 1px solid rgba(0,0,0,.125);
		}

		.chat {
			margin-top: auto;
			margin-bottom: auto;
		}

		.msg_head {
			position: relative;
		}

		#action_menu_btn {
			position: absolute;
			right: 10px;
			top: 10px;
			color: white;
			cursor: pointer;
			font-size: 20px;
		}

		.action_menu {
			z-index: 1;
			position: absolute;
			padding: 15px 0;
			background-color: rgba(0,0,0,0.5);
			color: white;
			border-radius: 15px;
			top: 30px;
			right: 15px;
			display: none;
		}

		.action_menu ul {
			list-style: none;
			padding: 0;
			margin: 0;
		}

		.action_menu ul li {
			width: 100%;
			padding: 10px 15px;
			margin-bottom: 5px;
		}

		.msg_card_body {
			overflow-y: auto;
		}

		.mb-4, .my-4 {
			margin-bottom: 1.5rem!important;
		}

		.justify-content-start {
			-ms-flex-pack: start!important;
			justify-content: flex-start!important;
		}

		.img_cont_msg {
			height: 40px;
			width: 40px;
		}

		.user_img_msg {
			height: 40px;
			width: 40px;
			border: 1.5px solid #f5f6fa;
		}
		.rounded-circle {
			border-radius: 50%!important;
		}



		.msg_cotainer {
			margin-top: auto;
			margin-bottom: auto;
			margin-left: 10px;
			border-radius: 25px;
			background-color: #82ccdd;
			padding: 10px;
			position: relative;
		}

		.msg_time {
			position: absolute;
			left: 0;
			bottom: -15px;
			color: rgba(255,255,255,0.5);
			font-size: 10px;
            width: 87px;
		}

		.mb-4, .my-4 {
			margin-bottom: 1.5rem!important;
		}

		.justify-content-end {
			-ms-flex-pack: end!important;
			justify-content: flex-end!important;
		}

		.msg_cotainer_send {
			margin-top: auto;
			margin-bottom: auto;
			margin-right: 10px;
			border-radius: 25px;
			background-color: #78e08f;
			padding: 10px;
			position: relative;
		}

		.msg_time_send {
			position: absolute;
			right: 0;
			bottom: -15px;
			color: rgba(255,255,255,0.5);
			font-size: 10px;
            width: 87px;
		}

		.img_cont_msg {
			height: 40px;
			width: 40px;
		}

		.card-footer {
			border-radius: 0 0 15px 15px !important;
			border-top: 0 !important;
		}

		.card-footer {
			padding: .75rem 1.25rem;
			background-color: rgba(0,0,0,.03);
			border-top: 1px solid rgba(0,0,0,.125);
		}

		.input-group {
			position: relative;
			display: -ms-flexbox;
			display: flex;
			-ms-flex-wrap: wrap;
			flex-wrap: wrap;
			-ms-flex-align: stretch;
			align-items: stretch;
			width: 100%;
		}

		.input-group-append {
			margin-left: -1px;
		}

		.input-group>.custom-select:not(:first-child), .input-group>.form-control:not(:first-child) {
			border-top-left-radius: 0;
			border-bottom-left-radius: 0;
		}

		.input-group>.custom-select:not(:last-child), .input-group>.form-control:not(:last-child) {
			border-top-right-radius: 0;
			border-bottom-right-radius: 0;
		}

		.input-group>.custom-file, .input-group>.custom-select, .input-group>.form-control {
			position: relative;
			-ms-flex: 1 1 auto;
			flex: 1 1 auto;
			width: 1%;
			margin-bottom: 0;
		}

		.type_msg {
			background-color: rgba(0,0,0,0.3) !important;
			border: 0 !important;
			color: white !important;
			height: 60px !important;
			overflow-y: auto;
		}

		.form-control {
			display: block;
			width: 100%;
			height: calc(2.25rem + 2px);
			padding: .375rem .75rem;
			font-size: 1rem;
			line-height: 1.5;
			color: #495057;
			background-color: #fff;
			background-clip: padding-box;
			border: 1px solid #ced4da;
			border-radius: .25rem;
			transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
		}

		textarea {
			overflow: auto;
			resize: vertical;
		}

		button, input, optgroup, select, textarea {
			margin: 0;
			font-family: inherit;
			font-size: inherit;
			line-height: inherit;
		}

		.input-group-append {
			margin-left: -1px;
		}
		.input-group-append, .input-group-prepend {
			display: -ms-flexbox;
			display: flex;
		}
		.send_btn {
			border-radius: 0 15px 15px 0 !important;
			background-color: rgba(0,0,0,0.3) !important;
			border: 0 !important;
			color: white !important;
			cursor: pointer;
		}
		.input-group-text {
			display: -ms-flexbox;
			display: flex;
			-ms-flex-align: center;
			align-items: center;
			padding: .375rem .75rem;
			margin-bottom: 0;
			font-size: 1rem;
			font-weight: 400;
			line-height: 1.5;
			color: #495057;
			text-align: center;
			white-space: nowrap;
			background-color: #e9ecef;
			border: 1px solid #ced4da;
			border-radius: .25rem;
		}

		.attach_btn {
			border-radius: 15px 0 0 15px !important;
			background-color: rgba(0,0,0,0.3) !important;
			border: 0 !important;
			color: white !important;
			cursor: pointer;
		}

		.card-body {
			-ms-flex: 1 1 auto;
			flex: 1 1 auto;
			padding: 1.25rem;
		}


    #btn{
    height: 25px;
    border-radius: 19px;
    position: absolute;
    width: 26px;
    font-size: 12px;
    display: block;
    padding: 3px;
    top: 0;
    }



    .image_div{
        display: none;
    }

</style>

<div id="page-wrapper" class="gray-bg dashbard-1">
	<div class="content-main">
		<div style="width: 1050px" class="container">
			<div style="text-align: center" class="row">

				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							<div class="input-group">
								<input type="text" placeholder="Search..." name="" class="form-control search">
								<div class="input-group-prepend">
								<span class="input-group-text search_btn"><i class="fa fa-search" aria-hidden="true"></i></span>
								</div>
							</div>
						</div>

                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-info" href="{{ route('messages') }}">
                                    User List <span class="bage">{{ count($user) }}</span>
                                </a>

                            </div>
                            <div class="col-md-6">
                                <a onclick="seenUpdate()" class="btn btn-success" href="{{URL::to('/allmessage')}}">
                                    Message <span style="display: none" id="smsnum" class="bage smsnum"></span>
                                </a>

                            </div>
                        </div>


						<div class="card-body contacts_body">
							<ui id='all-chat-message' class="contacts activeClass">

							</ui>
						</div>

						<div class="card-footer"></div>
					</div>
				</div>

                @if($recever!==null)
                    <div class="col-md-8 chat">
                        <div class="card">
                            <div class="card-header msg_head">
                                <div class="d-flex bd-highlight">
                                    <div class="img_cont">
                                        <img id="userImage" src="{{ asset($userFind->image) }}" class="rounded-circle user_img">
                                        <span class="{{ ($userFind->online==0)?"":"online_icon" }}"></span>
                                    </div>

                                    <div class="user_info">
                                        <span id="name">Chat with {{ $userFind->name }}</span>
                                        <p>1767 Messages</p>
                                    </div>

                                </div>

                                <span id="action_menu_btn"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span>

                                <div class="action_menu">
                                    <ul>
                                        <li><i class="fas fa-user-circle"></i> View profile</li>
                                        <li><i class="fas fa-users"></i> Add to close friends</li>
                                        <li><i class="fas fa-plus"></i> Add to group</li>
                                        <li><i class="fas fa-ban"></i> Block</li>
                                    </ul>
                                </div>

                            </div>

                            <div id="scrolltoheight" class="card-body msg_card_body">
                                <div id="chat-message" class="">

                                </div>
                            </div>

                            <div class="typing"><p id="typing"></p></div>



                        </div>

                        {{--  //from  --}}

                    <form id="upload_form" action="{{URL::to('/send-message')}}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token"id="token-message"value="{{csrf_token()}}">
                        <input type="hidden" name="recever" id="recever"value="{{$recever}}">
                        <input type="hidden" name="sender"id="sender"value="{{$id}}">


                        <div class="card-footer">
                            <div class="input-group">

                                <div class="image_div">
                                    <img id="image" src="#" />
                                    <span id="btn" class="btn btn-warning">X</span>
                                </div>


                                <div class="input-group-append">
                                    <span class="input-group-text attach_btn">
                                        <label style="cursor: pointer;" for="file">
                                            <i class="fa fa-paperclip" aria-hidden="true"></i>

                                            <input id="file" style="display: none"  type="file" class="upload-attachment upload" name="image" accept="image/*, .txt, .rar, .zip" onchange="readURL(this);" src=""/>


                                        </label>
                                    </span>
                                </div>



                                <textarea onkeyup="typing()" id="message" name="message" class="form-control type_msg" placeholder="Type your message..."></textarea>
                                <div class="input-group-append">
                                    <button id="send_btn" class="input-group-text send_btn" type="submit">
                                        <span class=""><i class="fa fa-location-arrow" aria-hidden="true"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>


                        </div>
                    </div>
                @endif

			</div>
		</div>
	</div>
</div>



<script>
    setInterval(ajaxCall,1000);
    setInterval(typinc_receve,1000);


    {{--  getFunction Message  --}}

    function ajaxCall() {
        var oldMessage=$("#chat-message li").length;
        var oldscrollHeight = $("#scrolltoheight").prop("scrollHeight");
         $.ajax({
             type:'get',
             url:'{{URL::to('messages/chat')}}/'+<?php echo $recever;?>,
             datatype:'html',
             success:function(response){
                    $('#chat-message').html(response);
                    var newscrollHeight = $("#scrolltoheight").prop("scrollHeight"); //Scroll height after the request
                    var newMessage=$("#chat-message li").length;
                    if(newscrollHeight > oldscrollHeight){
                        $("#scrolltoheight").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div

                    }

                }
             });
    }

    function typinc_receve() {

        $.ajax({
            type:'get',
            url:'{{URL::to('messages/typing-receve')}}/'+<?php echo $recever;?>,
            datatype:'html',
            success:function(response){
                   if(response==0){
                     $('#typing').hide('slow');
                   }else{
                       $('#typing').show();
                       $('#typing').html(response);

                   }


               }
            });
    }

    function deleteMessage(id){

        $('#'+id).hide();
        var sender=id;
        $.ajax({
            type:'get',
            url:'{{URL::to('messages/deletemessage')}}/'+sender,
            datatype:'html'
            });
    }

    function typing() {
        var text=$('#message').val();
        var token=$('#token-message').val();

         $.ajax({
             type:'post',
             url:'{{URL::to('messages/typing')}}',
             datatype:'html',
             success:function(response){
                   console.log(response);
                },
             data:{
                     text:text,
                     recever:<?php echo $recever;?>,
                     _token:token,

                 }
             });
     }


     function seenUpdate() {
        $.ajax({
            type:'get',
            url:'{{URL::to('/seenUpdate')}}',
            datatype:'html'
        });
    }



</script>



<script>
	$(document).ready(function(){
	$('#action_menu_btn').click(function(){
		$('.action_menu').toggle();
	});
	});
</script>


{{--  //validation and send Message  --}}
<script>
    $('#upload_form').on('submit',function(event){
        event.preventDefault();
        var message = $('#message').val();
        var im = $('#file').val();
        var token=$('#token-message').val();

        $('.notifyjs-corner').html('');
        if(message==''){
            if(im==''){
                $.notify("Field is required!", {globalPosition:'top right',className:'error'});
                return false;
            }
        }else if(im==''){

            if(message==''){
                $.notify("Field is required!", {globalPosition:'top right',className:'error'});
                return false;
            }

        }

        $('#message').focus();

        var formData = new FormData(this);

        $.ajax({
            type:'post',
            url:'{{URL::to('messages/send-message')}}',
            data: formData,
            contentType: false,
            processData: false,

            });

            $('#image').attr('src', ''); // Clear the src
            $('#file').val('');

            $('#image').hide();

            document.getElementById('upload_form').reset();
    });

</script>



{{--  //image show  --}}
<script type="text/javascript">

    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#image')
                .attr('src',e.target.result)
                .width(80)
                .height(55);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

{{--  image function  --}}
<script>
    $('#btn').click(function(){
       $('#image').attr('src', ''); // Clear the src
        $('#file').val('');
        $(this).hide();
        $('#image').hide();

    })
</script>

<script>
    $(document).ready(function() {

        function time(){

        var imageFind = $('#image').attr('src');

        if(imageFind=='#'){
            $('.image_div').fadeOut();

        }else if(imageFind==''){
            $('.image_div').fadeOut();
        }else{

            $('#btn').show();
            $('#image').show();
            $('.image_div').fadeIn();
        }


        }

        setInterval(time,1000);



    });
</script>





@endsection



