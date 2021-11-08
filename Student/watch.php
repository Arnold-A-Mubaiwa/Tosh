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
$sql = "SELECT * FROM Comments Where PostID = $PostID";
$comments =  0;
if ($result1 = mysqli_query($conn, $sql)) {

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
                <div>
                    <form method="POST">
                    <input name='comment' class="form-control ml-2 mr-2" type="text" placeholder="Comment Here">
                     <button type="submit" class="btn btn-dark border ml-2 mt-2">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php

}
?>
<div class="bg-dark text-light p-2">
    <?php
    echo "<div class='border-top row mt-3 pt-5'>";
    echo "<div class='col-sm p-4'>";
    echo "<div class='row'>";
    //  echo "<div class='col-sm'>";
    echo "<iframe width='100%' height='415' src='" . $row['Link'] . "?rel=0' title='" . $row['Module'] . "' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
    echo "</div>";
    ?>

    <?php
    echo "</div>";
    echo "<div class='col-sm-3 ml-3 pl-5 pr-5 pb-4'>";
    echo "<a href='index.php'><button class='btn btn-light'>Back</button></a>";
    echo "<div class='row'><div class='col'>";
    echo "<h4>" . $row['Module'] . "</h4>";
    echo "</div><div class='col d-flex'>";
    echo "</div>";
    echo "</div>";
    echo "<div class='row'>";
    echo "<p class='p-3 text-justify'>" . $row['Descrip'] . "</p>";
    echo "</div>";
    ?>
    <div class="row border-top pt-4 ">
        <div class="col m-2 pt-3 pb-4 border">
            <?php
        echo "<div class='col-sm'><button class='btn btn-dark border' data-toggle='modal' data-target='#exampleModalScrollable'>" . $comments . " Comments</<button></div>";
      ?></div>
      <div>
          <form>
              <input type="checkbox" name="" id="">By Clicking this checkbox you acknoledge that you have watched this video<br>
              <!-- <input type="submit" value="Confirm"> -->
          </form>
      </div>
    </div>
    <?php
    echo "</div>";
    echo "</div>";
    ?>
    <div class="row ml-5 pl-5 text-justify">
        <div class="col m-5 pl-5">
            <h4>Notes</h4>
            <?php
echo $row['Notes'];
            ?>
        </div>
    </div>
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
</div>

<?php
include_once(ROOT_PATH . '/include/footer.php');
?>