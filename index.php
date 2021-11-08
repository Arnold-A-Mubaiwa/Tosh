<?php
    require_once('./config.php');
    include_once(ROOT_PATH . '/include/header.php');
?>
<?php
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        $user= $_POST['user'];
        $password= $_POST['password'];
        // $password = mysqli_real_escape_string($conn,$_POST['password']);
        $sql = "SELECT * from Users Where Password = $password and UserID=$user";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $UserID = $row['UserID'];
        $Name = $row['Name'];
        $Surname = $row['Surname'];
        $position = $row['Position'];
        $Faculty =$row['Faculty'];
        $year  = $row['Year'];
     
        if($position == "Lecturer"){
            $_SESSION['login_ID']=$UserID;
            $_SESSION['login_Name']= $Name;
            $_SESSION['login_Surname']= $Surname;
            $_SESSION['login_Position']=$position;
            $_SESSION['login_Faculty']= $Faculty;
            $_SESSION['login_year']= $year;
            header("location:Lecturer/index.php");
        }elseif ($position == "Student") {
            $_SESSION['login_ID']=$UserID;
            $_SESSION['login_Name']= $Name;
            $_SESSION['login_Surname']= $Surname;
            $_SESSION['login_Position']=$position;
            $_SESSION['login_Faculty']= $Faculty;
            $_SESSION['login_year']= $year;
            header("location:Student/index.php");
        } 
        else{
            // $_SESSION['login_Position']=$position;
            // header("location: error.php");
            echo '<div class="alert alert-danger"><p class="mt-3">Invalid password or username, retry|.</p></div>';
        }
    }
?>
<?php
// include_once(ROOT_PATH . '/include/navbar.php');
?>
<div class="container text-center bg-dark text-light">
    <div class="row m-5 p-5 ">
    <div class="col-sm-6"> 
    <p class=" pt-5">
        <h1 class="h1 pb-2">Sign In</h1>
         <form class="form" method="POST">
            <input type="text" name="user" class="form-control mb-3" placeholder="Enter Student Number">
            <input type="text" name="password" class="form-control mb-3" placeholder="Enter Password">
            <button type="submit" class="btn form-control border btn-dark">Sign In</button>
        </form>
    </p>
    </div>
    <div class="col-sm m-1 border">
        <p class="p-5"> 
             <h3>
                Learning made easier!
            </h3>
        </p>
           
    </div>
</div>
</div>

<?php
    include_once(ROOT_PATH . '/include/footer.php');
?>