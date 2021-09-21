<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Customer List</h6>
  </div>

  <div class="card-body">
    
    <?php
    if(isset($_SESSION['success']) && $_SESSION['success'] !='')
    {
      echo '<h5> '.$_SESSION['success'].' </h2>';
      unset($_SESSION['success']);
    }
    if(isset($_SESSION['status']) && $_SESSION['status'] !='')
    {
      echo '<h5 class = "bg-info"> '.$_SESSION['status'].' </h2>';
      unset($_SESSION['status']);
    }
    ?>


    <div class="table-responsive">
    <?php
    $connection = mysqli_connect("localhost","root","","admin_db");
    $query = "SELECT * FROM `customer` WHERE exp > CURDATE()";
    $query_run = mysqli_query($connection, $query);
    ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width=5%><center> ID </center></th>
            <th width=40%><center> Customer Name </center></th>
            <th width=25%><center> EXPIRED DATE </center></th>
            <th width=10%><center> RENEW </center></th>
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
                                <td><?php  echo $row['exp']; ?></td>
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
                                              <label> Customer Name :<t> </label>
                                              <?php echo $row['nama'] ?>
                                            </div>
                                            <div class="form-group">
                                              <label>Expired Date</label>
                                              <input type="date" name="ed_exp" value="<?php echo $row['exp'] ?>" class="form-control"
                                                placeholder="Enter level">
                                            </div>
                                            
                                            </div>
                                            <div class="modal-footer">
                                            <a href="customer.php" class="btn btn-danger"> Cancel </a>
                                            <button type="submit" name="detailcust" class="btn btn-primary"> Renew </button>

                                            </div>
                                          </form>

                                        </div>
                                      </div>
                                    </div>


                                    <div class="container-fluid">

                                    <!-- DataTales Example -->
                                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailcust">Renew</button>

                                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
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