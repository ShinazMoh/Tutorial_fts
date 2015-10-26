<html>
<head>
	<title></title>
	<link href="<?php echo base_url('/css/bootstrap.css');  ?>" rel="stylesheet">
	<link href="<?php echo base_url('/css/typeahead.css');  ?>" rel="stylesheet">
	<link href="<?php echo base_url('/css/bootstrap-select.min.css');  ?>" rel="stylesheet">

	<?php

	$error = validation_errors();

	if(isset($error))
	{
		echo validation_errors();
	}

	if($error_flag=='true') {
		
		echo "Please Fill the necessary fields before adding.";
	}
	
?>
</head>

<body>
<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<h1>Customers</h1>
		</div>
		<div class="col-sm-6">
			<form class="form-inline">
				<button type="button" onclick="search_customer();" class="btn btn-primary">Search User</button>
				   
				<div class="form-group">
				 <input type="text" class="form-control" id = "my_typeahead">
			 	</div>
			</form>
		</div>
	</div>

	<div class="well">
		<div class="row">
			<div class="col-sm-6">
				<form class="form-horizontal" method="POST">
					<div class="form-group text-center" >
						<label for="Name" class="col-sm-4 control-label">Name : </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="Name" placeholder="Name" >
							<input type="hidden" id="CusID" >
						</div>

					</div>
					<div class="form-group text-center" >
						<label for="Address" class="col-sm-4 control-label">Address : </label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="3"  id="Address"placeholder="Address"></textarea>
						</div>
					</div>
					<div class="form-group text-center">
						<div class="col-sm-4 col-sm-offset-4">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="Status" id="Status">Status
								</label>
							</div>
						</div>
					</div>
					<div class="form-group text-center">
						<label class = "col-sm-4 control-label">Shop ID</label>
						<div class="col-sm-8">
							<select id = "shop_select" class = "form-control selectpicker">
							</select>
						</div>
					</div>
				</form>
			</div>

			<div class="col-sm-6">
			<table class="table table-bordered table-striped table-hover table-condensed" id="tblUser">
				<thead>
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>Address</th>
					</tr>
					<tbody id="tblRow"> 
					</tbody>
						<tfoot id="tblFoot">
							<tr>
								<th colspan='2' >Total No. Customers</th>
								<th id="total"> </th>
							</tr>
						</tfoot>
					</thead>
				</table>
			</div>

		</div>
	</div>
	<div class="well">
		<div class="row">
			<div class="col-sm-12 col-sm-offset-2">
				<div class="col-sm-2">
					<button type="button" onClick="save();" class="btn btn-primary">Add Now</button>
				</div>

				<div class="col-sm-2">
					<button type="button" onClick="GetData();" class="btn btn-info">View</button>
				</div>
					
				<div class="col-sm-2">
					<button type="button" onClick="deleteCustomer();" class="btn btn-danger">Delete</button>
				</div>	
				<div class="col-sm-2">
					<button type="button" onClick="update();" class="btn btn-warning">update</button>
				</div>
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

$(document).ready(function() 
{

	var names = new Bloodhound({

   		queryTokenizer: Bloodhound.tokenizers.whitespace,
   		datumTokenizer: Bloodhound.tokenizers.whitespace,
  		
  		remote : {
  			url : "<?php echo site_url('/Customer/search_name/q');?>",
  			wildcard : 'q' 
  		}
	});

	$('#my_typeahead').typeahead(null,{
		limit : 10,
		displayKey : 'Name',
		source : names
	});

	fetchShops();
});

function save()
{
	var name = $('#Name').val();
	var address = $('#Address').val();


	if($('#Status').is(":checked"))
	{
		var status = 1;
	}
	else
	{
		var status = 0;
	}

	$.ajax({
		  	
	  	type:'POST',
	  	data:  {'name' : name, 'address' : address, 'status' : status},
        url:"<?php echo site_url('/Customer/save');?>",
        dataType : 'json',
        success:function(data)
        {
        	alert("Added");
        },
        error:function()
        {
        	alert("Error Occured!!!");
        }
	});
}

function GetData()
{
 $.ajax({
    type:'GET',
    url:"<?php echo site_url('/Customer/GetData');?>",
    dataType : 'json',
    success:function(data)
    {
    	$('#tblRow').empty();

    	writedata(data);
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
		a +='<tr><td>' + count + '</td><td>' + data['detail'][j].Name + '</td><td>' +  data.detail[j].Address + '</td></tr>';	   
	}	
	
	document.getElementById('tblRow').innerHTML += a;	

	document.getElementById('total').innerHTML += data['detail'].length;

}

function search_customer()
{
	var name = $('#my_typeahead').val();
	$.ajax(
	{		  
		type : 'POST',	
	  	url : "<?php echo site_url('/Customer/search_customer');?>",
	  	data : {'name' : name},
        dataType : 'json',
        success:function(data)
        {
        	if(data!=null)
        	{
        		$('#Name').val(data.Name); 
        		$('#Address').val(data.Address); 
        		$('#CusID').val(data.id); 

        		if(data.Status==1)
        		{
        			$("#Status").prop( "checked", true );
        		}    		
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



function deleteCustomer()
{
	var id = $('#CusID').val();

	 $.ajax({
        type:'POST',
        data:  {'id' : id},
        url:"<?php echo site_url('/Customer/delete');?>",
        dataType : 'json',
        success:function(data) 
        {
        	alert("Deleted");
        },
      	error:function()
        {
        	alert("Error Occured!!!");
        }

    });
}

function fetchShops()
{
	$('#shop_select').selectpicker();

	$.ajax(
	{
		url : '<?php echo site_url("customer/fetch_shops")?>',
		type : 'post',
		dataType : 'json',
		error : function() {alert('An Error Occured.')},
		success : function(data)
		{
			$('#shop_select').empty();
			$('#shop_select').append('<option value = "">Select Shop</option>');
			//$('#shop_select').append(new Option('Select Shop',''));
			if(!$.isEmptyObject(data))
			{
				$.each(data,function(index,object)
				{
					console.log(index + " : " + object.name);
					$('#shop_select').append(new Option(object.name,object.id));
				});
			}
			$('#shop_select').selectpicker('refresh');			
		}
	});
}

function update()
{
	var id = $('#CusID').val();
	var name = $('#Name').val();
	var address = $('#Address').val();


	if($('#Status').is(":checked"))
	{
		var status = 1;
	}
	else
	{
		var status = 0;
	}

	$.ajax({
		  	
	  	type:'POST',
	  	data:  {'id' : id, 'name' : name, 'address' : address, 'status' : status},
        url:"<?php echo site_url('/Customer/update');?>",
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


</script>
</body>
</html>