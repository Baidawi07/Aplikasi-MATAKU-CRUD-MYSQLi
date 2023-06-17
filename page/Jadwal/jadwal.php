<?php
include "koneksi.php";
$action=isset($_GET['submenu'])? $_GET['submenu'] :'';
switch($action){
default:
?>
<h1 class="text-center" style="margin-top:60px;"> Halaman Jadwal</h1>
<hr/>
<div class="row">
	<div class="col-sm-10  mx-auto">
	  <h4>Data Jadwal</h4>
	  <a href="?menu=jadwal&submenu=tambah" class="btn btn-primary mb-2" >Tambah Data</a>

	 <div class="table-responsive ">
	 <table class="table table-hover table-striped">
	  <thead class="thead-dark">
		<tr>
			<th>No</th>
			<th>Hari</th>
			<th>Matakuliah</th>
			<th>SKS</th>
			<th>Waktu Mulai</th>
			<th>Waktu Selesai</th>
			<th>Kelas</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	  </thead>
	  <tbody>
	<?php 
	
	$query=mysqli_query($koneksi, "SELECT * FROM tbl_jadwal ORDER BY id_jadwal asc");
	$no=1;
	while($d=mysqli_fetch_assoc($query)){ 
	//ini menghasilkan array associative
	?>
		<tr>
			<td><?= $no; ?></td>
			<td><?= $d['hari']; ?></td>
			<td><?= strtolower($d['matakuliah']); ?></td>
			<td><?= $d['sks']; ?></td>
			<td><?= $d['waktu_mulai']; ?></td>
			<td><?= $d['waktu_selesai']; ?></td>
			<td><?= $d['kelas']; ?></td>
			<td><a href="?menu=jadwal&submenu=edit&id=<?= $d['id_jadwal'];?>">Edit</a></td>
			<td>
				<a href="?menu=jadwal&submenu=hapus&id=<?= $d['id_jadwal'];?>" 
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
  </div> <!-- end row -->
<?php 
break;

case "tambah":
?>
<h1 class="text-center" style="margin-top:60px"> Tambah jadwal</h1>
<hr width="50%">
<div class="row">
	<div class="col-sm-4 mx-auto">
	<form method="POST">
          <div class="form-group">
            <label for="id">Nomer</label>
            <input type="number" class="form-control" name="id" id="id"/>
          </div>
          <div class="form-group">
            <label for="hari">Hari</label>
            <select class="form-control" name="hari" id="hari">
              <option value="Senin">Senin</option>
              <option value="Selasa">Selasa</option>
              <option value="Rabu">Rabu</option>
              <option value="Kamis">Kamis</option>
              <option value="Jumat">Jumat</option>
              <option value="Sabtu">Sabtu</option>
              <option value="Minggu">Minggu</option>
            </select>
          </div>
          <div class="form-group">
            <label for="matakuliah">Matakuliah</label>
            <input type="text" class="form-control" name="matakuliah" id="matakuliah"/>
          </div>
          <div class="form-group">
            <label for="sks">SKS</label>
            <input type="number" class="form-control" name="sks" id="sks" value="1" min="1" max="100" required autocomplete="off"/>
          </div>
          <div class="form-group">
            <label for="waktu_mulai">Waktu Mulai</label>
            <input type="time" class="form-control" name="waktu_mulai" id="waktu_mulai"/>
          </div>
          <div class="form-group">
            <label for="waktu_selesai">Waktu Selesai</label>
            <input type="time" class="form-control" name="waktu_selesai" id="waktu_selesai"/>
          </div>
          <div class="form-group">
            <label for="kelas">Kelas</label>
            <select class="form-control" name="kelas" id="kelas">
              <option value="FT-1">FT-1</option>
              <option value="FT-2">FT-2</option>
              <option value="FT-3">FT-3</option>
              <option value="FT-4">FT-4</option>
            </select>
          </div>
          
          <button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
          <a href="?menu=jadwal" class="btn btn-info">Kembali</a>
        </form>
	</div>
</div> <!-- end row -->
<?php 
if(isset($_POST['submit'])){ //jika tombol submit di klik
  //ambil data dari form input
  //mengabaikan tanda petik
  $id=($_POST['id']);
  $hari=mysqli_real_escape_string($koneksi, $_POST['hari']); 
  $matakuliah=htmlspecialchars($_POST['matakuliah']); //mengabaikan tag html; 
  $sks=($_POST['sks']);
  $waktu1=($_POST['waktu_mulai']);
  $waktu2=($_POST['waktu_selesai']);
  $kelas=($_POST['kelas']);
  $query=mysqli_query($koneksi, 
    "INSERT INTO tbl_jadwal VALUES 
    ('$id','$hari','$matakuliah','$sks','$waktu1','$waktu2','$kelas')
    ");
  $sukses=mysqli_affected_rows($koneksi);
  if($sukses > 0){
    echo "<script>alert('Data Berhasil di Tambah');
      window.location.href='?menu=jadwal';
    </script>";
  }else{
    echo "<script>alert('Data GAGAL di Tambah');
      window.location.href='?menu=jadwal';
    </script>"; 
  }
}
?>

<?php 
break;

case "edit":
	//mengambil id yang dikirim melalui URL..
	$id=$_GET['id'];
	//query ke tabel sesuai dengan ID yang ada di URL
    $edit=mysqli_query($koneksi,"SELECT * FROM tbl_jadwal WHERE id_jadwal='$id'");
    $d=mysqli_fetch_array($edit);
?>
<h1 class="text-center" style="margin-top:60px"> Edit jadwal</h1>
<hr width="50%"/>
<div class="row">
	<div class="col-sm-4  mx-auto">
		<form method="POST">
			<input type="hidden" name="id" value="<?=$d['id_jadwal'];?>" />

			<div class="form-group">
				<label for="hari">Hari</label><br/>
				<select class="form-control" name="hari" id="hari">
					<option value="Senin" <?php $nilai_database=$d['hari']; if ($nilai_database=="Senin") echo 'selected'?>>Senin</option>
					<option value="Selasa" <?php $nilai_database=$d['hari']; if ($nilai_database=="Selasa") echo 'selected'?>>Selasa</option>
					<option value="Rabu" <?php $nilai_database=$d['hari']; if ($nilai_database=="Rabu") echo 'selected'?>>Rabu</option>
					<option value="Kamis" <?php $nilai_database=$d['hari']; if ($nilai_database=="Kamis") echo 'selected'?>>Kamis</option>
					<option value="Jumat" <?php $nilai_database=$d['hari']; if ($nilai_database=="Jumat") echo 'selected'?>>Jumat</option>
					<option value="Sabtu" <?php $nilai_database=$d['hari']; if ($nilai_database=="Sabtu") echo 'selected'?>>Sabtu</option>
					<option value="Minggu" <?php $nilai_database=$d['hari']; if ($nilai_database=="Minggu") echo 'selected'?>>Minggu</option>
				</select>
			</div>
			<div class="form-group">
				<label for="matakuliah">Matakuliah</label><br/>
				<input type="text" class="form-control"  name="matakuliah" id="matakuliah" value="<?=$d['matakuliah'];?>"/>
			</div>
			<div class="form-group">
				<label for="sks">SKS</label><br/>
				<input type="number" class="form-control"  name="sks" id="sks" value="<?=$d['sks'];?>" min="1" max="100" required autocomplete="off"/>
			</div>
			<div class="form-group">
				<label for="waktu_mulai">Waktu Mulai</label><br/>
				<input type="time" class="form-control" name="waktu_mulai" id="waktu_mulai" value="<?=$d['waktu_mulai'];?>"/>
			</div>
			<div class="form-group">
				<label for="waktu_selesai">Waktu Selesai</label><br/>
				<input type="time" class="form-control" name="waktu_selesai" id="waktu_selesai" value="<?=$d['waktu_selesai'];?>"/>
			</div>
			<div class="form-group">
				<label for="kelas">Kelas</label><br/>
				<select class="form-control" name="kelas" id="kelas">
					<option value="FT-1" <?php $nilai_database=$d['kelas']; if ($nilai_database=="FT-1") echo 'selected'?>>FT-1</option>
					<option value="FT-2" <?php $nilai_database=$d['kelas']; if ($nilai_database=="FT-2") echo 'selected'?>>FT-2</option>
					<option value="FT-3" <?php $nilai_database=$d['kelas']; if ($nilai_database=="FT-3") echo 'selected'?>>FT-3</option>
					<option value="FT-4" <?php $nilai_database=$d['kelas']; if ($nilai_database=="FT-4") echo 'selected'?>>FT-4</option>
				</select>
			</div>			
			
			<button type="submit" name="submit" class="btn btn-primary">Edi Data</button>
			<a href="?menu=jadwal" class="btn btn-info">Kembali</a>
		</form>
	</div>
</div> <!-- end row -->
<?php 
if(isset($_POST['submit'])){ //jika tombol submit di klik
	//ambil data dari form input
	$id=$_POST['id'];
	$hari=mysqli_real_escape_string($koneksi, $_POST['hari']); //mengabaikan tanda petik
	$matakuliah=htmlspecialchars($_POST['matakuliah']); //mengabaikan tag html;
	$sks=$_POST['sks'];
	$waktu1=$_POST['waktu_mulai'];
	$waktu2=$_POST['waktu_selesai'];
	$kelas=$_POST['kelas'];
	$query=mysqli_query($koneksi, "UPDATE tbl_jadwal SET 
	hari='$hari', matakuliah='$matakuliah', sks='$sks', waktu_mulai='$waktu1', waktu_selesai='$waktu2', kelas='$kelas'
	WHERE id_jadwal='$id' ");
	$sukses=mysqli_affected_rows($koneksi);
	if($sukses > 0){
		echo "<script>alert('Data Berhasil di UBAH');
			window.location.href='?menu=jadwal';
		</script>";
	}else{
		echo "<script>alert('Data GAGAL di UBAH');
			window.location.href='?menu=jadwal';
		</script>"; 
	}
}
break;

case "hapus":
  $query=mysqli_query($koneksi,"select id_jadwal from tbl_jadwal where id_jadwal='$_GET[id]'");
  $cek=mysqli_num_rows($query);
  if($cek == 0){
	echo "<script>alert('Hapus Data Gagal, Data Tidak Ditemukan');
      window.location=('?menu=jadwal')</script>";
  }else{
	$hapus=mysqli_query($koneksi,"DELETE FROM tbl_jadwal WHERE id_jadwal='$_GET[id]'");
	if($hapus){
      echo "<script>
      window.location=('?menu=jadwal')</script>";
    }else{
      echo "<script>alert('Hapus Data Gagal');
      window.location=('?menu=jadwal')</script>";
    }
  } 
break;
}