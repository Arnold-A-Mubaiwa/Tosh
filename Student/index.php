<?php
require('../config.php');
include_once(ROOT_PATH . '/include/header.php');
?>
<?php
include_once(ROOT_PATH . '/include/navbar.php');
?>
<div class="container-fluid bg-dark text-light">
<div class="mt-5 mb-3">
    <!-- <nav class="nav nav-pills nav-justified">
        <a class="nav-link text-light border mt-1" aria-current="page" href="#">New Videos</a>
        <a class="nav-link text-light border mt-1" href="#">Watched</a>
    </nav> -->
</div>
<?php

 $year=$_SESSION['login_year'];
 $faculty = $_SESSION['login_Faculty'];
$sql = "SELECT * FROM Videos Where Statuses = 'Active' and Faculty = '$faculty'";
// and Faculty=$faculty DESC Date
if ($result = mysqli_query($conn, $sql)) { 
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo "<div class='border-top row pt-3'>";
            echo "<div class='col-sm-4 p-4'>";
            echo "<a href='watch.php?PostID=". $row['PostID'] ."'>";
            echo "<img width='100%' height='215' src='https://img.youtube.com/vi/".substr($row['Link'],30)."/0.jpg'>";
            echo "</a></div>"; 
            echo "<div class='col-sm ml-3 pl-5 pr-5 pb-4'>";
            echo "<div class='row'><div class='col'>";
            echo "<h4>" . $row['Module'] . "</h4>";
            echo "</div><div class='col d-flex'>";
            echo "<a class='btn btn-dark border' href='watch.php?PostID=". $row['PostID'] ."'>Watch Video</a></div>";
            echo "</div>";
            echo "<div class='row'>";
            echo "<p class='p-3 h5 text-justify'>" . $row['Descrip'] . "</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    }
}
?>

</div>

<?php
include_once(ROOT_PATH . '/include/footer.php');
?>
 <!-- echo "<iframe width='100%' height='315' src='" . $row['Link'] . "?rel=0' title='" . $row['Module'] . "' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
                        "; -->
            