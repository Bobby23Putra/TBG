<script>
	$(function()
	{
		$.ajax(
		{
			url	:"../../ajax/update_password.php",
			type:"POST",
			success:function(response)
			{
			    var jsonObject = $.parseJSON(response);
			    $("#edit_id_user").val(jsonObject.data[0].id);
			    $("#edit_username").val(jsonObject.data[0].username);
			}
		});
	
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
							swal(
							'Good job!',
							'Password has been changed',
							'success'
						  );
							
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
   
</script>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Dashboard <small>Change Password</small>
        </h1>
        <ol class="breadcrumb">
            <li>
               <a href="main.php?page_id=dashboard&pack_id=all">
					<i class="fa fa-dashboard"></i> Dashboard
			   </a>
            </li>
			<li class="active">Change Password</li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
		<form id="EditDataUser" method="POST">
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
		</form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 text-center">
        <input type="submit" class="btn btn-info" id="updateUser" value="Update">
    </div>
</div>
