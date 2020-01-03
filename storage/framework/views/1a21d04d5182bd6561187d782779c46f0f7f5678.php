<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Full Text Search in Laravel 6 using Ajax</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">    
  			<br />
  			<h3 align="center">Affichage des notes</h3>
  			<br />
  			<div class="row">
  				<div class="col-md-10">
  					<input type="text" name="full_text_search" id="full_text_search" class="form-control" placeholder="Search" value="">
  				</div>
  				<div class="col-md-2">
  					<?php echo csrf_field(); ?>
  					<button type="button" name="search" id="search" class="btn btn-success">Search</button>
  				</div>
  			</div>
  			<br />
  			<div class="table-responsive">
				<table class="table table-bordered table-striped">
				    <thead>
					    <tr>
					      	<th>Nom du module</th>
					      	<th>NCC</th>
					      	<th>NCI</th>
	              			<th>NTP</th>
	              			<th>NCF</th>
	              			<th>Moy</th>
					    </tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
        </div>
	</body>
</html>


<script>
$(document).ready(function(){

	load_data('');

	function load_data(full_text_search_query = '')
	{
		var _token = $("input[name=_token]").val();
		$.ajax({
			url:"<?php echo e(route('full-text-search.action')); ?>",
			method:"POST",
			data:{full_text_search_query:full_text_search_query, _token:_token},
			dataType:"json",
			success:function(data)
			{
				var output = '';
				if(data.length > 0)
				{
					for(var count = 0; count < data.length; count++)
					{
						output += '<tr>';
						output += '<td>'+data[count].CustomerName+'</td>';
						output += '<td>'+data[count].Gender+'</td>';
						output += '<td>'+data[count].Address+'</td>';
						output += '<td>'+data[count].City+'</td>';
						output += '<td>'+data[count].PostalCode+'</td>';
						output += '<td>'+data[count].Country+'</td>';
						output += '</tr>';
					}
				}
				else
				{
					output += '<tr>';
					output += '<td colspan="6">No Data Found</td>';
					output += '</tr>';
				}
				$('tbody').html(output);
			}
		});
	}

	$('#search').click(function(){
		var full_text_search_query = $('#full_text_search').val();
		load_data(full_text_search_query);
	});

});
</script>

<?php /**PATH C:\xampp\htdocs\laravel-6\resources\views/full_text_search.blade.php ENDPATH**/ ?>