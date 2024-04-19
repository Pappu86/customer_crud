<?php 
	session_start();
	require_once('connection.php');
	$action = isset($_GET['action']) ? $_GET['action'] : '';
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
	    // Extracting Post data to varialbles
	    extract($_POST);
	}
	if(empty($action)){
	    $resp['status'] ='failed';
	    $resp['msg'] = 'Unknown Action';
	}
	elseif($action == 'save_field'){
	    $data = "";
	    $check = $conn->query("SELECT * FROM `form_fields` where field_name = '{$field_name}' ".(!empty($o_field_name)? " and field_name != '{$o_field_name}'" : '' ))->num_rows;
	    if($check > 0){
	        $resp['status'] ='failed';
	        $resp['msg'] ='Field Name Already Exists.';
	    }else{
	        if(empty($o_field_name)){
	            $sql = "INSERT INTO `form_fields` (field_label,field_name,`type`) VALUES ('{$field_label}','{$field_name}','{$type}')";
	        }else{
	            $sql = "UPDATE `form_fields` set `field_label` = '{$field_label}', `field_name` = '{$field_name}', `type` = '{$type}' where `field_name` = '{$o_field_name}'";
	            $sql2 = "UPDATE `customer_meta` set `meta_field` = '{$field_name}' where `meta_field` = '{$o_field_name}'";
	        }
	        $save = $conn->query($sql);
	        if(isset($sql2))
	            $conn->query($sql2);
	        if($save){
	            $resp['status'] = 'success';
	            $_SESSION['flashdata']['type'] = 'success';
	            $_SESSION['flashdata']['msg'] = 'Field Successfuly Saved';
	        }else{
	            $resp['status'] = 'failed';
	            $resp['msg'] = 'Failed to saved data. Error: '.$conn->error;
	        }
	    }
	}
	elseif($action == 'delete_field'){
	    $delete = $conn->query("DELETE FROM `form_fields` where field_name = '{$field_name}'");
	    if($delete){
	        $resp['status'] = 'success';
	        $_SESSION['flashdata']['type'] = 'success';
	        $_SESSION['flashdata']['msg'] = 'Data Field successfully deleted.';
	    }else{
	        $resp['status'] = 'failed';
	        $resp['msg'] = 'Error: '.$conn->error;
	    }
	}
	elseif($action == 'save_customer'){
	    // static data
	    $static = array('id','name','email');
	    $data = "";
 
	    $check = $conn->query("SELECT * FROM `customers` where email = '{$email}' ".(!empty($id)? " and id != '{$id}'" : '' ))->num_rows;
	    if($check > 0){
	        $resp['status'] ='failed';
	        $resp['msg'] ='Customer Email Already Exists.';
	    }else{
	    // dynamically set data to insert or update
	        foreach($_POST as $k =>$v){
	            if(!in_array($k,$static) || $k =='id')
	            continue;
	            $v= $conn->real_escape_string($v);
	            if(!empty($data)) $data .=", ";
	            $data .= " `$k` = '{$v}' ";
	        }
	        if(empty($id)){
	            $sql = "INSERT INTO `customers` set {$data}";
	        }else{
	            $sql = "UPDATE `customers` set {$data} where id = '{$id}'";
	        }
	        $save = $conn->query($sql);
	        if($save){
	            $customer_id = empty($id) ? $conn->insert_id : $id;
	            $data = "";
	            $resp['status'] ='success';
	            $_SESSION['flashdata']['type'] = 'success';
	            $_SESSION['flashdata']['msg'] = 'Customer Data Successfuly Saved';
 
	            // setting the dynamic data for insertion
	            foreach($_POST as $k =>$v){
	                if(in_array($k,$static))
	                continue;
	                $v= $conn->real_escape_string($v);
	                if(!empty($data)) $data .=", ";
	                $data .= " ('{$customer_id}','{$k}', '{$v}' )";
	            }
	            if(!empty($data)){
	                // Deleting the old dynamic data 
	                $conn->query("DELETE FROM customer_meta where customer_id = '{$customer_id}'");
	                // Inserting Updated dynamic Data
	                $conn->query("INSERT INTO customer_meta (`customer_id`,`meta_field`,`meta_value`) VALUES {$data} ");
	            }
 
	        }else{
	            $resp['status'] = 'failed';
	            $resp['msg'] = 'Failed to saved data. Error: '.$conn->error;
	        }
	    }
	}
	elseif($action == 'delete_customer'){
	    $delete = $conn->query("DELETE FROM `customers` where id = '{$id}'");
	    if($delete){
	        $resp['status'] = 'success';
	        $_SESSION['flashdata']['type'] = 'success';
	        $_SESSION['flashdata']['msg'] = 'Customer successfully deleted.';
	    }else{
	        $resp['status'] = 'failed';
	        $resp['msg'] = 'Error: '.$conn->error;
	    }
	}
	echo json_encode($resp);