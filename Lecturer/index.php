<?php
require('../config.php');
include_once(ROOT_PATH . '/include/header.php');
?>
<?php
include_once(ROOT_PATH . '/include/navbar.php');
$userID  = $_SESSION['login_ID'];
$sql = "SELECT * FROM Videos where UserID  = $userID";
$totalVids = 0;
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $totalVids += 1;
        }
    }
}
?>
<div class="container bg-dark text-light mt-3 text-center border-bottom pt-5">
    <div class="row pb-3">
        <div class="col-sm">
            <form>
                <input type="search" class="form-control mr-sm-2">
            </form>
        </div>
    </div>
    <div class="row pb-2">
        <div class="col-sm h4 ">
            <?php echo "Total Videos : " . $totalVids ?>
        </div>
        <div class="col-sm h4 ">
            Total Views
        </div>
        <div class="col-sm">
            <button class="btn btn-dark border-light">Print</button>
            <a href="<?php echo BASE_URL . '/Lecturer/uploadvideo.php'; ?>"><button class="btn btn-dark border-light">Upload Video</button></a>
        </div>

    </div>

    <?php

    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            echo '<table id="tbl" class="table table-bordered table-striped table-dark">';
            echo "<thead>";
            echo "<tr>";
            echo "<th>#</th>";
            echo "<th>Module</th>";
            echo "<th>Link</th>";
            // echo "<th>Description</th>";
            echo "<th>Year Of Study</th>";
            echo "<th>Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td></td>";
                echo "<td>" . $row['Module'] . "</td>";
                echo "<td>" . $row['Link'] . "</td>";
                // echo "<td>" . $row['Description'] . "</td>";
                echo "<td>" . $row['Year'] . "</td>";
                echo "<td>";
                echo '| <a href="viewdetails.php?PostID=' . $row['PostID'] . '" class="mr-3 pr-2 text-light" title="View Record" data-toggle="tooltip"><span class="pl-2 fa fa-eye"></span> </a>';
                echo ' | <a href="updatevideo.php?PostID=' . $row['PostID'] . '" class="mr-3 text-light" title="Update Record" data-toggle="tooltip"><span class="pl-2 fa fa-pencil"></span> </a>';
                // echo ' | <a href="deliti.php?ID=' . $row['PostID'] . '" title="Delete Record" class="mr-3 text-light" data-toggle="tooltip"><span class="pl-2 fa fa-trash"></span></a>';
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            mysqli_free_result($result);
        } else {
            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }

    // Close connection
    mysqli_close($conn);
    ?>
</div>
<script>
    $(document).ready(function() {
        $("#prints").click(function() {
            $('.container').hide();
            // $('#uniCode').hide();
            $('#tbl').show();
            window.print();
            $('.container').show();
            // $('#uniCode').show();

        });
    });
</script>

<?php
include_once(ROOT_PATH . '/include/footer.php');
?>