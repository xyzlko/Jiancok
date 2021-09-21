<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="modal fade" id="addcust" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Customer Name </label>
                <input type="text" name="custname" class="form-control" placeholder=" ">
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control" placeholder=" ">
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="nomor" class="form-control" placeholder=" ">
            </div>
            <div class="form-group">
                <label> NIK </label>
                <input type="text" name="nik" class="form-control" placeholder=" ">
            </div>
            <div class="form-group">
                <label>Installation Date</label>
                <input type="date" name="inst" class="form-control" placeholder=" ">
            </div>
            <div class="form-group">
                <label> Expired Date </label>
                <input type="date" name="exp" class="form-control" placeholder=" ">
            </div>
            <div class="form-group">
                <label> Location </label>
                <input type="text" name="loc" class="form-control" placeholder=" ">
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="addcust" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Customer List 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcust">
              Add Customer
            </button>
    </h6>
  </div>

  <div class="card-body">
    
    <?php
    if(isset($_SESSION['success']) && $_SESSION['success'] !='')
    {
      echo '<h2> '.$_SESSION['success'].' </h2>';
      unset($_SESSION['success']);
    }
    if(isset($_SESSION['status']) && $_SESSION['status'] !='')
    {
      echo '<h2 class = "bg-info"> '.$_SESSION['status'].' </h2>';
      unset($_SESSION['status']);
    }
    ?>


    <div class="table-responsive">
    <?php
    $connection = mysqli_connect("localhost","root","","admin_db");
    $query = "SELECT * from customer";
    $query_run = mysqli_query($connection, $query);
    ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width=5%><center> ID </center></th>
            <th width=40%><center> Customer Name </center></th>
            <th width=25%><center> KTP </center></th>
            <th width=10%><center> EDIT </center></th>
            <th width=10%><center> DELETE </center></th>
          </tr>
        </thead>
        <tbody>
                        <?php
                        if(mysqli_num_rows($query_run) > 0)        
                        {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                        ?>
                            <tr>
                                <td><?php  echo $row['id']; ?></td>
                                <td><?php  echo $row['nama']; ?></td>
                                <td><?php  echo $row['nik']; ?></td>
                                <!-- /<td><?php  echo $row['usertype']; ?></td> -->
                                <td>
                                    <form action="code.php" method="POST">
                                    
                                    <div class="modal fade" id="detailcust" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <form action="code.php" method="POST">

                                            <div class="modal-body">

                                            <div class="form-group">
                                              <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                                              <label> Customer Name </label>
                                              <input type="text" name="ed_nama" value="<?php echo $row['nama'] ?>" class="form-control"
                                                placeholder="Enter Username">
                                            </div>
                                            <div class="form-group">
                                              <label>NIK</label>
                                              <input type="text" name="ed_nik" value="<?php echo $row['nik'] ?>" class="form-control"
                                                placeholder="Enter level">
                                            </div>
                                            <div class="form-group">
                                              <label>Address</label>
                                              <input type="text" name="ed_address" value="<?php echo $row['address'] ?>" class="form-control"
                                                placeholder="Enter level">
                                            </div>
                                            <div class="form-group">
                                              <label>Phone</label>
                                              <input type="text" name="ed_phone" value="<?php echo $row['phone'] ?>"
                                                class="form-control" placeholder="Enter Password">
                                            </div>
                                            <div class="form-group">
                                              <label>Installation Date</label>
                                              <input type="date" name="ed_ins" value="<?php echo $row['install'] ?>" class="form-control"
                                                placeholder="Enter level">
                                            </div>
                                            <div class="form-group">
                                              <label>Expired Date</label>
                                              <input type="date" name="ed_exp" value="<?php echo $row['exp'] ?>" class="form-control"
                                                placeholder="Enter level">
                                            </div>
                                            <div class="form-group">
                                              <label>Coordinat</label>
                                              <input type="text" name="ed_coor" value="<?php echo $row['coordinat'] ?>" class="form-control"
                                                placeholder="Enter level">
                                            </div>
                                            
                                            </div>
                                            <div class="modal-footer">
                                            <a href="customer.php" class="btn btn-danger"> CANCEL </a>
                                            <button type="submit" name="detailcust" class="btn btn-primary"> Update </button>

                                            </div>
                                          </form>

                                        </div>
                                      </div>
                                    </div>


                                    <div class="container-fluid">

                                    <!-- DataTales Example -->
                                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailcust">  Edit </button>

                                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                    </form>
                                </td>
                                <td>
                                    <form action="code.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_btncust" class="btn btn-danger"> DELETE</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                            } 
                        }
                        else {
                            echo "No Record Found";
                        }
                        ?>
                    </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>