@extends('layouts.app')


@section('title')
| Services
@endsection

@section('styles')
<style type="text/css" media="screen">
	.shopping-cart-btn{
        transition: 50ms;
	}
	.shopping-cart-btn:hover{
		transform: scale(1.2);
	}
</style>
@endsection

@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-md-8">
				<div class="panel panel-warning" style="border-color: #FBB22F;">
					<div class="panel-heading" style="background-color: #FBB22F;">
						<div class="dropdown">
						 	<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Services&nbsp
						 		<span class="caret"></span>
						 	</button>
						 	<h4 id="dropdown-menu" class="pull-right" style="color: white; font-weight: 900;">Plaques</h4>
						 	<ul class="dropdown-menu">
								@foreach ($services as $service)
							    	<li class="services" id="{{ $service->id }}"><a>{{ $service->service }}</a></li>
								@endforeach
						 	</ul>
						</div>
					</div>
					<div class="panel-body" id="product-body">A Basic Panel</div>
				</div>
			</div>

	        <div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">Cart
						<!-- <button type="" class="btn btn-warning btn-sm pull-right">Checkout</button> -->
						<FORM action="https://www.paypal.com/cgi-bin/webscr" method="post">
								<?php $i=1; ?>
							@foreach ($carts as $cart)
								<input type="hidden" name="cmd" value="_cart">
								<input type="hidden" name="upload" value="1">
								<input type="hidden" name="business" value="eldrinbernardino01@gmail.com">
								<input type="hidden" name="item_name_{{$i}}" value="{{ $cart->name }}">
								<input type="hidden" name="amount_{{$i}}" value="{{ $cart->amount }}">
							@endforeach
							<input type="submit" class="pull-right" value="PayPal">
						</form>
					</div>
					<div class="panel-body">
						@foreach ($carts as $cart)
					    	<!-- <li class="services" id="{{ $cart->picture_id }}"><a>{{ $cart->path }}</a></li> -->

					    	<img src="{{ $cart->path }}" style="width: 100px; border: solid 3px #d3e0e9; border-radius: 15px; margin: 5px;">
					   
					    	<span class="badge" style="position: relative; right: 100px; top: 45px; border-radius: 20px; border: none; ">{{ $cart->quantity }} pcs</span>
					    	<span class="badge" style="position: relative; right: 100px; top: 45px; border-radius: 20px; border: none; ">{{ $cart->name }}</span>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){



        $serviceId = 1;
        // alert ($serviceId);

        $.ajax({
            type: "get",
            url: '/getPictures',
            data: {serviceId: $serviceId},
            success: function(data) {
            	// alert(JSON.stringify(data));

                $("#product-body").html("");
               	$statement = "";

                data.forEach(function(pictures){
                	$statement += "<img src="+pictures.path+" style=\"width: 180px; border: solid 3px #d3e0e9; border-radius: 15px; margin: 5px;\">";
                	$statement += "<span class=\"badge\" style=\"position: relative; margin-right: 0px; margin-left: -65px; left: 0px; top: 30px;\">"+pictures.name+"</span>";
                	$statement += "<span class=\"badge\" style=\"position: relative; margin-right: 0px; margin-left: -60px; left: 0px; top: 10px;\">"+pictures.price+" PhP</span>";
                	$statement +="<button id="+pictures.id+" class=\"btn btn-sm shopping-cart-btn\" style=\"border-radius: 100px; border: none; padding: 10px; width: 80px; background: #FBB22F; margin-left: -80px; margin-bottom: -135px;\" onclick=\"addtocart("+pictures.id+")\">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp   <span class=\"fa fa-shopping-cart\" style=\"color: white;\"></span></button>";
                	$statement += "<input type=\"number\" id=\"quantity"+pictures.id+"\" class=\"input-number\" value=\"0\" min=\"1\" style=\" width: 45px; position: relative; right: 73px; top: 68.5px; border-radius: 20px; border: none; \">";
                	
                });
                $("#product-body").append($statement);
            }
        });


    	$(".services").click(function(){
            $dropdownName = $(this).text();
            // alert ($dropdownName);
            $("#dropdown-menu").html($dropdownName);

            $serviceId = $(this).attr('id');
            // alert ($serviceId);

            $.ajax({
                type: "get",
                url: '/getPictures',
                data: {serviceId: $serviceId},
                success: function(data) {
	            	// alert(JSON.stringify(data));

	                $("#product-body").html("");
	               	$statement = "";

	                data.forEach(function(pictures){
	                	$statement += "<img src="+pictures.path+" style=\"width: 180px; border: solid 3px #d3e0e9; border-radius: 15px; margin: 5px;\">";
	                	$statement += "<span class=\"badge\" style=\"position: relative; margin-right: 0px; margin-left: -65px; left: 0px; top: 30px;\">"+pictures.name+"</span>";
	                	$statement += "<span class=\"badge\" style=\"position: relative; margin-right: 0px; margin-left: -60px; left: 0px; top: 10px;\">"+pictures.price+" PhP</span>";
	                	$statement +="<button id="+pictures.id+" class=\"btn btn-sm shopping-cart-btn\" style=\"border-radius: 100px; border: none; padding: 10px; width: 80px; background: #FBB22F; margin-left: -80px; margin-bottom: -135px;\" onclick=\"addtocart("+pictures.id+")\">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp   <span class=\"fa fa-shopping-cart\" style=\"color: white;\"></span></button>";
	                	$statement += "<input type=\"number\" id=\"quantity"+pictures.id+"\" class=\"input-number\" value=\"0\" min=\"1\" style=\" width: 45px; position: relative; right: 73px; top: 68.5px; border-radius: 20px; border: none; \">";
	                	
	                });
	                $("#product-body").append($statement);
                }
            });
        });


    });



    function addtocart(pictureId) {
        // alert (pictureId);
        // $quantity = 2;
        $quantity = $("#quantity"+pictureId).val();
        // alert ($quantity);
        $.ajax({
                type: "get",
                url: '/addToCart',
                data: {quantity: $quantity, pictureId: pictureId},
                success: function() {
                    // alert (response);
                    window.location = "/servicess";
                }
        });
    }
</script>
@endsection
