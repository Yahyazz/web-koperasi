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
$op = "";
$id_anggota        = "";
$nama         = "";
$jenis_kelamin= "";
$alamat   = "";
$tanggungan = "";

$gagal ="";
$sukses="";

if(isset($_GET['op'])){
    $op = $_GET['op'];
} else {
    $op = "";
}

if($op == 'edit'){
    $id = $_GET['id_anggota'];
    $sql1 = "select * from koperasi_web.anggota where koperasi_web.anggota.id_anggota = '$id'";
    $q1 = mysqli_query($koneksi,$sql1);
    $r1 = mysqli_fetch_array($q1);
    $id_anggota = $r1['id_anggota'];
    $nama = $r1['nama'];
    $jenis_kelamin = $r1['jenis_kelamin'];
    $alamat = $r1['alamat'];
    $tanggungan = $r1['tanggungan'];

    if($id_anggota == ''){
        $gagal = "Data tidak ditemukan";
    } else {
        $sukses = "Anda akan memperbarui data untuk id anggota = $id_anggota
        <br/>
        Dengan rincian
        <br/>
        Nama = $nama
        <br/>
        Jenis Kelamin = $jenis_kelamin
        <br/>
        Alamat = $alamat
        <br/>
        Tanggunan = $tanggungan
        <br/>
        <br/>
        Note : Tulis ulang id_anggota, karena id_anggota tidak boleh diubah.";
    }
}

if(isset($_POST['simpan'])){
    $id_anggota= $_POST['id_anggota'];
    $nama= $_POST['nama'];
    $jenis_kelamin= $_POST['jenis_kelamin'];
    $alamat= $_POST['alamat'];
    $tanggungan= $_POST['tanggungan'];
    

    if($id_anggota && $nama && $jenis_kelamin && $alamat && $tanggungan){
        if($op == 'edit'){
            $sql1 = "update koperasi_web.anggota set id_anggota = '$id_anggota',nama = '$nama', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat', tanggungan = '$tanggungan' where koperasi_web.anggota.id_anggota = '$id_anggota'";
            $q1 = mysqli_query($koneksi,$sql1);
            if($q1){
                $sukses = "Selamat $nama, Data Kamu Berhasil di Update";
            } else {
                $gagal = "Gagal Update Data";
            }
        } else {
            $sql1 = "insert into koperasi_web.anggota(id_anggota,nama,jenis_kelamin,alamat,tanggungan) values ('$id_anggota','$nama','$jenis_kelamin','$alamat','$tanggungan')";
            $q1   = mysqli_query($koneksi,$sql1);

            if ($q1) {
                $sukses = "Selamat $nama, Kamu Berhasil Terdaftar sebagai Anggota Baru";
            }else {
                $gagal  = "Gagal Memasukan Data";
            }
        }
    }else {
        $gagal = "Silakan memasukan semua data terlebih dahulu";
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
          <h2 class="fs-2 m-0">Dashboard Anggota</h2>
        </div>
      </nav>
      <div class="container-fluid px-4">
      <div class="mx-auto">
        <!-- input data -->
    <div class="card">
        <div class="card-header">
            Daftar Anggota Baru
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
                        <input type="text" class="form-control" id="id_anggota" name="id_anggota">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggungan" class="col-sm-2 col-form-label">Jumlah Tanggungan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tanggungan" name="tanggungan">
                    </div>
                </div>
                <div class="row d-flex justify-content-between">
                    <div class="col-12 d-flex justify-content-end justify-content-between">
                        <a href="index.html"><button type="button" class="btn btn-outline-dark">Kembali</button></a>
                        <input type="submit" name="simpan" value="Daftar" class="btn btn-primary">
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