<?php
require_once('../config.php');
$UserID=$_SESSION['login_ID'];
if (count($_POST) > 0) {

    $UniqueNo = abs(crc32(uniqid()));
   
    $sql = "INSERT INTO Videos(PostID,Module, Link,Descrip,Notes,UserID,Year,Faculty,Statuses)VALUES ('" . $UniqueNo . "','" . $_POST['Module'] . "','" . $_POST['Link'] . "','" . $_POST['Description'] . "','" . $_POST['notes'] . "','" . $UserID . "','" . $_POST['Year'] . "','" . $_POST['Faculty'] . "','" . $_POST['Status'] . "')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<div class='text-light'> Lecturer Added</div>";
    } else {
        echo "<div class='text-light'> Lecturer not added". $conn->error ."</div>";
    }
    // mysqli_query($conn,$sql);
    $current_id = mysqli_insert_id($conn);

    $conn->close();
}
include_once(ROOT_PATH . '/include/header.php');

include_once(ROOT_PATH . '/include/navbar.php');
?>
<div class="container p-5 bg-dark text-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header pt-3 border-bottom">
                    <h2> Adding New Video</h2>
                </div>
                <form method="post" action="">
                    <div class="form-group"> <label for="Module">Module</label>
                        <input class="form-control border-dark" type="text" name="Module" size="6" required><br>
                    </div>
                    <div class="form-group"><label for="Link">Link</label>
                        <input class="form-control border-dark" type="text" name="Link" required><br>
                    </div>
                    <div class="form-group"> <label for="Description">Description</label>
                        <input class="form-control border-dark" type="text" name="Description" required><br>
                    </div>
                    <div class="form-group"> <label for="Notes">Notes</label>
                    <textarea name="notes" id="notes" class="form-control"></textarea>
                    </div>
                    <div class="form-group"><label for="Year">Year Of Study</label>
                    <select name="Year" class="form-control border-dark">
                            <option>1st</option>
                            <option>2nd</option>
                            <option>3rd</option>
                        </select> </div>
                    <div class="form-group pb-3"><label for="Faculty">Faculty</label>
                        <select name="Faculty" class="form-control border-dark">
                            <option>MICT</option>
                            <option>NP</option>
                            <option>BEMS</option>
                            <option>PMLG</option>
                        </select>
                    </div>
                    <div class="form-group pb-3"><label for="Status">Status</label>
                        <select name="Status" class="form-control border-dark">
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                    </div>

                    <input type="submit" class="btn btn-dark border-light btnSubmit" value="Submit">
                    <a href="index.php" class="btn btn-light  btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
	CKEDITOR.replace('notes');
</script>
<?php
include(ROOT_PATH . '/include/footer.php');
?>
