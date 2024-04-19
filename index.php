<?php 
	session_start();
	require_once('connection.php');
	$page = isset($_GET['page']) ? $_GET['page'] : 'customer';
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	    <meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>Customers</title>
	    <link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/fontawesome.min.css">
	    <script src="./js/jquery-3.6.0.min.js"></script>
	    <script src="./js/popper.min.js"></script>
	    <script src="./js/bootstrap.min.js"></script>
	    <script src="./js/script.js"></script>
	    <style>
	        .modal-dialog.large {
	            width: 80% !important;
	            max-width: unset;
	        }
	        .modal-dialog.mid-large {
	            width: 50% !important;
	            max-width: unset;
	        }
	        @media (max-width:720px){
 
	            .modal-dialog.large {
	                width: 100% !important;
	                max-width: unset;
	            }
	            .modal-dialog.mid-large {
	                width: 100% !important;
	                max-width: unset;
	            }  
 
	        }
	    </style>
	</head>
	<body class="bg-light">
	    <main>
	    <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient" id="topNavBar">
	        <div class="container">
	            <a class="navbar-brand" href="./">
	               Md. Pappu Miahn
	            </a>
	            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	            <span class="navbar-toggler-icon"></span>
	            </button>
	            <div class="collapse navbar-collapse" id="navbarNav">
	                <ul class="navbar-nav">
	                    <li class="nav-item">
	                        <a class="nav-link <?php echo ($page == 'customer')? 'active' : '' ?>" aria-current="page" href="./">Customer List</a>
	                    </li>
	                    <li class="nav-item">
	                        <a class="nav-link <?php echo ($page == 'fields')? 'active' : '' ?>" aria-current="page" href="./?page=fields">Fields</a>
	                    </li>
	                </ul>
	            </div>
	        </div>
	    </nav>
	    <div class="container py-5 mb-4">	        
	        <?php 
	            if(isset($_SESSION['flashdata'])):
	        ?>
	        <div class="alert alert-<?php echo $_SESSION['flashdata']['type'] ?>">
	        <div class="w-100 d-flex">
	            <p class="col-auto flex-grow-1 m-0"><?php echo $_SESSION['flashdata']['msg'] ?></p>
	            <div class="col-auto">
	                <button class="btn-close" onclick="$(this).closest('.alert').remove()"></button>
	            </div>
	        </div>
	        </div>
	        <?php 
	            unset($_SESSION['flashdata']);
	            endif;
	        ?>
	        <?php include($page.'.php') ?>
	    </div>
	    </main>
	    <!-- Universal Modal -->
	    <div class="modal fade" id="uni_modal" role='dialog' data-bs-backdrop="static" data-bs-keyboard="true">
	        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
	            <div class="modal-content">
	                <div class="modal-header py-2">
	                    <h5 class="modal-title"></h5>
	                </div>
	                <div class="modal-body pb-0 mb-0">
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- Universal Modal End -->
 
	    <!-- Confirmation Modal -->
	    <div class="modal fade" id="confirm_modal" role='dialog'>
	        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
	        <div class="modal-content rounded-0">
	            <div class="modal-header py-2">
	            <h5 class="modal-title">Confirmation</h5>
	        </div>
	        <div class="modal-body">
	            <div id="delete_content"></div>
	        </div>
	        <div class="modal-footer py-1">
	            <button type="button" class="btn btn-primary btn-sm" id='confirm' onclick="">Continue</button>
	            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
	        </div>
	        </div>
	        </div>
	    </div>
	    <!-- Confirmation Modal End -->
 
	</body>
	</html>