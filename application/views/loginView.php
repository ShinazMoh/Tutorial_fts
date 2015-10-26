<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="<?php echo base_url('/css/bootstrap.css');  ?>" rel="stylesheet">
</head>
<?php

	if ($error_flag=='true') {
		
		echo "Username or Password is incorrect.";
	}

?>
<body>

<div class="container">
	<h1 class="text-center">Login <small>Form</small></h1>	
	<DIV class="well">
		<div class="row">						
			<div class="col-md-6 col-sm-offset-4">
				<form class="form-horizontal" method="post" action="<?php echo site_url('/login/Submit');?>">
					<div class="form-group text-center">
						<label for="Username" class="col-sm-2 control-label ">Username</label>
						<div class="col-xs-4">
							<input type="text" class="form-control" name="Username" placeholder="Username">
						</div>
					</div>

					<div class="form-group text-center">
						<label for="Password" class="col-sm-2 control-label">Password</label>
						<div class="col-xs-4">
							<input type="password" class="form-control" name="Password" placeholder="Password">
						</div>
					</div>
						<div class="col-sm-4 col-sm-offset-2">
							<button type="submit" class="btn btn-primary">Login</button>
							<button type="submit" class="btn btn-danger">Exit</button>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
		 					<a href= "<?php echo site_url('login/Forget_Pass');?>">Forget Password</a>
		 				</div>
				</form>
			</div>
		</div>
	</DIV>
</div>
</body>
</html> 