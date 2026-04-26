<?php include("inc_header.php") ?>
<?php
// Mengambil kata kunci dari URL jika ada
$katakunci = (isset($_GET['katakunci'])) ? $_GET['katakunci'] : "";
?>

<h1>Halaman Admin</h1>
<p>
  <a href="halaman_input.php">
    <input type="button" class="btn btn-primary" value="Buat Halaman Baru">
  </a>
</p>

<form class="row g-3" method="get">
  <div class="col-auto">
    <input type="text" class="form-control" placeholder="masukan kata kunci" name="katakunci"
      value="<?php echo htmlspecialchars($katakunci) ?>" />
  </div>
  <div class="col-auto">
    <input type="submit" name="cari" value="Cari Tulisan" class="btn btn-secondary">
  </div>
</form>

<table class="table table-striped">
  <thead>
    <tr>
      <th class="col-1">#</th>
      <th>Judul</th>
      <th>Kutipan</th>
      <th class="col-2">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Logika Pencarian
    $sqltambahan = "";
    if ($katakunci != "") {
        $array_katakunci = explode(" ", $katakunci);
        $sql_cari = array();
        for ($x = 0; $x < count($array_katakunci); $x++) {
            $sql_cari[] = "(judul LIKE '%" . $array_katakunci[$x] . "%' OR kutipan LIKE '%" . $array_katakunci[$x] . "%' OR isi LIKE '%" . $array_katakunci[$x] . "%')";
        }
        $sqltambahan = " WHERE " . implode(" OR ", $sql_cari);
    }

    // Query ke Database
    $sql = "SELECT * FROM halaman $sqltambahan ORDER BY id DESC";
    $q   = mysqli_query($koneksi, $sql);
    $nomor = 1;

    while ($r1 = mysqli_fetch_array($q)) {
    ?>
      <tr>
        <td><?php echo $nomor++ ?></td>
        <td><?php echo $r1['judul'] ?></td>
        <td><?php echo $r1['kutipan'] ?></td>
        <td>
          <a href="halaman_input.php?id=<?php echo $r1['id']?>">
             <button type="button" class="btn btn-warning btn-sm">Edit</button>
          </a>
          <button type="button" class="btn btn-danger btn-sm">Hapus</button>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>

<?php include("inc_footer.php") ?>