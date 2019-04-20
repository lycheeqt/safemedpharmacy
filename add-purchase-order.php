<!DOCTYPE html>
<html lang="en">

<?php
    $connect = mysqli_connect('localhost', 'root', '', 'safemedpharmacy');
    session_start();

    if(!$_SESSION['username']) {
        header("Location: login.php");
    }
    else {
        $username = $_SESSION['username'];
        $name = $_SESSION['name'];
        $login_type = $_SESSION['login_type'];
    }

    $result = $_SESSION['result'];
?>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SafeMed Pharmacy - Add Purchase Order</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

 <link href="css/style.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include("sidebar.php"); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Time -->
          <span class="ml-2 d-none d-lg-inline text-gray-600 small">
            <div id="timestamp"></div>
          </span>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Welcome back <b><?php echo $username;?></b> (<?php echo $name;?>)</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add New Purchase Order</h1>
          </div>

          <form class="form" action="add-purchase-order-process.php" method="post">
            <div class="row">
              <div class="col-lg-6">
            <div class="card shadow mb-4">
              <div class="card-body">
                <div class="box-body">
                  <div class="form-group">
                    <label>SKU</label>
                    <input type="text" class="form-control" name="sku" value="<?php echo $result['SKU'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Brand Name</label>
                    <input type="text" class="form-control" name="brand_name" value="<?php echo $result['Brand Name'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Supplier</label>
                    <input type="text" class="form-control" name="supplier" value="<?php echo $result['Supplier'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Unit of Measurement</label>
                    <input type="text" class="form-control" name="uom" value="<?php echo $result['Uom'] ?>" readonly>
                  </div>                        
                  <div class="form-group">
                    <label>Defective Quantity</label>
                    <input type="text" class="form-control" name="defective_qty" value="">
                  </div>  
                  <div class="form-group">
                    <label>Unit Price</label>
                    <input type="text" class="form-control" name="unit_price" value="<?php echo $result['Unit Price'] ?>" readonly>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
            </div>
          </div>

          <!-- Border Bottom Utilities -->
          <div class="col-lg-6">
            <div class="card shadow mb-4">
              <div class="card-body">
                <div class="box-body">
                  <div class="form-group">
                    <label>Generic Name</label>
                    <input type="text" class="form-control" name="generic_name" value="<?php echo $result['Generic Name'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                    <input type="text" class="form-control" name="category" value="<?php echo $result['Category'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Order Quantity</label>
                    <input type="text" class="form-control" name="order_qty" value="">
                  </div>
                  <div class="form-group">
                    <label>Expiration Date</label>
                    <input type="text" class="form-control" name="expiration_date" value="<?php echo $result['Expiry Date'] ?>" readonly>
                  </div>  
                  <div class="form-group">
                    <label>Selling Price</label>
                    <input type="text" class="form-control" name="selling_price" value="<?php echo $result['Selling Price'] ?>" readonly>
                  </div>     
                </div>
              </div>
            </div>

            <input type= "hidden" name = "name" value ="<?php echo $name ?>"/>
            <div class="submit-footer">
              <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
              <a href="purchase-order.php" class="btn btn-primary">Cancel</a>
            </div>
          </div>

        </div>
      </form>

        </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; SafeMed Pharmacy 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
  $(document).ready(function() {
    setInterval(timestamp, 1000);
  });

  function timestamp() {
      $.ajax({
          url: 'timezone.php',
          success: function(data) {
              $('#timestamp').html(data);
          },
      });
  }
  </script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
