<div class="col-md-12" id="">
	    <div class="w-100 my-2 d-flex">
	        <h4 class="col-auto flex-grow-1"><b>Customer List</b></h4>
	        <div class="col-auto">
	            <a href="./?page=manage_customer" class="btn btn-sm btn-primary">Add New</a>
	        </div>
	    </div>
	    <hr>
	    <div class="col-12">
	    <table class="table table-striped table-hover">
	        <thead>
	            <tr class="bg-dark text-light">
	                <th class="py-1 px-2">#</th>
	                <th class="py-1 px-2">Customer Name</th>
					<th class="py-1 px-2">Email</th>
	                <th class="py-1 px-2">Created At</th>
	                <th class="py-1 px-2">Updated At</th>
	                <th class="py-1 px-2">Action</th>
	            </tr>
	        </thead>
	        <tbody>
	            <?php 
	            $i = 1;
	            $customers = $conn->query("SELECT * FROM `customers` order by 'name' asc ");
	            while($row= $customers->fetch_assoc()):
	            ?>
	            <tr>
	                <td class="py-1 px-2 text-center"><?php echo $i++ ?></td>
	                <td class="py-1 px-2"><?php echo $row['name'] ?></td>
	                <td class="py-1 px-2"><?php echo $row['email'] ?></td>
					<td  class="py-1 px-2"><?php echo date("Y-m-d H:i",strtotime($row['created_at'])) ?></td>
	                <td class="py-1 px-2"><?php echo ($row['updated_at'] != null || !empty($row['updated_at'])) ? date('Y-m-d H:i',strtotime($row['updated_at'])) : "N/A" ?></td>
	                <td class="py-1 px-2">					
						<a class="view_data me-2" href="javascript:void(0)" data-id="<?php echo $row['id']  ?>"><i class="fa fa-eye"></i></a>
	                    <a class="me-2" href=".?page=manage_customer&id=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></a>
	                    <a class="delete_data text-danger" href="javascript:void(0)" data-id="<?php echo $row['id']  ?>" data-name="<?php echo $row['email']." - ".$row['name']  ?>">
							<i class="fa fa-trash"></i>
						</a>
	                </td>
	            </tr>
	            <?php endwhile; ?>
	            <?php if($customers->num_rows <= 0): ?>
	                <tr>
	                    <th class="py-1 px-2 text-center" colspan='6'>No Data to Display</th>
	                </tr>
	            <?php endif; ?>
	        </tbody>
	    </table>
	    </div>
	</div>
	<script>
	    $(function(){
	        // View Student Details Form Modal
	        $('.view_data').click(function(){
	            uni_modal('Customer Details','view_customer.php?id='+$(this).attr('data-id'),"large")
	        })
 
	        // Delete Student Form Modal
	        $('.delete_data').click(function(){
	            _conf("Are you sure to delete <b>"+$(this).attr('data-name')+"</b>?", "delete_data",["'"+$(this).attr('data-id')+"'"]);
	        })
	    })
	    function delete_data($id){
	        $('#confirm_modal button').attr('disabled',true)
	        $.ajax({
	            url:'api.php?action=delete_customer',
	            method:'POST',
	            data:{id:$id},
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