<html>
<head>
	<title>Supplier</title>
<link rel="stylesheet" type="text/css" href= "<?php echo base_url('css/bootstrap.css');?>">
<link rel="stylesheet" type="text/css" href= "<?php echo base_url('css/typeahead.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/formValidation.min.css');?>">

</head>
<body>




	<div class="container">
	<div class="well col-sm-6">
	<h1> SUPPLIER </h1>
	<form class="form-horizontal" class="form-horizontal" id="productForm"  method="post" action="<?php echo site_url('supplier/add_supplier');?>">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">ShopID</label>
			<div class="col-sm-4">
				<select id="user_id" name="select_id" class="form-control">
					<option value="001">001</option>
					<option value="002">002</option>
					<option value="003">003</option>
					<option value="004">004</option>
				</select>
			</div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Supplier Name</label>
	    <div class="col-sm-4">
	      <input type="text" name="name" class="form-control" id="name" placeholder="Name">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Supplier Address</label>
	    <div class="col-sm-4">
	     <textarea class="form-control" name="adres" id="adres" rows="3"></textarea>
	     <input type="hidden" id="supplier_ID">
	    </div>
	  </div>
	  <div class="checkbox col-sm-offset-2">
	    <label>
	      <input type="checkbox" name="status" id="status">Status
	    </label>
  		</div>
  		<br>
	 	<div class="row col-sm-offset-1">
	 		<button type="submit" class="btn btn-default">Add</button>
	 		<button type="button" class="btn btn-default" onClick="update_suplier();">Update</button>
			<button type="button" class="btn btn-default" onclick="delete_supplier()">Delete</button>
			<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Search</button>
			<button type="button" class="btn btn-default" onclick="fetch_supplier();">Fetch</button>
		</div>
		 </form>
	 </div>
	 <div class="col-sm-6">
	 	<table class="table table-bordered table striped">
						<thead >
							<tr>
								<td>ID</td>
								<td>Name</td>
								<td>Address</td>
								<td>-Status</td>
							</tr>
						</thead>
						<tbody id="display_data"></tbody>
					</table>
<div>
	 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Supplier Details</h4>
	      </div>
	      <div class="modal-body">
		<form class="form-inline">
			<div class="form-group">
				<div class="form-group">
				   <input type="text" class="form-control twitter-typeahead" id="my_typerhead">
			   		<!--  <input type="text" name="search_suplier" id="search_suplier" class="form-control">-->
			  	</div>
			  	<button type="button"  class="btn btn-default" onclick="get_user()">Search</button>
			</div>
		</form>
	    </div>
	  </div>
	</div>
</div>
</div>
</body>

<script type="text/javascript" src="<?php echo base_url('js/jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/Typeahead.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/formValidation.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/framework/bootstrap.js');?>"></script>
<script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>



<script type="text/javascript">

$(document).ready(function() {
    $('#productForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The username is required'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The username must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
			adres: {
                    validators: {
                        notEmpty: {
                            message: 'The address is required'
                        },
                        stringLength: {
                            max: 700,
                            message: 'The message must be less than 700 characters long'
                        },
                        regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                    }
                },



            select_id: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    }
                }
            }
            
        }
    });
});








function get_user()
{
	var Username =$('#my_typerhead').val();
	
	$.ajax(
	{
		type:"POST",//if we use get array in back end $_GET
		url:"<?php echo site_url('supplier/search_supplier');?>",
		dataType: 'json',
		data:{name:Username},
		success: function(data)
		{
			
			if(data!=null)
			{
				$('#name').val(data.name);
				$('#adres').val(data.adres);
				$('#supplier_ID').val(data.id);
				// $('#id').val(data.id);
				// $('#adres').val(data.adres);
				 $('#myModal').modal('hide');
			}
			else
			{
				alert('Record not found');
			}
		}

	});
}

function delete_supplier()
	{
	var id =$('#supplier_ID').val();

	$.ajax({
			type:"POST",
			data:{'id':id },
			url:"<?php echo site_url('supplier/delete_supplier');?>",
			dataType: 'json',
			success: function()
			{
				alert("deleted");
			},
			error:function(){
				alert("Not deleted");
			}
		});
	}

function update_suplier()
{
	var name =$('#name').val();
	var adres=$('#adres').val();
	var sup_id=$('#supplier_ID').val();

	$.ajax({
		type:"POST",//if we use get array in back end $_GET
		url:"<?php echo site_url('supplier/update_supplier');?>",
		dataType: 'json',
		data:{name:name,address:adres,sid:sup_id},
		success:function(data)
		{  if(data)
			{
			alert("Supplier data updated successfully");
			}
			else
			{
				alert("Supplier data was not updated ");
			}	
		},
		error:function()
		{
			alert('Process failure');
		}

	});
}

function fetch_supplier()
{
	$.ajax(
	{
        type:'GET',
        url:"<?php echo site_url('supplier/fetch_supplier'); ?>",
        dataType:'json',
        success: function(data)
        {
            insertDataTable(data);
        	//$.each
        	//inorder to 
			//alert(data);
         },
		 error: function()
          {
            alert("error");
          }
    });
}

function insertDataTable(data)
{
	var a = ""; 
	var b= "";
	var count=0;
	for(j=0;j<data.length;j++)
	{
		count++;
		a += '<tr> <td>Shop'+ data[j].id + '</td> <td>' + data[j].name + '</td> <td>' + data[j].address + '</td> <td>'+ data[j].status +'</td></tr>';
		
	}	
	document.getElementById('display_data').innerHTML += a;	
	//document.getElementById('Total').innerHTML += data['u.deatils'].length;
	//document.getElementById('average').innerHTML += data['u.age'].u_avg;
	$('#my_typerhead').typeahead(null,
	{
		Name:'name',
		display:'SUPPLIER_Name',
		limit:10,
		source:name
	});
}

/*
$(document).ready(function()
{
	var ages=new Bloodhound(
	{
		datumTokenizer: Bloodhound.tokenizers.whitespace,
		queryTokenizer: Bloodhound.tokenizers.whitespace,//do the search

		//local:age
		remote:{
			cache : false,
			url:"<?php echo site_url('supplier/aa/q');?>",
			wildcard:'q'
		}
	});

$('#my_typerhead').typeahead(null,
	{
		Name:'name',
		display:'SUPPLIER_Name',
		limit:10,
		source:ages
	});
});


*/
</script>
</html>