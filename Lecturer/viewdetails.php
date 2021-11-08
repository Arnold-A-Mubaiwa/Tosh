<?php
require('../config.php');
include_once(ROOT_PATH . '/include/header.php');
?>
<?php
include_once(ROOT_PATH . '/include/navbar.php');
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

?>
<?php

if (isset($_POST['comment'])) {
    $commPost = $_POST['comment'];
    $comsql = "INSERT INTO Comments(PostID,USER_ID,Comment)VALUES ('" . $PostID . "',' adff','" . $commPost . "')";
    if (mysqli_query($conn, $comsql)) {
        header('location:watch.php?PostID=' . $PostID);
    } else {
        echo "Student not added";
    }
}
?>

<?php
$sql = "SELECT * FROM Comments Where PostID = $PostID";
$comments =  0;
if ($result1 = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result1) > 0) {
?>
        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Comments</h5>
                        <button type="button" class=" btn-close " data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <?php if (mysqli_num_rows($result1) > 0) {
                        while ($rowComment = mysqli_fetch_array($result1)) {
                            $usrid = $rowComment["USER_ID"];
                            $sqluser = "SELECT * from Users Where UserID = '$usrid'";
                            $res1 = mysqli_query($conn, $sqluser);
                            $rw = mysqli_fetch_assoc($res1);
                            $comments += 1;
                            echo "<div class='border p-1'><b><small>" . $rw['Name'] . "  " . $rw['Surname'] . "  :::  " . $rowComment['Date'] . "</small></b><p class='h5 border p-3'>"
                                . $rowComment['Comment'] . "</p></div>";
                        }
                    } else {
                        echo "<div class='border p-5 h4 text-center'>No Comments</div>";
                    }
                    ?>
                    </div>
                    <div class="ml-5 pl-5">
                        <form method="POST">
                            <input name='comment' width="80%" class="form-control" type="text" placeholder="Comment Here">
                            <button type="submit" class="btn btn-secondary mr-5">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>
<div class="container bg-dark text-light">
<?php
echo "<div class='border row mt-3 pt-5'>";
echo "<div class='col-sm-8 p-4'>";
echo "<div class='row'>";
//  echo "<div class='col-sm'>";
echo "<iframe width='100%' height='415' src='" . $row['Link'] . "?rel=0' title='" . $row['Module'] . "' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
echo "</div>";
// echo "<div class='row pt-2'>";
// echo "<div class='col-sm'><button class='btn' data-toggle='modal' data-target='#exampleModalScrollable'>" . $comments . " Comments</<button></div>";
// echo "</div>";
?>

<?php
echo "</div>";
echo "<div class='col-sm text-white text-center bg-dark ml-3 pl-5 pr-5 pb-4'>";
?>
<div class="row border p-2">
  <a href="updatevideo.php?PostID=<?php echo $PostID;?>" class="btn mb-1 border-light btn-dark">
Update Video details
</a>


<button class="btn border-light btn-dark text-light" ><a href="index.php">
Back</a>
</button>  


</div>

<?php
echo "<div class='row '><div class='border-bottom'>";
echo "<h4 class=''>" . $row['Module'] . "</h4>";
echo "</div><div class='col d-flex'>";
echo "</div>";
echo "</div>";
echo "<div class='row border m-2'>";
echo "<p class='p-3 h5 text-justify'>" . $row['Description'] . "</p>";
echo "</div>";
?>
<div class="row  m-2 pt-4">
    <div class="col  pt-3 border">
        <h5 class=" text-uppercase">Notes</h5>
        <p>
            <?php
            echo $row['Notes'];
            ?>
        </p>
    </div>
</div>
<div class="row text-justify p-3 m-2 border">
    <p class="text-left h5 <?php if($row['Status']=='Active'){echo 'text-success';} else {echo 'text-danger';} ?>">
        Status : <?php echo $row['Status'] ?>
    </p>
</div>
<?php
echo "</div>";
echo "</div>";
$sqlWatched = "SELECT * FROM Watched where PostID  = $PostID";
$rowline = 0;
$totalviews =0;
?>

<div id="tbl" class="container border-top mt-4">
    <div class="row">
        <div class="col-sm-8">
            <?php
          if ($result = mysqli_query($conn, $sqlWatched)) {
            if (mysqli_num_rows($result) > 0) {
                echo '<table class="table table-bordered table-striped table-dark">';
                echo "<thead>";
                echo "<tr>";
                echo "<th>#</th>";
                echo "<th>Student Number</th>";
                echo "<th>Time Finished</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_array($result)) {
                    $rowline +=1;
                    $totalviews +=1;
                    echo "<tr>";
                    echo "<td>" . $rowline . "</td>";
                    echo "<td>" . $row['UserID'] . "</td>";
                    echo "<td>" . $row['Date'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                mysqli_free_result($result);
            } else {
                echo '<div class="alert alert-danger"><h4>No Views records were found.</h4></div>';
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
            ?>
        </div>
        <div class="col-sm pl-5  pt-2">
            <p class="h4">
                Total Views : <?php echo $totalviews; ?>
            </p>
            <button id="prints" class="btn btn-dark border-light">Print Table</button>
            <button class="btn btn-dark border-light" data-toggle='modal' data-target='#exampleModalScrollable'><?php echo $comments ?> Comments</button>
        </div>
    </div>
</div>
<script>
          $(document).ready(function () {
                $("#prints").click(function () {
                    $('container').hide();
                    // $('#uniCode').hide();
                    $('tbl').show();
                    window.print();
                    $('container').show();
                    // $('#uniCode').show();

                });
        });
      </script>
<?php
include_once(ROOT_PATH . '/include/footer.php');
?>