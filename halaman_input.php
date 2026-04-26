<?php include("inc_header.php")?>
<?php
$judul    = "";
$kutipan  = "";
$isi      = "";
$error    = "";
$sukses   = "";

if(isset($_POST["simpan"])){
    $judul   = $_POST['judul'];
    $isi     = $_POST['isi'];
    $kutipan = $_POST['kutipan'];

    if($judul == '' or $isi == ''){
        $error = 'Silahkan masukkan data (judul dan isi wajib diisi)';
    }

    // Perbaikan Logika: Proses insert harus di dalam block isset($_POST["simpan"])
    if(empty($error)){
        // Perbaikan: Hapus tanda kutip satu pada nama kolom, dan tambahkan kutip satu pada values
        $sql1   = "insert into halaman (judul, kutipan, isi) values ('$judul', '$kutipan', '$isi')";
        $q1     = mysqli_query($koneksi, $sql1);
        
        if($q1){
            $sukses = "Data sukses dimasukkan";
            // Bersihkan variabel agar form kosong kembali setelah sukses
            $judul = $kutipan = $isi = "";
        } else {
            $error  = "Data gagal dimasukkan: " . mysqli_error($koneksi);
        }
    }
}
?>

<h1>Halaman Admin Input Data</h1>
<div class="mb-3 row">
    <a href="halaman.php">Kembali Ke Halaman Admin</a>
</div>

<?php if($error): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error; // Gunakan echo untuk menampilkan isi variabel ?>
    </div>
<?php endif; ?>

<?php if($sukses): ?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses; ?>
    </div>
<?php endif; ?>

<form action="" method="post">
    <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" class="form-control" id="judul" value="<?php echo $judul ?>" name="judul">
    </div>

    <div class="mb-3">
        <label for="kutipan" class="form-label">Kutipan</label>
        <input type="text" class="form-control" id="kutipan" value="<?php echo $kutipan ?>" name="kutipan">
    </div>

    <div class="mb-3">
        <label for="isi" class="form-label">Isi</label>
        <textarea name="isi" class="form-control" id="summernote"><?php echo $isi ?></textarea>
    </div>

    <div class="mb-3">
        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary"/>
    </div>
</form>

<?php include("inc_footer.php")?>