<?php 
	require_once('connection.php');
	if(isset($_GET['field_name'])){
	    $qry= $conn->query("SELECT * FROM form_fields where field_name = '{$_GET['field_name']}' ");
	    foreach($qry->fetch_array() as $k => $v){
	        $$k = $v;
	    }
	}
	?>
	<div class="container-fluid">
	    <form action="" id="field-form">
	        <input type="hidden" name="o_field_name" value="<?php echo isset($field_name)? $field_name : "" ?>">
	        <div class="form-group mb-3">
	            <label for="field_label" class="control-label">Label</label>
	            <input type="text" id="field_label" name="field_label" class="form-control form-control-sm rounded-0" value="<?php echo isset($field_label) ? $field_label : '' ?>" required>
	        </div>
	        <div class="form-group mb-3">
	            <label for="field_name" class="control-label">Field Name</label>
	            <input type="text" id="field_name" name="field_name" class="form-control form-control-sm rounded-0" pattern="[a-z0-9A-Z_]+" value="<?php echo isset($field_name) ? $field_name : '' ?>" required>
	            <small class="text-secondary">(Accepted Characters: A-Z, a-z, '_' )</small>
	        </div>
	        <div class="form-group mb-3">
	            <label for="type" class="control-label">Field Type</label>
	            <select name="type" id="type" class="form-select form-select-sm rounded">
	                <option <?php echo isset($type) && $type == 'text' ? 'selected' : '' ?> value="text">Text</option>
	                <option <?php echo isset($type) && $type == 'long_text' ? 'selected' : '' ?> value="long_text">Long Text</option>
	                <option <?php echo isset($type) && $type == 'number' ? 'selected' : '' ?> value="number">Number</option>
	            </select>
	        </div>
	    </form>
	</div>
	<div class="row justify-content-end mx-0 my-4">
	    <div class="col-auto">
	        <button class="btn btn-sm btn-primary me-2" form="field-form">Save</button>
	        <button class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
	    </div>
	</div>
	<script>
	    $(function(){
	        $('#field-form').submit(function(e){
	            e.preventDefault()
	            var _this = $(this)
	            _this.find('button').attr('disabled',true)
	            $('.pop_msg').remove()
	            $.ajax({
	                url:'api.php?action=save_field',
	                method:'POST',
	                data:_this.serialize(),
	                dataType:'json',
	                error:err=>{
	                    console.log(err)
	                    alert('an error occured test')
	                    _this.find('button').attr('disabled',false)
	                },
	                success:function(resp){
						console.log("pappu test");
	                    if(resp.status == 'success'){
	                        location.reload()
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