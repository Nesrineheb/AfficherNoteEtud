<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>How to Delete or Remove Data From Mysql in Laravel 6 using Ajax</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">    
  			<br />
  			<h3 align="center">Remplire les notes des etudiants</h3>
  			<br />
  			<div align="right">
  				<button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Ajouter</button>
  			</div>
  			<br />
			  <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="filter_gender" id="filter_gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="filter_country" id="filter_country" class="form-control" required>
                            <option value="">Select Country</option>
                            <?php $__currentLoopData = $country_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option value="<?php echo e($country->Country); ?>"><?php echo e($country->Country); ?></option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    
                    <div class="form-group" align="center">
                        <button type="button" name="filter" id="filter" class="btn btn-info">Filter</button>

                        <button type="button" name="reset" id="reset" class="btn btn-default">Reset</button>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <br />
			<div class="table-responsive">
				<table id="user_table" class="table table-bordered table-striped">
					<thead>
						<tr>
						    <th width="24%">ID</th>
							<th width="23%">First Name</th>
				            <th width="23%">Last Name</th>
				            <th width="30%">Action</th>
						</tr>
					</thead>
				</table>
			</div>
			<br />
			<br />
		</div>
	</body>
</html>

<div id="formModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Ajouter</h4>
      		</div>
      		<div class="modal-body">
      			<span id="form_result"></span>
      			<form method="post" id="sample_form" class="form-horizontal">
      				<?php echo csrf_field(); ?>
      				<div class="form-group">
        				<label class="control-label col-md-4" >First Name : </label>
        				<div class="col-md-8">
        					<input type="text" name="first_name" id="first_name" class="form-control" />
        				</div>
        			</div>
        			<div class="form-group">
        				<label class="control-label col-md-4">Last Name : </label>
        				<div class="col-md-8">
        					<input type="text" name="last_name" id="last_name" class="form-control" />
        				</div>
        			</div>
              		<br />
              		<div class="form-group" align="center">
              			<input type="hidden" name="action" id="action" value="Add" />
              			<input type="hidden" name="hidden_id" id="hidden_id" />
              			<input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
              		</div>
      			</form>
      		</div>
    	</div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmer</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">voulez vous vraiment supprimer cette note?</h4>
            </div>
            <div class="modal-footer">
            	<button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function(){

	$('#sample_datas').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			url: "<?php echo e(route('sample.index')); ?>",
		},
		columns: [
			{
				data: 'first_name',
				name: 'first_name'
			},
			{
				data: 'last_name',
				name: 'last_name'
			},
			{
				data: 'id',
				name: 'ID'
			},
			{
				data: 'action',
				name: 'action',
				orderable: false
			}
		]
	});

	$('#create_record').click(function(){
		$('.modal-title').text('Add New Record');
		$('#action_button').val('Add');
		$('#action').val('Add');
		$('#form_result').html('');

		$('#formModal').modal('show');
	});

	$('#sample_form').on('submit', function(event){
		event.preventDefault();
		var action_url = '';

		if($('#action').val() == 'Add')
		{
			action_url = "<?php echo e(route('sample.store')); ?>";
		}

		if($('#action').val() == 'Edit')
		{
			action_url = "<?php echo e(route('sample.update')); ?>";
		}

		$.ajax({
			url: action_url,
			method:"POST",
			data:$(this).serialize(),
			dataType:"json",
			success:function(data)
			{
				var html = '';
				if(data.errors)
				{
					html = '<div class="alert alert-danger">';
					for(var count = 0; count < data.errors.length; count++)
					{
						html += '<p>' + data.errors[count] + '</p>';
					}
					html += '</div>';
				}
				if(data.success)
				{
					html = '<div class="alert alert-success">' + data.success + '</div>';
					$('#sample_form')[0].reset();
					$('#sample_datas').DataTable().ajax.reload();
				}
				$('#form_result').html(html);
			}
		});
	});

	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		$('#form_result').html('');
		$.ajax({
			url :"/sample/"+id+"/edit",
			dataType:"json",
			success:function(data)
			{
				$('#first_name').val(data.result.first_name);
				$('#last_name').val(data.result.last_name);
				$('#hidden_id').val(data.result.id);
				$('.modal-title').text('Edit Record');
				$('#action_button').val('Edit');
				$('#action').val('Edit');
				$('#formModal').modal('show');
			}
		})
	});

	var user_id;

	$(document).on('click', '.delete', function(){
		user_id = $(this).attr('id');
		$('#confirmModal').modal('show');
	});

	$('#ok_button').click(function(){
		$.ajax({
			url:"sample/destroy/"+user_id,
			beforeSend:function(){
				$('#ok_button').text('Deleting...');
			},
			success:function(data)
			{
				setTimeout(function(){
					$('#confirmModal').modal('hide');
					$('#user_table').DataTable().ajax.reload();
					alert('Data Deleted');
				}, 2000);
			}
		})
	});

});
</script>

<?php /**PATH C:\xampp\htdocs\laravel-6\resources\views/sample_data.blade.php ENDPATH**/ ?>