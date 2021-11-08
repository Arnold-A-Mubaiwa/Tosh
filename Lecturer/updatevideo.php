<?php
require('../config.php');
include_once(ROOT_PATH . '/include/header.php');
?>
<?php
// include_once(ROOT_PATH . '/include/navbar.php');
?>
<?php
$sql = "SELECT * FROM Videos WHERE PostID = ?";

if ($stmt = mysqli_prepare($conn, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "i", $param_id);
    // Set parameters
    $param_id = trim($_GET["PostID"]);
    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $PostID = $row['PostID'];
            $userID = $row['UserID'];
        } else {
            // URL doesn't contain valid id parameter. Redirect to error page
            exit();
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}

// Close statement
mysqli_stmt_close($stmt);
if (isset($_POST['Module'])) {
    $module = $_POST['Module'];
    $link  = $_POST['Link'];
    $Descrip  = $_POST['Description'];
    $Year  = $_POST['Year'];
    $faculty = $_POST['Faculty'];
    $status  = $_POST['Status'];

	mysqli_query($conn, "UPDATE Videos SET  Module='$module', Link='$link',Description='$Descrip',UserID='$userID',Year='$Year',Faculty='$faculty',Status='$status' WHERE PostID=$PostID");
	
}
?>

<div class="container p-5 bg-dark text-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header pt-3 border-bottom">
                    <h2> Update Video</h2>
                </div>
                <form method="post" action="">
                    <div class="form-group"> <label for="Module">Module</label>
                        <input value="<?php echo $row['Module']; ?>" class="form-control border-dark" type="text" name="Module" size="6" required><br>
                    </div>
                    <div class="form-group"><label for="Link">Link</label>
                        <input value="<?php echo $row['Link']; ?>" class="form-control border-dark" type="text" name="Link" required><br>
                    </div>
                    <div class="form-group"> <label for="Description">Description</label>
                        <input value="<?php echo $row['Description']; ?>" class="form-control border-dark" type="text" name="Description" required><br>
                    </div>
                    <div class="form-group"><label for="Year">Year Of Study</label>
                    <select name="Year" class="form-control border-dark">
                    <option><?php echo $row['Year'] ?></option>
                            <option>1st</option>
                            <option>2nd</option>
                            <option>3rd</option>
                        </select> </div>
                    <div class="form-group pb-3"><label for="Faculty">Faculty</label>
                        <select name="Faculty" class="form-control border-dark">
                         <option><?php echo $row['Faculty'] ?></option>
                             <option>MICT</option>
                            <option>NP</option>
                            <option>BEMS</option>
                            <option>PMLG</option>
                        </select>
                    </div>
                    <div class="form-group pb-3"><label for="Status">Status</label>
                        <select name="Status" class="form-control border-dark">
                         <option><?php echo $row['Status'] ?></option>
                             <option>Active</option>
                            <option>Inactive</option>
                        </select>
                    </div>

                    <input type="submit" class="btn btn-dark border-light btnSubmit" value="Update">
                    <a href="index.php" class="btn btn-light  btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include(ROOT_PATH . '/include/footer.php');
?><