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
    $query = "SELECT * FROM customer WHERE exp >= DATE_ADD(CURDATE(), INTERVAL 0 DAY)";
    $query_run = mysqli_query($connection, $query);
    ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width=5%><center> ID </center></th>
            <th width=40%><center> Customer Name </center></th>
            <th width=20%><center> EXPIRED DATE </center></th>
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
                                <form action="code.php" method="POST ">
                                <td>
                                    <form action="expedit.php" method="post">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="expedit_btn" class="btn btn-success"> Renew </button>
                                    </form>
                                </td>     
                                </form>
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