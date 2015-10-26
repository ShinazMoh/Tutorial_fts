<html>
<head><title>Home View</title>
	<link href="<?php echo base_url('/css/bootstrap.css');  ?>" rel="stylesheet">
	<link href="<?php echo base_url('/css/typeahead.css');  ?>" rel="stylesheet">
	<link href="<?php echo base_url('/css/bootstrap-select.min.css');  ?>" rel="stylesheet">

<style type="text/css">

.marginBottom-0 {margin-bottom:0;}

.dropdown-submenu{position:relative;}
.dropdown-submenu>.dropdown-menu{top:0;left:100%;margin-top:-6px;margin-left:-1px;-webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;}
.dropdown-submenu>a:after{display:block;content:" ";float:right;width:0;height:0;border-color:transparent;border-style:solid;border-width:5px 0 5px 5px;border-left-color:#cccccc;margin-top:5px;margin-right:-10px;}
.dropdown-submenu:hover>a:after{border-left-color:#555;}
.dropdown-submenu.pull-left{float:none;}.dropdown-submenu.pull-left>.dropdown-menu{left:-100%;margin-left:10px;-webkit-border-radius:6px 0 6px 6px;-moz-border-radius:6px 0 6px 6px;border-radius:6px 0 6px 6px;}


</style>

</head>
<body>





<div class="container ">
	<div class="row">
		<div class="col-sm-12">
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="#">Tapro Ceramics</a>
		    </div>

		    
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Main Menu <span class="caret"></span></a>
		          <ul class="dropdown-menu">

		           <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Suppliers</a>
							 <ul class=" dropdown-menu">

			            <li><a href="#">Suppliers View</a></li>
			            <li><a href="#"> Suppliers Report View</a></li>
			          </ul>
		      		</li>

		      		 <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Customers</a>
							<ul class="dropdown-menu">
			            <li><a href="<?php echo site_url('customer')?>">Customers View</a></li>
			            <li><a href="<?php echo site_url('Report')?>"> Customers Report View</a></li>
			          </ul>
		      		</li>

		      		 <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Items</a>
							<ul class="dropdown-menu">
			            <li><a href="#">Items View</a></li>
			            <li><a href="#"> Items Report View</a></li>
			          </ul>
		      		</li>

		      		 <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Shops</a>
							<ul class="dropdown-menu">
			            <li><a href="#">Shops View</a></li>
			            <li><a href="#"> Shops Report View</a></li>
			          </ul>
		      		</li>


		      		 <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Users</a>
							 <ul class="dropdown-menu">
			            <li><a href="#">Users View</a></li>
			            <li><a href="#"> Users Report View</a></li>
			          </ul>
		      		</li>


		          </ul>
		        </li>
		      </ul>
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="<?php echo site_url('/login');?>">Logout</a></li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="#">Account</a></li>
		            <li><a href="#">Privillage</a></li>
		            <li><a href="#">Policies</a></li>
		            <li role="separator" class="divider"></li>
		            <li><a href="#">Deactivate</a></li>
          	</ul>
		    </div>
		  </div>
		</nav>
		</div>


		</div>
	</div>
</div>



<script type="text/javascript" src="<?php echo base_url('/js/jquery-1.11.3.min.js');  ?>" ></script>
<script type="text/javascript" src="<?php echo base_url('/js/bootstrap.js');  ?> "></script>
<script type="text/javascript" src="<?php echo base_url('/js/bootstrap-select.js');  ?> "></script>
<script type="text/javascript" src="<?php echo base_url('/js/Typeahead.js');  ?> "></script>
<script type="text/javascript" src="<?php echo base_url('/js/bloodhound.js');  ?> "></script>

<script type="text/javascript">

(function($){
	$(document).ready(function(){
		$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
			event.preventDefault(); 
			event.stopPropagation(); 
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});
	});
})(jQuery);

</script>


</body>
</html>