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
?>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SafeMed Pharmacy - Expired</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <link href="css/style-3.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3"><img src="logo_transparent.png" width='260' /></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Nav Item - Items Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-list"></i>
          <span>Items</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="inventory.php">Inventory</a>
            <a class="collapse-item" href="categories.php">Categories</a>
            <a class="collapse-item" href="suppliers.php">Suppliers</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Stock Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link active" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-cube"></i>
          <span>Stock</span>
        </a>
        <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="near-expiry.php">Near Expiry</a>
            <a class="collapse-item active" href="expired.php">Expired</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Purchases Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesPurchases" aria-expanded="true" aria-controls="collapsePagesPurchases">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>Purchases</span>
        </a>
        <div id="collapsePagesPurchases" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="purchase-order.php">Purchase Order</a>
            <a class="collapse-item" href="purchase-invoice.php">Purchase Invoice</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Sales Invoice Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="pos.php">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Point of Sales</span></a>
      </li>

<?php 
        if($login_type != "Super Admin" and $login_type != "Admin") {
          echo "<style>#cpanel { display: none; }</style>";
        }
?>

<!-- Nav Item - Control Panel Collapse Menu -->
      <li class="nav-item" id="cpanel">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesControlPanel" aria-expanded="true" aria-controls="collapsePagesControlPanel">
          <i class="fas fa-fw fa fa-cog"></i>
          <span>Control Panel</span>
        </a>
        <div id="collapsePagesControlPanel" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="user-account.php">Users</a>
            <?php 
                    if($login_type == "Super Admin") {
                      echo '<a class="collapse-item" href="log-management.php">Log Management</a>
                            <a class="collapse-item" href="archive.php">Archive</a>
                            <a class="collapse-item" href="backup.php">Backup Database</a>';
                    }
            ?>
          </div>
        </div>
      </li>

    </ul>
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
            <h1 class="h3 mb-0 text-gray-800">Expired</h1>
            <div class="action-buttons"> </div>
          </div>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List of Expired Items</h6>
            </div>
            <div class="card-body">

                <div class="mb-2">
                  <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                      <span style="font-size: 0.80rem;">All expired products in the inventory are displayed in this section.</span>
                    </div>
                  </div>
                </div>

              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="20%">Brand Name</th>
                      <th width="20%">Generic Name</th>
                      <th width="20%">Stock On Hand</th>
                      <th width="20%">Purchased On</th>
                      <th width="20%">Expiry Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php    
                      $query = "SELECT * FROM `dim_inventory` WHERE `expiration_date` < CURDATE() AND (`order_qty` - `defective_qty`) >= 1";

                      $result_set =  mysqli_query($connect, $query);
                      if(mysqli_num_rows($result_set) == 0) echo "<table><tbody><tr><p class='no-record'><center>No record can be found.</center></p></tr></tbody></table>
                                <style>tbody { display: none; } table.table-bordered.dataTable th:first-child { border-left-width: 1px; } table.table-bordered.dataTable th:last-child { border-right-width: 1px; } </style>";

                      while($row = mysqli_fetch_array($result_set)) {
                        $no_of_defective_qty = $row['defective_qty'];
                        $no_of_order_qty = $row['order_qty'];
                        $stock_on_hand = $no_of_order_qty - $no_of_defective_qty;
                      ?>
                      <td><?php echo $row['brand_name']; ?></td>
                      <td><?php echo $row['generic_name']; ?></td>
                      <td><?php echo $stock_on_hand; ?></td>
                      <td><?php echo $row['date_added']; ?></td>  
                      <td><?php echo $row['expiration_date']; ?></td>                     
                    </tr><?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

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

  <script type="text/javascript" src="vendor/datatables/dataTables.buttons.min.js"></script> 
  <script type="text/javascript" src="vendor/datatables/jszip.min.js"></script>
  <script type="text/javascript" src="vendor/datatables/buttons.html5.min.js"></script>
  <script type="text/javascript" src="vendor/datatables/pdfmake.min.js"></script>
  <script type="text/javascript" src="vendor/datatables/vfs_fonts.js"></script>

  <script>
  $(document).ready(function() {
      $('#dataTable').DataTable( {
          "order": [[ 3, "asc" ]],
          "bLengthChange": false,
                    dom: 'Bfrtip',
          buttons: [
              {
                  extend: 'excelHtml5',
                  exportOptions: {
                      columns: [ 0, 1, 2, 3, 4 ]
                  }
              },
              {
                  extend: 'pdfHtml5',
                  customize: function ( doc ) {
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        image: 'data:image/png;base64,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'
                    } );
                },
                  exportOptions: {
                      columns: [ 0, 1, 2, 3, 4 ]
                  }
              }
          ]
      } );
      $('div.dataTables_filter').appendTo('.card-header');
      $('div.dt-buttons').appendTo('.action-buttons');
  } );
  </script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
