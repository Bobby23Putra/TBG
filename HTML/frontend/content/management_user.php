<?php
$base_url="http://".$_SERVER['SERVER_NAME'];
?>
<script>
	$(function()
    {	
		//click add new user button
		$("#addNewUser").click(function()
		{
			$("#myModalAddUser").modal('show');
		});
		
		//auto refresh for 5 minutes
		setInterval(function(){ updateTable(); }, 300000);
	  
		function updateTable()
		{
			$('#table-javascript').bootstrapTable('refresh');
		}
		
		//click save user
		$("#saveUser").click(function()
		{
			//validation form add new user
			$("#AddDataUser").validate(
			{
				rules:
				{
					username: { required: true },
					password: { required: true}
				},
				messages:
				{
					username: "username is required",
					password: "password is required"
				},
				tooltip_options:
				{
					username: { placement: 'bottom' },
					password: { placement: 'bottom' }
				}
			});
			
			var validation = $("#AddDataUser").valid();
			
			if (validation ===true)
			{
				var username = $("#add_username").val();
				var password = $("#add_password").val();
				//swal("save user");
				$.ajax({
					url	:"../../ajax/add_user.php?username="+username+"&password="+password,
					type:"POST",
					success:function(response)
					{
						if (response==1)
						{
							$("#myModalAddUser").modal('hide');
							//updateTable();
							
							swal(
							'Good job!',
							'User created',
							'success'
						  );
							
							$("#add_username").val("");
							$("#add_password").val("");
						}
						else
						{
							swal
							(
								'Oops...',
								'Something went wrong!',
								'error'
							);
						}
						
					}
				});
			}
		});
		
		//click update user
		$("#updateUser").click(function()
		{
			$("#EditDataUser").validate(
			{
				rules:
				{
					edit_password: { required: true}
				},
				messages:
				{
					edit_password: "password is required"
				},
				tooltip_options:
				{
					edit_password: { placement: 'bottom' }
				}
			});
			var validation = $("#EditDataUser").valid();
			
			if (validation ===true)
			{
				var id		 = $("#edit_id_user").val(); 
				var password = $("#edit_password").val();
				//swal("save user");
				$.ajax({
					url	:"../../ajax/update_user.php?id="+id+"&password="+password,
					type:"POST",
					success:function(response)
					{
						if (response==1)
						{
							$("#myModalEditUser").modal('hide');
							
							swal(
							'Good job!',
							'User updated',
							'success'
						  );
							
							updateTable();
							$("#edit_id_user").val(""); 
							$("#edit_password").val("");
						}
						else
						{
							swal
							(
								'Oops...',
								'Something went wrong!',
								'error'
							);
						}
						
					}
				});
			}
		});
	});
	
	window.operateEvents =
    {
        'click .like': function (e, value, row) {
            //alert('You click like action, row: ' + JSON.stringify(row));
			$("#edit_id_user").val(row.id);
			$("#edit_username").val(row.username);
			$('#myModalEditUser').modal('show');
        },
        'click .remove': function (e, value, row)
		{
            //alert('You click remove action, row: ' + JSON.stringify(row));
			swal({
				title: 'Are you sure?',
				text: "You want to  be able to revert this!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			  }).then(function ()
				{
					$.ajax(
					{
						url	:"../../ajax/delete_user.php?id="+row.id,
						type:"POST",
						success:function(response)
						{
							if (response==1)
							{
								$('#table-javascript').bootstrapTable('refresh');
								
								swal
								(
									'Deleted!',
									'Your file has been deleted.',
									'success'
								);
							}
						}
					});
				});
        }
    };
					
    function operateFormatter(value, row, index)
    {
        return [
            '<span class="like pull-left">',
              '<a href="javascript:void" data-toggle="tooltip" title="edit"><i class="fa fa-pencil-square-o fa-" aria-hidden="true" style="color:black;"></i></a>',
            '</span>',
			'<span class="pull-left">',
              '&nbsp;&nbsp;&nbsp;',
            '</span>',
			'<span class="remove pull-left">',
              '<a href="javascript:void" data-toggle="tooltip" title="delete"><i class="fa fa-trash" aria-hidden="true" style="color:black;"></i></a>',
            '</span>'
        ].join('');
    }
</script>
<style>
	.fixed-table-container tbody td .th-inner, .fixed-table-container thead th .th-inner
	{
		background-color: #1e88e5;
		color: #ffffff;
	}
</style>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Dashboard <small>Management User</small>
        </h1>
        <ol class="breadcrumb">
            <li>
               <a href="main.php?page_id=dashboard&pack_id=all">
					<i class="fa fa-dashboard"></i> Dashboard
			   </a>
            </li>
			<li class="active">Management User</li>
        </ol>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
		
		<button type="button" class="btn btn-info" aria-label="Left Align" id="addNewUser">
			<i class="fa fa-plus-square" aria-hidden="true"></i> &nbsp; Add New User
		</button>

        <table id="table-javascript"
			data-url="<?php echo $base_url.'/ajax/user.php';?>"
			data-toolbar="#toolbar"
			data-search="true"
			data-pagination="true"
			data-id-field="id"
			data-page-list="[10, 25, 50, 100, ALL]"
			data-toggle="table"
			data-formatter="operateFormatter"
            data-events="operateEvents"
			data-height="530"
		>
            <thead>
            <tr>
                <th data-field="no">No</th>
                <th data-field="username">Username</th>
				<th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents">Action</th>
            </tr>
            </thead>
        </table>
    </div>
</div>

<!--MODAL ADD USER-->
<div class="modal fade" id="myModalAddUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <form id="AddDataUser" method="POST">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Data User</h4>
      </div>
      <div class="modal-body">
	  <!-- <div style="color:red;text-align:left;font-weight:bold;vertical-align: text-top;">*) Indicates a required field.</div>-->
		<table class="table">
					<tr>
						<td>
							Username <!--<span style="color:red;font-weight:bold;"> *</span>-->
						</td>
						<td>
							:
						</td>
						<td>
							<input type="text" name="username" id="add_username" class="form-control" required>
						</td>
					</tr>
					<tr>
						<td>
							Password <!--<span style="color:red;font-weight:bold;"> *</span>-->
						</td>
						<td>
							:
						</td>
						<td>
							<input type="password" name="password" id="add_password" class="form-control" required>
						</td>
					</tr>
				</table>
			
      </div>
      <div class="modal-footer">
		<input type="submit" class="btn btn-info" id="saveUser" value="Save">
      </div>
    </div>
  </div>
 </form>
</div>

<!--MODAL EDIT USER-->
<div class="modal fade" id="myModalEditUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <form id="EditDataUser" method="POST">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Data User</h4>
      </div>
      <div class="modal-body">
	   <div style="color:red;text-align:left;font-weight:bold;vertical-align: text-top;">*) Indicates a required field.</div>
		<table class="table">
					<input type="hidden" name="edit_id_user" id="edit_id_user" class="form-control">
					<tr>
						<td>
							Username
						</td>
						<td>
							:
						</td>
						<td>
							<input type="text" name="edit_username" id="edit_username" class="form-control" readonly>
						</td>
					</tr>
					<tr>
						<td>
							Password<span style="color:red;font-weight:bold;"> *</span>
						</td>
						<td>
							:
						</td>
						<td>
							<input type="password" name="edit_password" id="edit_password" class="form-control" placeholder="new password for update">
						</td>
					</tr>
				</table>
			
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-info" id="updateUser" value="Update">
      </div>
    </div>
  </div>
 </form>
</div>
