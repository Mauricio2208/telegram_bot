<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Dashboard</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="#" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/selectize.css')}}">
    
    

</head>
<body class="">
	<!-- [ Pre-loader ] start -->
	<!-- <div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div> -->
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar menu-light ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div " >
				
				<div class="">
					<div class="main-menu-header">
                    <svg style="height: 50px" class="img-radius" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path style="fill: #95aee5;" d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"/></svg>
                        
						<div class="user-details">
							<div id="more-details">{{\Auth::user()->name}} <i class="fa fa-caret-down"></i></div>
						</div>
					</div>
					<div class="collapse" id="nav-user-link">
						<ul class="list-unstyled">
                                    
							<li class="list-group-item">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="feather icon-log-out m-r-5"></i>Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                </form>
                            </li>
						</ul>
					</div>
				</div>
				
				<ul class="nav pcoded-inner-navbar ">
					
					<li class="nav-item">
					    <a href="home" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-home"></i>
                            </span>
                            <span class="pcoded-mtext">
                                Dashboard
                            </span>
                        </a>
					</li>
					

				</ul>
				
				
				
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
		
			
				<div class="m-header">
					<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
					<a href="#!" class="b-brand">
						<!-- ========   change your logo hear   ============ -->
						
						<img src="assets/images/logo-icon.png" alt="" class="logo-thumb">
					</a>
					<a href="#!" class="mob-toggler">
						<i class="feather icon-more-vertical"></i>
					</a>
				</div>
				<div class="collapse navbar-collapse">
					
					<ul class="navbar-nav ml-auto">
						
					</ul>
				</div>
				
			
	</header>
	<!-- [ Header ] end -->
	
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Listagem dos grupos</h5>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            
            <!-- prject ,team member start -->
            <div class="col-xl-12 col-md-12">
            @include('components/modal_ban')
            @include('components/modal_message')
                <div class="card-body table-border-style">
                    <div class="#">
                        <table class="table" style="background: white;text-align: center;">
                            <thead>
                                <tr>
                                    <th>Grupo</th>
                                    <th>Tipo</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($chats as $chat)
                                <tr>
                                    <td>
                                        
                                        {{$chat['title']}}
                                    </td>
                                    <td>
                                        @if($chat['type'] == 'supergroup')
                                            Super Grupo
                                        @else
                                            Grupo
                                        @endif

                                    </td>
                                    <td>
                                        <div class="btn-group card-option">
                                            <button type="button" class="btn has-ripple btn-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="feather icon-more-horizontal"></i>
                                            <span class="ripple ripple-animate" style="height: 20px; width: 20px; animation-duration: 0.689655s; animation-timing-function: linear; background: rgb(136, 136, 136); opacity: 0.4; top: 1.375px; left: -2.5px;"></span></button>
                                            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right" >
                                                
                                                <li class="dropdown-item minimize-card">
                                                    <a type="button" id="{{$chat['id']}}" onclick="sendMessage(this.id)" data-toggle="modal" data-target="#messageModal"><span> Enviar Mensagem</span><span style="display:none"><i class="feather icon-plus"></i> expand</span>
                                                    </a>
                                                </li>
                                                
                                                <li class="dropdown-item close-card">
                                                    <a type="button" id="{{$chat['link']}}" onclick="copyToClipboard(this.id)">
                                                    Copiar Link
                                                    </a>
                                                </li>
                                                
                                                <li class="dropdown-item close-card">
                                                    <a type="button" class="ban" id="{{$chat['id']}}" data-toggle="modal" data-target="#banModal">
                                                    Banir um usuário
                                                    </a>
                                                </li>

                                                <li class="dropdown-item close-card">
                                                    <a type="button" href="javascript:;" onclick="openModalReplicaChat('{{$chat['id']}}')">
                                                        Replicar conversa
                                                    </a>
                                                </li>

                                                <li class="dropdown-item danger close-card">
                                                    <a type="button" onclick="deleteChat(this)" id="{{$chat['id']}}">
                                                        Deletar Grupo
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- prject ,team member start -->


        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>

<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<!-- <script src="{{asset('assets/js/plugins/apexcharts.min.js')}}"></script> -->
<script src="{{asset('assets/js/vendor-all.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/ripple.js')}}"></script>
<script src="{{asset('assets/js/pcoded.min.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2@11.js')}}"></script>
<script src="{{asset('assets/js/selectize.js')}}"></script>
    
<!-- custom-chart js -->

<!-- <script src="{{asset('assets/js/pages/dashboard-main.js')}}"></script> -->

</body>

</html>

