<html>
<head>
<title></title>
</head>
	<link href="<?php echo base_url('/css/bootstrap.css');  ?>" rel="stylesheet">
<?php

	$error = validation_errors();

	if(isset($error))
	{
		echo validation_errors();
	}

	if($error_flag=='true') {
		
		echo "Successfully Added.";
	}
	
?>
<body>
<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<h1>Employee Form</h1>
		</div>
		<div class="col-sm-6">
				<button type="button" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-link">Search User</button>
		</div>
	</div>

<div class="well">
	<div class="row">
		<div class="col-sm-6">
			<form class="form-horizontal" method="post" action="<?php echo site_url('/Employee/save');?>">
				<div class="form-group" class="text-center">
					<label for="Name" class="col-sm-4 control-label">Name : </label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="Username" placeholder="Name" >
						<input type="hidden" id="UserID" >
						<!-- <input type="text" value="<?php //echo $error_flag['Name'];?>" class="form-control" name="Username" placeholder="Name" > -->
					</div>
				</div>
				<div class="form-group" class="text-center">
					<label for="Age"  class="col-sm-4 control-label">Age : </label>
					<div class="col-sm-8">
						<select id="Age" class="form-control">
						  <option>18</option>
						  <option>10</option>
						  <option>20</option>
						  <option>21</option>
						  <option>22</option>
						</select>
					</div>
				</div>
				<div class="form-group" class="text-center">
					<label for="Address" class="col-sm-4 control-label">Address : </label>
					<div class="col-sm-8">
						<textarea class="form-control" rows="3" id="Address"placeholder="Address"></textarea>
					</div>
				</div>
				<div class="form-group" class="text-center">
					<label for="lANG" class="col-sm-4 control-label">Preferred Language : </label>
					<div class="col-sm-8">
						<div class="radio" >
						  <label>
						    <input type="radio" id="lANG"  value="English" checked>English
						  </label>
						</div>
						<div class="radio">
						  <label>
						    <input type="radio" id="lANG"  value="Tamil">Tamil
						  </label>
						</div>
						<div class="radio">
						  <label>
						    <input type="radio" id="lANG" value="Sinhala">Sinhala
						  </label>
						</div>
					</div>
				</div>

				<div class="form-group" class="text-center">
					<div class="checkbox col-sm-4 control-label">
							<label>
							<input type="checkbox" id="Citizenship" value="1">Citizenship</label>
					</div>
				</div>
			</form>
		</div>
		<div class="col-sm-6">
			<table class="table table-bordered table-striped table-hover table-condensed" id="tblUser">
				<thead>
					<tr>
						<th>No.</th>
						<th>Username</th>
						<th>Age</th>
						<th>Address</th>
					</tr>
					<tbody id="tblRow"> 
					</tbody>
						<tfoot id="tblFoot">
							<tr>
								<th colspan='2' >Total No. Users</th>
								<th id="total"> </th>
							</tr>

							<tr>
								<th colspan='2' >Average Age : </th>
								<th id="avg"> </th>
							</tr>

						</tfoot>
				</thead>
			</table>
		</div>
	</div>
</div>
<div iv class="well">
	<div class = "row">
		<div class="col-sm-12 col-sm-offset-2">
			<div class="col-sm-2">
				<button type="button" class="btn btn-primary">Add Now</button>
			</div>

			<div class="col-sm-2">
				<button type="button" onClick="getUsers()" class="btn btn-info">View</button>
			</div>
						<!--onClick="alert($('#Name').val());" -->
			<div class="col-sm-2">
					<button type="button" onClick="deleteUsr();" class="btn btn-danger">Delete</button>
			</div>	
			<div class="col-sm-2">
					<button type="button" onClick="update();" class="btn btn-info">update</button>
					<!-- onClick=""window.location ='<?php //echo site_url('/home/');?>';"" -->
			</div>
		</div>
	</div>
</div>

<!-- Modal start -->
<div id="mymodal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	    	<div class="modal-body">
	    		<form class="form-horizontal">
					<div class="form-group" class="text-center">
						<div class="col-sm-8">
							<input type="text" class="form-control" id="Searchbar" placeholder="Username">
						</div>
						<div class="col-sm-2">
							<button type="button" onClick="search_user();" class="btn btn-info">Search</button>
						</div>
					</div>
				</form>
	    	</div>	     	
	    </div>
  	</div>
</div>
<!-- End Modal -->

