<?php

// Bagian Home
if ($menu=='home'){
	include "page/home/home.php";
}

// Bagian jadwal
elseif ($menu=='jadwal'){
    include "page/Jadwal/jadwal.php";   
}

// Bagian tugas
elseif ($menu=='tugas'){
    include "page/Tugas/tugas.php";   
}

// Apabila modul tidak ditemukan
else{
  echo "<h4 class='text-center' style='margin-top:60px;'><b>PAGE BELUM ADA ATAU BELUM LENGKAP ATAU ANDA TIDAK BERHAK 
  MENGAKSES HALAMAN INI</b></h4>";
}
?>