<script>
    function deleteChat(element){        
        
        Swal.fire({
            title: 'Tem certeza?',
            text: "Você não poderá desfazer está ação!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, desejo excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "GET",
                    url: "{{ url('/delete-chat/') }}"+'/'+element.id,
                
                    error: function(res) {
                        console.log(res);
                    },
                    success: function(res) {
                        console.log(res);
                    },
                });

                Swal.fire(
                    'Deletado!',
                    'Grupo Apagado',
                    'success'
                )

                $(element).closest('tr').remove();
            }
        })
    }
    function openModalReplicaChat(chatId) {
        setInterval(() => {
            $("#groups").selectize({
                valueField: "id",
                labelField: "title",
                searchField: "title",
                options: [],
                create: false,
                preload: true,
                render: {
                    option: function (item, escape) {
                        return ("<div>" + escape(item.title) + "</div>");
                    },
                },
                load: function (query, callback) {
                    $.ajax({
                        url: "{{ action('\App\Http\Controllers\ChatController@getChats') }}",
                        type: "GET",
                        dataType: "json",
                        data: {query: query, chatId: chatId},
                        error: function () {
                            callback();
                        },
                        success: function (res) {
                            callback(res);
                        },
                    });
                },
                onInitialize: function() {
                    var selectize = this;

                    $.ajax({
                    url: "/chats/chat-replicate/"+chatId,
                    type: 'GET',
                    success: function(data) {
                        // res.forEach(function(existingOption) {
                        //     self.addOption({value:existingOption.id,text:existingOption.title});
                        //     self.addItem(13); 
                        //     self.setValue()
                        //     console.log(self);
                        // });

                        selectize.addOption(data); // This is will add to option
                        var selected_items = [];
                        $.each(data, function( i, obj) {
                            selected_items.push(obj.id);
                        });
                        selectize.setValue(selected_items)
                    }
                    });
                },
            });
        }, 100);
        Swal.fire({
            title: 'Selecione os grupos a copiar as mensagens',
            html: '<select multiple="multiple" name="" id="groups"></select>',
            icon: 'info',
            onBeforeOpen: () => {
                alert(156);
            },
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "{{ action('\App\Http\Controllers\ChatController@replicate') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "chat_id": chatId,
                        "chats_id": $("#groups").val()
                    },
                    error: function(res) {
                        console.log(res);
                    },
                    success: function(res) {
                        console.log(res);
                    },
                });

                Swal.fire(
                    'Concluido!',
                    'Replica ativada',
                    'success'
                )
            }
        })
    }
    $('.ban').on('click',function(){
        $('.chat_members').empty();
        $('.loading').css('display','flex');
        $('.table-users').css('display','none');
        var chat_id = $(this).attr('id');
            $.ajax({
                type: "GET",
                url: "{{ url('/show/') }}"+'/'+chat_id,

                error: function(res) {
                    console.log(res);
                },
                success: function(res) {
                    res.forEach(e => {
                        
                        if(e.ban == 1){
                            $('.chat_members').append(`
                            <tr>                                   
                                <td>`+e.first_name+`</td>
                                <td>`+e.last_name+`</td>
                                <td>`+e.username+`</td>
                                <td>
                                    <div class=action-`+e.id+`>
                                        <button type="button" title="Banir Membro" onclick="banMember(`+chat_id+`,`+e.id+`)" class="btn btn-icon btn-danger has-ripple size-litle">
                                        <i class="feather icon-slash"></i><span class="ripple ripple-animate" style="height: 25px; width: 25px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -8.1875px; left: -10.4219px;"></span>
                                        </button>
                                    </div>
                                
                                </td>                
                            </tr>
                            `);
                        }else{
                            $('.chat_members').append(`
                            <tr>                                   
                                <td>`+e.first_name+`</td>
                                <td>`+e.last_name+`</td>
                                <td>`+e.username+`</td>
                                <td>
                                    <div class=action-`+e.id+`>
                                        <button type="button" title="Desbanir Membro" onclick="unbanMember(`+chat_id+`,`+e.id+`)" class="btn btn-icon btn-success has-ripple size-litle">
                                        <i class="feather icon-check-circle"></i><span class="ripple ripple-animate" style="height: 25px; width: 25px; animation-duration: 0.694444s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -2.1875px; left: 3.21875px;"></span>
                                        </button>
                                    </div>
                                </td>                
                            </tr>
                            
                            `);
                        }
                        
                        if(e.is_admin == 1){
                            $('.action-'+e.id).empty();
                            $('.action-'+e.id).append(`Admin`);
                        }
                        
                        
                    });
                    
                    $('.loading').css('display','none');
                    $('.table-users').css('display','inline-table');
                },
            });
        
            
            
        
    });
   

    function copyToClipboard(text) {

        navigator.clipboard.writeText(text);
        Swal.fire(
        'Link Copiado!',
        '',
        'success'
        )
    }

    function sendMessage(chat_id){
        $('.message-chat-sender').val(chat_id);
    }
    
    function banMember(chat_id,user_id){
        $.ajax({
            type: "GET",
            url: "{{ url('/ban-member/') }}"+'/'+chat_id+'/'+user_id,
           
            error: function(res) {
                console.log(res);
            },
            success: function(res) {
                document.location.reload();
                console.log(res);
            },
        });
    }

    function unbanMember(chat_id,user_id){
        $.ajax({
            type: "GET",
            url: "{{ url('/unban-member/') }}"+'/'+chat_id+'/'+user_id,
           
            error: function(res) {
                
                console.log(res);
            },
            success: function(res) {
                document.location.reload();
                console.log(res);
            },
        });
    }

   
     
</script>