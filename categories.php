<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="modal fade" id="addcat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Category Name </label>
                <input type="text" name="catname" class="form-control" placeholder="">
            </div>         
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="addcat" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Category 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcat">
              Insert Data 
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
    $query = "SELECT * FROM categories";
    $query_run = mysqli_query($connection, $query);
    ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> No </th>
            <th> Nama </th>   
            <th> EDIT </th>
            <th> DELETE </th>
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
                                <!-- /<td><?php  echo $row['usertype']; ?></td> -->
                                <td>
                                    <form action="code.php" method="POST">
                                    
                                    <div class="modal fade" id="editdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <form action="code.php" method="POST">

                                            <div class="modal-body">

                                            <div class="form-group">
                                            <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                                            <label> Nama </label>
                                            <input type="text" name="edit_nama" value="<?php echo $row['nama'] ?>" class="form-control"
                                                placeholder="Enter Username">
                                        </div>
                                            </div>
                                            <div class="modal-footer">
                                            <a href="categories.php" class="btn btn-danger"> CANCEL </a>
                                            <button type="submit" name="updatebtncat" class="btn btn-primary"> Update </button>

                                            </div>
                                          </form>

                                        </div>
                                      </div>
                                    </div>


                                    <div class="container-fluid">

                                    <!-- DataTales Example -->
                                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editdata">  Edit </button>

                                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                    </form>
                                </td>
                                <td>
                                    <form action="code.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_btncat" class="btn btn-danger"> DELETE</button>
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