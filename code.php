<?php
include('security.php');

// Site account -----------------------------------------------------------------------------------------------

if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $level = $_POST['level'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    $username_query = "SELECT * FROM register WHERE username='$username' ";
    $username_query_run = mysqli_query($connection, $username_query);
    if(mysqli_num_rows($username_query_run) > 0)
    {
        $_SESSION['status'] = "Username Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');  
    }
    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO register (username,level,password) VALUES ('$username','$level','$password')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "Admin Profile Added";
                $_SESSION['status_code'] = "success";
                header('Location: register.php');
            }
            else 
            {
                $_SESSION['status'] = "Admin Profile Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: register.php');  
        }
    }

}

if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $level = $_POST['edit_level'];
    $password = $_POST['edit_password'];

    $query = "UPDATE register SET username='$username', level='$level', password='$password' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }
}

if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM register WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }    
}

// Login -----------------------------------------------------------------------------------------------

if(isset($_POST['login_btn']))
{
    $username_login = $_POST['usernamee']; 
    $password_login = $_POST['passwordd']; 

    $query = "SELECT * FROM register WHERE username='$username_login' AND password='$password_login' LIMIT 3";
    $query_run = mysqli_query($connection, $query);

   if(mysqli_fetch_array($query_run))
   {
        $_SESSION['username'] = $username_login;
        header('Location: index.php');
   } 
   else
   {
        $_SESSION['status'] = "Email / Password is Invalid";
        header('Location: login.php');
   }
    
}

// Categories -----------------------------------------------------------------------------------------------

if(isset($_POST['addcat']))
{
    $nama = $_POST['catname'];    

    $nama_query = "SELECT * FROM categories WHERE nama='$nama' ";
    $nama_query_run = mysqli_query($connection, $nama_query);
    if(mysqli_num_rows($nama_query_run) > 0)
    {
        $_SESSION['status'] = "Category Sudah Ada";
        $_SESSION['status_code'] = "error";
        header('Location: categories.php');  
    }
    else
            $query = "INSERT INTO categories (nama) VALUES ('$nama')";
            $query_run = mysqli_query($connection, $query);
             // echo "Saved";
             $_SESSION['status'] = "Admin Profile Added";
             $_SESSION['status_code'] = "success";
             header('Location: categories.php');

}

if(isset($_POST['updatebtncat']))
{
    $id = $_POST['edit_id'];
    $nama = $_POST['edit_nama'];

    $query = "UPDATE categories SET nama='$nama' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: categories.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: categories.php'); 
    }
}

if(isset($_POST['delete_btncat']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM categories WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: categories.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: categories.php'); 
    }    
}

// Brands -----------------------------------------------------------------------------------------------

if(isset($_POST['addbrand']))
{
    $bnama = $_POST['bname'];
    $cnama = $_POST['cname'];

    $cdata = "SELECT nama FROM categories";
    try
    {
        $stmt = $connection ->prepare($cdata);
        $stmt -> execute();
        $results=$stmt->fetchAll();
    }
    catch(Exception $ex)
    {
        echo($ex -> getMessage());
    }

    $nama_query = "SELECT * FROM brands WHERE bname='$bnama' ";
    $nama_query_run = mysqli_query($connection, $nama_query);
    if(mysqli_num_rows($nama_query_run) > 0)
    {
        $_SESSION['status'] = "brands Sudah Ada";
        $_SESSION['status_code'] = "error";
        header('Location: brands.php');  
    }
    else
            $query = "INSERT INTO categories (nama) VALUES ('$nama')";
            $query_run = mysqli_query($connection, $query);
             // echo "Saved";
             $_SESSION['status'] = "Admin Profile Added";
             $_SESSION['status_code'] = "success";
             header('Location: brands.php');

}

// Customer -----------------------------------------------------------------------------------------------

if(isset($_POST['addcust']))
{
    $custname = $_POST['custname'];
    $address = $_POST['address'];
    $nomor = $_POST['nomor'];
    $nik = $_POST['nik'];
    $inst = $_POST['inst'];
    $exp = $_POST['exp'];
    $loc = $_POST['loc'];    

    $nama_query = "SELECT * FROM customer WHERE nama='$custname' ";
    $nama_query_run = mysqli_query($connection, $nama_query);
    if(mysqli_num_rows($nama_query_run) > 0)
    {
        $_SESSION['status'] = "Category Sudah Ada";
        $_SESSION['status_code'] = "error";
        header('Location: customer.php');  
    }
    else
            $query = "INSERT INTO customer (nama,address,phone,nik,install,exp,coordinat) VALUES ('$custname','$address','$nomor','$nik','$inst','$exp','$loc')";
            $query_run = mysqli_query($connection, $query);
             // echo "Saved";
             $_SESSION['status'] = "Admin Profile Added";
             $_SESSION['status_code'] = "success";
             header('Location: customer.php');

}

if(isset($_POST['detailcust']))
{
    $id = $_POST['edit_id'];
    $nama = $_POST['ed_nama'];
    $nik = $_POST['ed_nik'];
    $address = $_POST['ed_address'];
    $phone = $_POST['ed_phone'];
    $ins = $_POST['ed_ins'];
    $exp = $_POST['ed_exp'];
    $loc = $_POST['ed_coor'];

    $query = "UPDATE customer SET nama='$nama', address='$address', phone='$phone', nik ='$nik', install ='$ins', exp ='$exp', coordinat ='$loc' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: customer.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: customer.php'); 
    }
}

if(isset($_POST['delete_btncust']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM customer WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: customer.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: customer.php'); 
    }    
}


// Customer soon exp -----------------------------------------------------------------------------------------------
if(isset($_POST['csoon']))
{
    $id = $_POST['edit_id'];
    $exp = $_POST['ed_nexp'];

    $query = "UPDATE customer SET exp ='$exp' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: soon.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: soon.php'); 
    }
}
?>

