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
			<h1>User Report</h2>
		</div>
	</div>

	<div class="well">
		<div class="row">
			<div class="col-sm-12">
				<form class="form-inline">
					<div class="form-group col-sm-offset-1">
						<div class="form-group selectpicker" data-live-search='true'>
							<label class = "col-sm-4 control-label">Shop ID</label>
							<div class="col-sm-8">
								<select id = "name_select" class = "form-control selectpicker">
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
									<th>Username</th>
									<th>Age</th>
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

$(document).ready(function() //Use this code before starting to type a java script code
{

//Start Datepicker/selectpicker

	//we are creating a class in the above select called selectpicker and we call that class using a '.' 
	//and we are assing a function to that class called selectpicker()... then it looks gud and we can customize as well
	$('.selectpicker').selectpicker(); //we are calling the selectpicker() from JS file that we linked

	$('.selectpicker').selectpicker('val', 2); 
	//setting a value by default.. that means in the above select that value number 2 is banana.. but normally we hve apple on top but since we used this code the banana wll be in top

	$('.date').datepicker(
		{
			format : 'yyyy-mm-dd'
			//multidate: true  //can select diff date in one slect picker
		});

//End Datepicker/selectpicker

//Start TypeAhead

	//var age = [15,16,17,22,23,20,21,31,32];

	//by refering to the bloodhound class we are creating an obj called ages
	//we access the bloodhound by linking the bloodhound js file
	var ages = new Bloodhound({

	//	local: age, //since we dnt use local array so we need to use remote attribute to take data from DB
   		
   		//
   		queryTokenizer: Bloodhound.tokenizers.whitespace,
   		datumTokenizer: Bloodhound.tokenizers.whitespace,
  		
  		remote : {
  			url : "<?php echo site_url('/Report/search_age/q');?>",
  			//wildcard will replace 'q' in the above url by wht ever the value that user type in text. Using this it can sort value in the db
  			wildcard : 'q' 
  		}
	});

	$('#my_typeahead').typeahead(null,{
		limit : 10,
		displayKey : 'Age',
		source : ages
	});
//EndTypeAhead

//Start TableDate

	$('#my_table').dataTable({

		// t = table
		// p = pagination // (prev - next) which is used to navigation the page
		// r = process (shows as loading when we fetching from DB) we need to show msg in middle that why we put inbtwn top and botton   

		//in below we are saying that inbtwn top and botton we need the table and at buttom of the table we need the pagination
		
		//we are clearing all other stuff that we dnt need
		
		'dom' : '<"top">rt<"bottom"p><"clear">', 

		'responsive' : true,
	
		'iDisplayLength' : 5,
	
		'columnDefs' : [
			{	
				targets: 0, className:'text-center'
			},

			{	
				targets: [1,2,3], className:'alert-success'
			}
		],

		ajax:{
			url:"<?php echo site_url('/Report/fetch_users');?>",
			type:'POST',
			data : function(){  //at the initial stage when page loads then it takes the values from the text.. until end it holds that data only// so when we sort then we need to pass new values so if we use function then the code says to reload the funtion agaaain

				return {
				'name' : $('.selectpicker').selectpicker('val'),
				'date' : $('#mydate').val(),
				'age' : $('#my_typeahead').val()
			}
		}

		},
		columns : [      	
			{ "mData": "Id" },
		    { "mData": "Name"},
		    { "mData": "Age" },
		    { "mData": "Address" }
		]
	});

//End TableDate
});

function filtertable()
{
	$('#my_table').dataTable().api().ajax.reload();
	return;
}



</script>
</body>
</html>