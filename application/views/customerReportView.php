<html>
<head>
<title></title>
</head>
	<link href="<?php echo base_url('/css/bootstrap.css');  ?>" rel="stylesheet">
	<link href="<?php echo base_url('/css/bootstrap-select.min.css');  ?>" rel="stylesheet">
	<link href="<?php echo base_url('/css/bootstrap-datepicker3.min.css');  ?>" rel="stylesheet">
	<link href="<?php echo base_url('/css/typeahead.css');  ?>" rel="stylesheet">
	<link href="<?php echo base_url('/css/dataTables.bootstrap.css');  ?>" rel="stylesheet">
<body>

<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<h1>Customer Report</h2>
		</div>
	</div>

	<div class="well">
		<div class="row">
			<div class="col-sm-12">
				<form class="form-inline">
						<div class="form-group selectpicker" data-live-search='true'>
							<label class = "col-sm-4 control-label">Name</label>
							<div class="col-sm-8">
								<select id = "name_select" class = "form-control selectpicker" data-live-search='true'>
								</select>
							</div>
						</div>
					<div class="form-group">
						<div class="input-group date">
						    <input class="form-control" id="mydate"/>
						    <div class="input-group-addon">
						    	<span class="glyphicon glyphicon-calendar"></span>
						    </div>
						</div>
					</div>

					<div class="form-group">
					    <input type="text" class="form-control" id = "my_typeahead">
				 	</div>

					<div class="form-group">
				  		<button type="button" class="btn btn-success" onclick="filtertable();">Report</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<table class="table table-bordered table-striped table-hover table-condensed" id="my_table">
				<thead>
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>Address</th>
					</tr>
					<tbody id="tblRow">
					</tbody>
				</thead>
			</table>
		</div>
	</div>
</div>



<script type="text/javascript" src="<?php echo base_url('/js/jquery-1.11.3.min.js');  ?>" ></script>
<script type="text/javascript" src="<?php echo base_url('/js/bootstrap-datepicker.js');  ?>" ></script>
<script type="text/javascript" src="<?php echo base_url('/js/bootstrap.js');  ?> "></script>
<script type="text/javascript" src="<?php echo base_url('/js/bootstrap-select.js');  ?> "></script>
<script type="text/javascript" src="<?php echo base_url('/js/Typeahead.js');  ?> "></script>
<script type="text/javascript" src="<?php echo base_url('/js/bloodhound.js');  ?> "></script>
<script type="text/javascript" src="<?php echo base_url('/js/jquery.dataTables.js');  ?>" ></script>
<script type="text/javascript" src="<?php echo base_url('/js/dataTables.bootstrap.js');  ?>" ></script>


<script type="text/javascript">

$(document).ready(function()
{

	fetchShops();

	$('.selectpicker').selectpicker(); 

	$('.selectpicker').selectpicker('val', 2); 
	
	$('.date').datepicker(
		{
			format : 'yyyy-mm-dd'
		});

	

	var address = new Bloodhound({

   		queryTokenizer: Bloodhound.tokenizers.whitespace,
   		datumTokenizer: Bloodhound.tokenizers.whitespace,
  		
  		remote : {
  			url : "<?php echo site_url('/Report/search_address/q');?>",
  			wildcard : 'q' 
  		}
	});

	$('#my_typeahead').typeahead(null,{
		limit : 5,
		displayKey : 'Address',
		source : address
	});





	$('#my_table').dataTable({

		'dom' : '<"top">rt<"bottom"p><"clear">', 

		'responsive' : true,
	
		'iDisplayLength' : 5,
	
		'columnDefs' : [
			{	
				targets: 0, className:'text-center'
			},

			{	
				targets: [1,2], className:'alert-success'
			}
		],

		ajax:{
			url:"<?php echo site_url('/Report/fetch_customers');?>",
			type:'POST',
			data : function(){  

				return {
				'name' : $('.selectpicker').selectpicker('val'),
				'date' : $('#mydate').val(),
				'address' : $('#my_typeahead').val()
			}
		}

		},
		columns : [     
			{ "mData": "id"}, 	
		    { "mData": "Name"},
		    { "mData": "Address" }
		]
	});

});
function filtertable()
{
	$('#my_table').dataTable().api().ajax.reload();
	return;
}

function fetchShops()
{
	$('#name_select').selectpicker();

	$.ajax(
	{
		url : '<?php echo site_url("Report/fetch_name")?>',
		type : 'post',
		dataType : 'json',
		error : function() {alert('An Error Occured.')},
		success : function(data)
		{
			$('#name_select').empty();
			$('#name_select').append('<option value = "">Select name</option>');
			if(!$.isEmptyObject(data))
			{
				$.each(data,function(index,object)
				{
					console.log(index + " : " + object.name);
					$('#name_select').append(new Option(object.name,object.id));
				});
			}

			$('#name_select').selectpicker('refresh');			
		}
	});
}

</script>
</body>
</html>