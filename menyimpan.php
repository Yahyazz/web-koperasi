<?php
// Create database connection using config file

$host = "localhost";
$user = "root";
$pass = "";
$db = "koperasi_web";
 
$koneksi = mysqli_connect($host,$user,$pass,$db);

if (!$koneksi){
    die ("tidak bisa koneksi");
}


$id = "";
$id_anggota= "";
$kode_simpanan         = "";
$tanggal               = "";
$jumlah            = "";

$gagal ="";
$sukses="";

if(isset($_GET['op'])){
    $op = $_GET['op'];
} else {
    $op = "";
}

if($op == 'edit'){
    $id = $_GET['id_anggota'];
    $sql1 = "select * from koperasi_web.menyimpan where koperasi_web.menyimpan.id_anggota = '$id'";
    $q1 = mysqli_query($koneksi,$sql1);
    $r1 = mysqli_fetch_array($q1);
    $id_anggota = $r1['id_anggota'];
    $kode_simpanan= $r1['kode_simpanan'];
    $tanggal= $r1['tanggal'];
    $jumlah= $r1['jumlah'];

    if($id_anggota == ''){
        $gagal = "Data tidak ditemukan";
    } else {
        $sukses = "Anda akan memperbarui data untuk id anggota = $id_anggota
        <br/>
        Dengan rincian
        <br/>
        Kode simpanan = $kode_simpanan
        <br/>
        tanggal = $tanggal
        <br/>
        Jumlah = $jumlah
        <br/>
        <br/>
        Note : Tulis ulang id_anggota, karena id_anggota tidak boleh diubah.";
    }
}

if(isset($_POST['simpan'])){
    $id_anggota= $_POST['id_anggota'];
    $kode_simpanan= $_POST['kode_simpanan'];
    $tanggal= $_POST['tanggal'];
    $jumlah= $_POST['jumlah'];
    

    if($id_anggota && $kode_simpanan && $tanggal && $jumlah){
        if($op == 'edit'){
            $sql1 = "update koperasi_web.menyimpan set id_anggota = '$id_anggota',kode_simpanan = '$kode_simpanan', tanggal = '$tanggal', jumlah = '$jumlah' where koperasi_web.menyimpan.id_anggota = '$id_anggota'";
            $q1 = mysqli_query($koneksi,$sql1);
            if($q1){
                $sukses = "Data $kode_simpanan Berhasil Di Update";
            } else {
                $gagal = "Gagal Update Data";
            }
        } else {
            $sql1 = "insert into koperasi_web.menyimpan(id_anggota,kode_simpanan,tanggal,jumlah) values ('$id_anggota','$kode_simpanan','$tanggal','$jumlah')";
            $q1   = mysqli_query($koneksi,$sql1);

            if ($q1) {
                $sukses = "Selamat Kamu Berhasil Melakukan Simpanan dengan Kode Simpanan $kode_simpanan";
            }else {
                $gagal  = "Gagal Memasukan Data";
            }
        }
    }else {
        $gagal = "Silakan memasukan semua data";
    }
}
?>
 
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css" />
  <title>KOPERASI SIMPAN PINJAM ALAMI</title>
</head>

<body>
  <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-white" id="sidebar-wrapper">
      <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
          class="fas fa-hand-holding-usd me-2"></i>KSP Alami</div>
      <div class="list-group list-group-flush my-3">
        <a href="index.html" class="list-group-item list-group-item-action bg-transparent second-text active"><i
            class="fas fa-tachometer-alt me-2"></i>User</a>
        <a href="admin.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
            class="fas fa-project-diagram me-2"></i>Admin</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
          <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
          <h2 class="fs-2 m-0">Dashboard Simpanan</h2>
        </div>
      </nav>
      <div class="container-fluid px-4">
      <div class="mx-auto">
        <!-- input data -->
        <div class="card">
        <div class="card-header">
            Mengajukan Simpanan
        </div>
        <div class="card-body">
            
            <form action="" method="post">
            <?php
                if ($gagal) {
            ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                        echo $gagal;
                    ?>
                </div>
            <?php   
                }
            ?>
            <?php
                if ($sukses) {
            ?>
                <div class="alert alert-success" role="alert">
                    <?php
                        echo $sukses;
                    ?>
                </div>
            <?php      
                }
            ?>
                
                <div class="mb-3 row">
                    <label for="id_anggota" class="col-sm-2 col-form-label">ID Anggota</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "id_anggota" name="id_anggota"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kode_simpanan" class="col-sm-2 col-form-label">Kode Simpanan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "kode_simpanan" name= "kode_simpanan"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id = "tanggal" name="tanggal"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jumlah" class="col-sm-2 col-form-label">Jumlah Simpanan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "jumlah" name="jumlah"  >
                    </div>
                </div>
                <div class="row d-flex justify-content-between">
                    <div class="col-12 d-flex justify-content-end justify-content-between">
                        <a href="index.html"><button type="button" class="btn btn-outline-dark">Kembali</button></a>
                        <input type="submit" name="simpan" value="Ajukan Simpanan" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
      </div>
    </div>
  </div>
  </div>
  <!-- /#page-content-wrapper -->
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
      el.classList.toggle("toggled");
    };
  </script>
</body>

</html>