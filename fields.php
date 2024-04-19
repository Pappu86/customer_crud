<div class="col-lg-12">
	    <div class="w-100 my-2 d-flex">
	        <h4 class="col-auto flex-grow-1"><b>Dynamic Form Fields</b></h4>
	        <div class="col-auto">
	            <a href="javascript:void(0)" id="add_new" class="btn btn-sm btn-primary">Add New</a>
	        </div>
	    </div>
	    <table class="table table-striped table-hover">
	        <thead>
	            <tr class="bg-dark text-light">
	                <th class="py-1 px-2">#</th>
	                <th class="py-1 px-2">Field Label</th>
	                <th class="py-1 px-2">Field Name</th>
	                <th class="py-1 px-2">Type</th>
	                <th class="py-1 px-2">Action</th>
	            </tr>
	        </thead>
	        <tbody>
	            <?php 
	            $i = 1;
	            $fields = $conn->query("SELECT * FROM `form_fields` ");
	            while($row= $fields->fetch_assoc()):
	            ?>
	            <tr>
	                <td class="py-1 px-2 text-center"><?php echo $i++ ?></td>
	                <td class="py-1 px-2"><?php echo $row['field_label'] ?></td>
	                <td class="py-1 px-2"><?php echo $row['field_name'] ?></td>
	                <td class="py-1 px-2"><?php echo $row['type'] ?></td>
	                <td class="py-1 px-2">
						<a class="edit_data me-2" href="javascript:void(0)" data-field_name="<?php echo $row['field_name']  ?>"><i class="fa fa-edit"></i></a>
						<a class="delete_data me-2 text-danger" href="javascript:void(0)" data-field_name="<?php echo $row['field_name']  ?>"><i class="fa fa-trash"></i></a>
	                </td>
	            </tr>
	            <?php endwhile; ?>
	            <?php if($fields->num_rows <= 0): ?>
	                <tr>
	                    <th class="py-1 px-2 text-center" colspan='5'>No Data to Display</th>
	                </tr>
	            <?php endif; ?>
	        </tbody>
	    </table>
	</div>
	<script>
	    $(function(){
	        // Add New Data Form Modal
	        $('#add_new').click(function(){
	            uni_modal("Add New Field", "manage_field.php");
	        })
	        // Edit Data Form Modal
	        $('.edit_data').click(function(){
	            uni_modal("Edit Field", "manage_field.php?field_name="+$(this).attr('data-field_name'));
	        })
	        // Delete Data Form Modal
	        $('.delete_data').click(function(){
	            _conf("Are you sure to delete <b>"+$(this).attr('data-field_name')+"</b> field?", "delete_data",["'"+$(this).attr('data-field_name')+"'"]);
	        })
	    })
	    function delete_data($field_name){
	        $('#confirm_modal button').attr('disabled',true)
	        $.ajax({
	            url:'api.php?action=delete_field',
	            method:'POST',
	            data:{field_name:$field_name},
	            dataType:'JSON',
	            error:err=>{
	                console.log(err)
	                alert("An error occurred.")
	                $('#confirm_modal button').attr('disabled',false)
	            },
	            success:function(resp){
	                if(resp.status == 'success'){
	                    location.reload()
	                }else{
	                    alert("An error occurred.")
	                    $('#confirm_modal button').attr('disabled',false)
	                }
	            }
	        })
	    }
	</script>