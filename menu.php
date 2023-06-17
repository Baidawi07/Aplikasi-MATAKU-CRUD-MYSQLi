<?php 
//untuk ngecek, apakah ada atau tidak tipe get menu di URL browser, agar tidak muncul error 
//jika menu tidak di tulis
$menu=isset($_GET['menu'])?$_GET['menu']:"home";
?>
<nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">Welcome To MATAKU</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item <?=($menu=="home")?"active":""?>">
        <a class="nav-link" href="?menu=home">HOME <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?=($menu=="jadwal")?"active":""?>">
        <a class="nav-link" href="?menu=jadwal">JADWAL</a>
      </li>
      <li class="nav-item <?=($menu=="tugas")?"active":""?>">
        <a class="nav-link" href="?menu=tugas">TUGAS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">LOGOUT</a>
      </li>
    </ul>
  </div>
  </div>

</nav>