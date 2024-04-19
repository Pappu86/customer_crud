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
 
	<div class="container-fuid">
	    <div class="col-12">
	        <div class="row gy-2 gx-5 row-cols-1 row-cols-sm-1 row-cols-xl-2 row-cols-md-2">
	            <div class="col">
	                <div class="text-muted">Customer Name:</div>
	                <div class="lh-1 fs-6"><?php echo $name; ?></div>
	            </div>
	            <div class="col">
	                <div class="text-muted">Customer email:</div>
	                <div class="lh-1 fs-6"><?php echo $email; ?></div>
	            </div>
	            <?php if(isset($fields)): ?>
	            <?php foreach($fields as $field): ?>
	            <div class="col">
	                <div class="text-muted"><?php echo $field['field_label'] ?>:</div>
	                <p class="lh-1 fs-6"><?php echo isset($meta[$field['field_name']]) ? $meta[$field['field_name']] : '' ?></p>
	            </div>
	            <?php endforeach; ?>
	            <?php endif; ?>
	        </div>
	    </div>
	</div>
 
	<div class="row justify-content-end mx-0 my-2">
	    <div class="col-auto">
	        <button class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
	    </div>
	</div>