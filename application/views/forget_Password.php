<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="<?php echo base_url('/css/bootstrap.css');  ?>" rel="stylesheet">
</head>

<?php
	$error = validation_errors();

	if(isset($error))
	{
		echo validation_errors();
	}
?>

<body>
<div class="container">
		<h1 class="text-center">Forget <small>Password</small></h1>	
	<DIV class="well">
		<div class="row">						
			<div class="col-md-6 col-sm-offset-4">
				<form class="form-horizontal" method="post" action="<?php echo site_url('/login/CheckPass');?>">
					<div class="form-group text-center">
						<label for="Username" class="col-sm-2 control-label ">Username</label>
						<div class="col-xs-4 col-sm-offset-1">
							<input type="text" class="form-control" name="Username" placeholder="Username">
						</div>
					</div>

					<div class="form-group text-center">
						<label for="Password" class="col-sm-2 control-label">Password</label>
						<div class="col-xs-4 col-sm-offset-1">
							<input type="password" class="form-control" name="Password" placeholder="Password">
						</div>
					</div>

					<div class="form-group text-center"> 
						<label for="Re-Password" class="col-sm-2 control-label">Re-Password</label>
						<div class="col-xs-4 col-sm-offset-1">
							<input type="Re-Password" class="form-control" name="Re-Password" placeholder="Re-Password">
						</div>
					</div>
					<div class="form-group text-center"> 
						<div class="col-sm-4 col-sm-offset-3">
							<button type="submit" class="btn btn-primary">Save</button>
							<button type="submit" class="btn btn-danger">Exit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>