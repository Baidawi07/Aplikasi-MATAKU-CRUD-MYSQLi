<?php
session_start();
if (empty($_SESSION['username'])){
  header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="bootstrap-4/css/bootstrap.min.css">
	<link rel="icon" type="image/png" href="img/buku.png" sizes="16x16" />
  <link rel="stylesheet" href="path/to/sweetalert.css">
	<title>MATAKU</title>
  <style>
            /* foont google */
    @import url("https://fonts.googleapis.com/css2?family=Courgette&display=swap");
    @import url('https://fonts.googleapis.com/css2?family=Courgette&family=Open+Sans:wght@300&family=Public+Sans:wght@100;200;300&family=Secular+One&family=Signika+Negative:wght@300;400;500&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Berkshire+Swash&family=Courgette&family=Open+Sans:wght@300&family=Public+Sans:wght@100;200;300&family=Secular+One&family=Signika+Negative:wght@300;400;500&display=swap');
    footer {
      position: fixed;
      left: 0;
      bottom: 0;
      width: 100%;
    }
    .navbar-brand {
      font-family: "Courgette", cursive;
    }
    .navbar-nav {
      font-family: 'Secular One', sans-serif;
    }
    /* css home */
    .card {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      margin-top: 4rem;
      box-shadow: 0 3px 20px rgba(0,0,0,0.4);
    }

    .media {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    @media only screen and (min-width: 600px) {
      .media {
        flex-direction: row;
        align-items: flex-start;
        justify-content: center;
      }
    }

      .media-body {
        margin-top: 1rem;
        margin-left: 2rem;
        padding-right: 2rem;
      }
      h1 {
        font-family: 'Berkshire Swash', cursive;
      }

  </style>
 
</head>
<body class="mt-5">

<?php 
include "menu.php";
?>
<div class="container">
  <?php 
  include "tengah.php";
  ?>
</div> <!-- container -->

<div class="mt-5"></div>

<!-- Footer -->
<footer>
  <!-- Copyright -->
  <div class="text-center p-0.5" style="background-color: rgba(0, 0, 0, 0.05);">
    © <?php echo date("Y"); ?> Copyright:
    <h6 class="text-reset fw-bold">Bay&Riski</h6>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->





    <script src="bootstrap-4/js/jquery-3.3.1.slim.min.js"></script>
    <script src="bootstrap-4/js/popper.min.js"></script>
    <script src="bootstrap-4/js/bootstrap.min.js"></script>
    <script src="path/to/sweetalert.min.js"></script>
</body>
</html>