<!-- If u put the link in up then the page will get late to load... becuase is firt read all the js and css files of bootstrap -->

<script type="text/javascript" src="<?php echo base_url('/js/jquery-1.11.3.min.js');  ?>" ></script>
<script type="text/javascript" src="<?php echo base_url('/js/bootstrap.js');  ?> "></script>
<script type="text/javascript">

function search_user()
{
	var searchbar = $('#Searchbar').val();
	$.ajax(
	{		  
		type : 'GET',	
	  	url : "<?php echo site_url('/Employee/search_user');?>",
	  	data : {searchbar : searchbar},
        dataType : 'json',
        success:function(data)
        {
        	if(data!=null)
        	{
        		$('#Username').val(data.Name); 
        		$('#Age').val(data.Age);
        		$('#Address').val(data.Address);
        		$('#UserID').val(data.Id);

        		$('#mymodal').modal('toggle');
        	}
        	else
        	{
        		alert("No Data Found");
        	}	
        },
        error:function()
        {
        	alert("Error Occured!!!");
        }
	});
} 

function update()
{
	var id = $('#UserID').val();
	var username = $('#Username').val();
	var age = $('#Age').val();
	var address = $('#Address').val();
	var lang = $('#lANG').val();

	if($('#Citizenship').val()!=null)
	{
		var citizenship = $('#Citizenship').val();
	}
	else
	{
		var citizenship = 0;
	}

	$.ajax({
		  	
	  	type:'POST',
	  	data:  {id : id, username : username, age : age, address : address, lang : lang, citizenship : citizenship},
        url:"<?php echo site_url('/Employee/update');?>",
        dataType : 'json',
        success:function()
        {
        	alert("Updated");
        },
        error:function()
        {
        	alert("Error Occured!!!");
        }
	});
}

function getUsers()
{
 $.ajax({
    type:'GET',
    url:"<?php echo site_url('/Employee/getUsers');?>",
    dataType : 'json',
    success:function(data) //geting the values from the getUsers fucntion
    {
    	//console.log(data['detail'][0].Name);
    	//console.log(data['average'][0].U_Age);
    	$('#tblRow').empty();

    	writedata(data);
    },
    error:function()
    {
    	alert("Error Occured!!!");
    }
    });
}

function deleteUsr()
{
	var id = $('#UserID').val();
	 $.ajax({
        type:'GET',
        data:  {id : id},
        url:"<?php echo site_url('/Employee/delete');?>",
        dataType : 'json',
        success:function(data) 
        {
        	alert("Delete");
        },
      	error:function()
        {
        	alert("Error Occured!!!");
        }

    });
}

function writedata(data)
{
	var a = ""; 
	var count =0;

	for(j=0;j<data['detail'].length;j++)
	{
		count++;
		a +='<tr><td>' + count + '</td><td>' + data['detail'][j].Name + '</td><td>' + data.detail[j].Age + '</td><td>' + data.detail[j].Address + '</td></tr>';	   
	}	
	
	document.getElementById('tblRow').innerHTML += a;	

	document.getElementById('total').innerHTML += data[0].length;

	document.getElementById('avg').innerHTML += data['average'].U_Age;		
}
	
	//document.getElementById('Name').value = 100;  //javascript

	//Jquery 

	//seeting value by unique
	//$('#Name').val("shinaz"); 

	//seeting value by class
	//$('.form-control').val("macki");


	//in here if u want to run any fucntion after the page sucessfully loads than use the below method
	//this is recommanded to use... becuase in below we are creating a temp fucntion so.. low memory is used..

	//ready is a function and we are pasing another temp fucntion as parameters so.. it called as callback fucntion
	// $(document).ready(function(){
	// 	//to hide the the modal
	// 	$('#mymodal').on("hide.bs.modal",function(){
	// 		alert("modal is hidden");
	// 		});

	// });

	// //after clcking the button this will trigger..this is too callback fucntion bcuz click is a fucntion and we are creating anothert fucntion as temp and send as para to the clcik fucntion
	// 	$("#mybutton").click(function(){ 
 			
	// 			$("#mymodal").modal({ 
	// 					//backdrop means in normal if a popup comes then back contents will get blur so if we dnt want to get it blur then we can set it off..
	// 					//if we press Esc on keybord then popup will exist so if we want to set it off..
	// 			backdrop:false,keyboard:true
					
	// 			});

	// 			$("#mymodal").modal('show'); //trigger the modal

				
			
	// 	});




</script>
</body>
</html>