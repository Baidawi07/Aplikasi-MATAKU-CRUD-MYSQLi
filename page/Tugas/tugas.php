<?php
include "koneksi.php";
$action=isset($_GET['submenu'])? $_GET['submenu'] :'';
switch($action){
default:
?>
<h1 class="text-center" style="margin-top:60px;"> Halaman Tugas</h1>
<hr/>
<div class="row">
	<div class="col-sm-10 mx-auto">
	  <h4>Data Tugas</h4>
	  
	  <form method="POST" action="">
		<div class="input-group mb-3">
		  <div class="input-group-prepend">
			<a href="?menu=tugas&submenu=tambah" class="btn btn-primary ">Tambah Data</a>
		  </div>
		  <input type="text" name="kata" class="form-control" placeholder="Cari Tugas" autocomplete="off">
		  <div class="input-group-append">
			<button class="btn btn-primary btn-sm" type="submit" name="cari">Go</button>
		  </div>
		</div>
	  </form>
	 <div class="table-responsive ">
	 <table class="table table-hover table-striped">
	  <thead class="thead-dark">
		<tr>
			<th>No</th>
			<th>Matakuliah</th>
			<th>Nama Tugas</th>
			<th>Deadline</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	  </thead>
	  <tbody>
	<?php 
	if(isset($_POST['cari'])){
		$kata = $_POST['kata'];
		$query=mysqli_query($koneksi, "SELECT * FROM tbl_tugas WHERE nama_matakuliah LIKE '%$kata%' ORDER BY id_tugas asc");
	}else{
		$query=mysqli_query($koneksi, "SELECT * FROM tbl_tugas ORDER BY id_tugas asc");
	}
	
	$no=1;
	while($d=mysqli_fetch_assoc($query)){ 
	//ini menghasilkan array associative
	?>
		<tr>
			<td><?= $no; ?></td>
			<td><?= $d['nama_matakuliah']; ?></td>
			<td><?= strtolower($d['nama_tugas']); ?></td>
			<td><?= $d['dateline']; ?></td>
			<td><a href="?menu=tugas&submenu=edit&id=<?= $d['id_tugas'];?>">Edit</a></td>
			<td>
				<a href="?menu=tugas&submenu=hapus&id=<?= $d['id_tugas'];?>" 
				onClick="return confirm('Yakin mau di hapus?');">Delete</a>
			</td>
		</tr>
	<?php 
	$no++;
	} 
	?>
	  </tbody>
	 </table>
	 </div> <!-- end div responsive -->
	</div>
	<div class="col-sm-4">
	<?php $status=isset($_GET['status'])?$_GET['status']:"";?>
	<?php if($status=="sukses"){ ?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Tambah Data Sukses</strong> Data Telah Berhasil Di Tambahkan
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php } else if($status=="gagal"){ ?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Tambah Data Gagal</strong> Data Gagal Di Tambahkan
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php } else if(empty($status)){ ?>
	
	<?php }?>

	</div>
  </div> <!-- end row -->
<?php 
break;

case "tambah":
?>
<h1 class="text-center" style="margin-top:60px;"> Tambah Tugas</h1>
<hr width="50%"/>
<div class="row">
	<div class="col-sm-4  mx-auto">
		<form method="POST">
			<div class="form-group">
				<label for="id">Nomer</label><br/>
				<input type="number" class="form-control"  name="id" id="id"/>
			</div>
			<div class="form-group">
				<label for="matakuliah">Matakuliah</label><br/>
				<input type="text" class="form-control" name="matakuliah" id="matakuliah" required placeholder="tulis matakuliah" autocomplete="off" />
			</div>
			<div class="form-group">
				<label for="nama_tugas">Nama Tugas</label><br/>
				<input type="text" class="form-control"  name="nama_tugas" id="nama_tugas"/>
			</div>
			<div class="form-group">
				<label for="dateline">Deadline</label><br/>
				<input type="date" class="form-control"  name="dateline" id="dateline"/>
			</div>
			
			
			<button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
			<a href="?menu=tugas" class="btn btn-info">Kembali</a>
		</form>
	</div>
</div> <!-- end row -->
<?php 
if(isset($_POST['submit'])){ //jika tombol submit di klik
	//ambil data dari form input
	//mengabaikan tanda petik
	//$nama=mysqli_real_escape_string($koneksi, $_POST['']);
	$id=$_POST['id']; 
	$matakuliah=htmlspecialchars($_POST['matakuliah']); 
	$nama_tugas=htmlspecialchars($_POST['nama_tugas']); //mengabaikan tag html; 
	$dateline=($_POST['dateline']);
	$query=mysqli_query($koneksi, 
		"INSERT INTO tbl_tugas VALUES 
		('$id','$matakuliah','$nama_tugas','$dateline')
		");
	$sukses=mysqli_affected_rows($koneksi);
	if($sukses > 0){
		echo "<script>
			window.location.href='?menu=tugas&status=sukses';
		</script>";
	}else{
		echo "<script>
			window.location.href='?menu=tugas&status=gagal';
		</script>"; 
	}
}
?>
<?php 
break;
case "edit":
	$id=$_GET['id'];
    $edit=mysqli_query($koneksi,"SELECT * FROM tbl_tugas WHERE id_tugas='$id'");
	$ada = mysqli_num_rows($edit);
	if($ada > 0){
		$d=mysqli_fetch_array($edit);
	}else{
		echo "<h1>MAAF ID TIDAK DI KENAL</h1>";
		exit();
	}
    
?>
<h1 class="text-center" style="margin-top:60px;"> Edit Tugas</h1>
<hr width="50%"/>
<div class="row">
	<div class="col-sm-4  mx-auto">
		<form method="POST">
			<input type="hidden" name="id" value="<?=$d['id_tugas'];?>" />
			<div class="form-group">
				<label for="matakuliah">Matakuliah</label><br/>
				<input type="text" class="form-control" name="matakuliah" id="matakuliah" value="<?=$d['nama_matakuliah'];?>" required placeholder="tulis nama" autocomplete="off" />
			</div>
			<div class="form-group">
				<label for="nama_tugas">Nama Tugas</label><br/>
				<input type="text" class="form-control"  name="nama_tugas" id="nama_tugas" value="<?=$d['nama_tugas'];?>"/>
			</div>
			<div class="form-group">
				<label for="dateline">Deadline</label><br/>
				<input type="date" class="form-control"  name="dateline" id="dateline" value="<?=$d['dateline'];?>"/>
			</div>
			
			
			<button type="submit" name="submit" class="btn btn-primary">Edit Data</button>
			<a href="?menu=tugas" class="btn btn-info">Kembali</a>
		</form>
	</div>
</div> <!-- end row -->
<?php 
if(isset($_POST['submit'])){ //jika tombol submit di klik
	//ambil data dari form input
	$id=$_POST['id'];
	$matakuliah=mysqli_real_escape_string($koneksi, $_POST['matakuliah']); //mengabaikan tanda petik
	$nama_tugas=htmlspecialchars($_POST['nama_tugas']); //mengabaikan tag html;
	$dateline=$_POST['dateline'];
	$query=mysqli_query($koneksi, "UPDATE tbl_tugas SET 
	nama_matakuliah='$matakuliah', nama_tugas='$nama_tugas', dateline='$dateline'
	WHERE id_tugas='$id' ");
	$sukses=mysqli_affected_rows($koneksi);
	if($sukses > 0){
		echo "<script>alert('Data Berhasil di UBAH');
			window.location.href='?menu=tugas';
		</script>";
	}else{
		echo "<script>alert('Data GAGAL di UBAH');
			window.location.href='?menu=tugas';
		</script>"; 
	}
}
break;
case "hapus":
  $query=mysqli_query($koneksi,"select id_tugas from tbl_tugas where id_tugas='$_GET[id]'");
  $cek=mysqli_num_rows($query);
  if($cek == 0){
	echo "<script>alert('Hapus Data Gagal, Data Tidak Ditemukan');
      window.location=('?menu=tugas')</script>";
  }else{
	$hapus=mysqli_query($koneksi,"DELETE FROM tbl_tugas WHERE id_tugas='$_GET[id]'");
	if($hapus){
      echo "<script>
      window.location=('?menu=tugas')</script>";
    }else{
      echo "<script>alert('Hapus Data Gagal');
      window.location=('?menu=tugas')</script>";
    }
  } 
break;
}