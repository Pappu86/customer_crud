<?php 
	require_once('connection.php');
	if(isset($_GET['id'])){
	    $qry= $conn->query("SELECT * FROM customers where id = '{$_GET['id']}' ");
	    foreach($qry->fetch_array() as $k => $v){
	        $$k = $v;
	    }
	    if(isset($id)){
	        $qry2 = $conn->query("SELECT * from customer_meta where customer_id = '{$id}'");
	        while($row = $qry2->fetch_assoc()){
	            $meta[$row['meta_field']] = $row['meta_value'];
	        }
	    }
	}
	$fdata = $conn->query("SELECT * FROM form_fields");
	while($row = $fdata->fetch_assoc()){
	    $fields[] = $row;
	}
	?>
	<div class="container-fluid">
 
	    <form action="" id="customer-form">
	        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
	        <div class="col-md-12">
	            <div class="row gy-2 gx-5 row-cols-1 row-cols-sm-1 row-cols-xl-2 row-cols-md-2">
	                <div class="col">
	                    <div class="form-group">
	                        <label for="customerName" class="control-label">Name</label>
	                        <input type="text" id="customerName" name="name" class="form-control form-control-sm rounded-0" value="<?php echo isset($name) ? $name : '' ?>" required>
	                    </div>
	                </div> 
					<div class="col">
	                    <div class="form-group">
	                        <label for="customerEmail" class="control-label">Email</label>
	                        <input type="email" id="customerEmail" name="email" class="form-control form-control-sm rounded-0" value="<?php echo isset($email) ? $email : '' ?>" required>
	                    </div>
	                </div> 
	                <?php if(isset($fields)): ?>
	                <?php foreach($fields as $field): ?>
	                    <div class="col">
	                        <div class="form-group">
	                            <label for="<?php echo $field['field_name'] ?>" class="control-label"><?php echo $field['field_label'] ?></label>
	                            <?php if($field['type'] == 'text'): ?>
	                                <input type="text" id="<?php echo $field['field_name'] ?>" name="<?php echo $field['field_name'] ?>" class="form-control form-control-sm rounded-0" value="<?php echo isset($meta[$field['field_name']]) ? $meta[$field['field_name']] : '' ?>" required>
	                            <?php elseif($field['type'] == 'number'): ?>
	                                <input type="number" id="<?php echo $field['field_name'] ?>" name="<?php echo $field['field_name'] ?>" class="form-control form-control-sm rounded-0" value="<?php echo isset($meta[$field['field_name']]) ? $meta[$field['field_name']] : '' ?>" required>
	                            <?php else: ?>
	                                <textarea rows="1" id="<?php echo $field['field_name'] ?>" name="<?php echo $field['field_name'] ?>" class="form-control form-control-sm"><?php echo isset($meta[$field['field_name']]) ? $meta[$field['field_name']] : '' ?></textarea>
	                            <?php endif; ?>
	                        </div>
	                    </div>
	                <?php endforeach; ?>
	                <?php endif; ?>
	            </div>
	        </div>
	        <div class="col-12 py-4">
	            <div class="w-100 d-flex justify-content-center">
	                    <button class="btn btn-sm btn-primary me-2">Save</button>
	                    <a href="./" class="btn btn-sm btn-secondary">Back</a>
	            </div>
	        </div>
	    </form>
 
	</div>
	<script>
	    $(function(){
	        $('#customer-form').submit(function(e){
	            e.preventDefault()
	            var _this = $(this)
	            _this.find('button').attr('disabled',true)
	            $('.pop_msg').remove()
	            $.ajax({
	                url:'api.php?action=save_customer',
	                method:'POST',
	                data:_this.serialize(),
	                dataType:'json',
	                error:err=>{
	                    console.log(err)
	                    alert('an error occured')
	                    _this.find('button').attr('disabled',false)
	                },
	                success:function(resp){
	                    if(resp.status == 'success'){
	                        location.replace('./')
	                    }else if(resp.status == 'failed' && !!resp.msg){
	                        var el = $('<div>')
	                            el.addClass('pop_msg alert alert-danger')
	                            .css('display','none')
	                            .text(resp.msg)
	                            _this.prepend(el)
	                            el.show('slow')
	                    }else{
	                        console.log(resp)
	                        alert('an error occured')
	                    }
	                    _this.find('button').attr('disabled',false)
	                }
	            })
	        })
	    })
	</script>