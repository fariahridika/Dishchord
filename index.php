<html lang="en">

<?php
session_start();
include "db_conn.php";
include 'php/User.php';

if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {


    $user = getUserById($_SESSION['id'], $conn);

    include "template/user_header.php";
} else {
    include "template/header.php";
}

$feat_recipes = "";
$latest_recipes ="";
$MostReviewed_recipes ="";
$MostRated_recipes ="";
// echo $latest_recipes[0]['picture'];

?>
<!-- Spinning Picture of Navbar -->
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container my-5 py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-3 text-white animated slideInLeft">All Dish<br>In One Chord</h1>
                <!-- <p class="text-white animated slideInLeft mb-4 pb-2">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p> -->
                <!-- <a href="" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Book A Table</a> -->
            </div>
            <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                <img class="img-fluid" src="img/hero.png" alt="">
            </div>
        </div>
    </div>
</div>
</div>


<div class="featured-recipes">
    <h2 class="section-title ff-secondary text-center text-primary fw-normal">Featured Recipes</h2>

    
      





<?php include "template/footer.php" ?>


<!-- Back to Top -->


</html>