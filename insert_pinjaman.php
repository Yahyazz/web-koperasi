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
$kode_pinjaman        = "";
$besar_pinjaman  = "";
$lama_angsuran = "";
$bunga = "";
$besar_angsuran = "";
$id_anggota="";
$id_petugas ="";
$kode_jaminan ="";

$gagal ="";
$sukses="";

if(isset($_GET['op'])){
    $op = $_GET['op'];
} else {
    $op = "";
}

if($op == 'edit'){
    $id = $_GET['kode_pinjaman'];
    $sql1 = "select * from koperasi_web.pinjaman where koperasi_web.pinjaman.kode_pinjaman = '$id'";
    $q1 = mysqli_query($koneksi,$sql1);
    $r1 = mysqli_fetch_array($q1);
    $kode_pinjaman   =$r1['kode_pinjaman'];
    $besar_pinjaman  =$r1['besar_pinjaman'];
    $lama_angsuran =$r1['lama_angsuran'];
    $bunga =$r1['bunga'];
    $besar_angsuran =$r1['besar_angsuran'];
    $id_anggota=$r1['id_anggota'];
    $id_petugas =$r1['id_petugas'];
    $kode_jaminan =$r1['kode_jaminan'];

    if($kode_pinjaman == ''){
        $gagal = "Data tidak ditemukan";
    } else {
        $sukses = "Anda akan memperbarui data untuk kode pinjaman = $kode_pinjaman
        <br/>
        Besar Pinjaman = $besar_pinjaman
        <br/>
        Lama Angsuran = $lama_angsuran
        <br/>
        Bunga = $bunga
        <br/>
        Besar Angsuran = $besar_angsuran
        <br/>
        ID Anggota = $id_anggota
        <br/>
        ID Petugas = $id_petugas
        <br/>
        Kode Jaminan = $kode_jaminan
        <br/>
        <br/>
        Note : Tulis ulang kode_jaminan, karena kode_jaminan tidak boleh diubah.";
    }
}

if(isset($_POST['simpan'])){
$kode_pinjaman   =$_POST['kode_pinjaman'];
$besar_pinjaman  =$_POST['besar_pinjaman'];
$lama_angsuran =$_POST['lama_angsuran'];
$bunga =$_POST['bunga'];
$besar_angsuran =$_POST['besar_angsuran'];
$id_anggota=$_POST['id_anggota'];
$id_petugas =$_POST['id_petugas'];
$kode_jaminan =$_POST['kode_jaminan'];
    

    if($kode_pinjaman && $besar_pinjaman && $lama_angsuran && $bunga && $besar_angsuran && $id_anggota && $id_petugas && $kode_jaminan ){
        if($op == 'edit'){
            $sql1 = "update koperasi_web.pinjaman set kode_pinjaman = '$kode_pinjaman',besar_pinjaman  = '$besar_pinjaman', lama_angsuran = '$lama_angsuran', bunga = '$bunga', besar_angsuran = '$besar_angsuran', id_anggota= '$id_anggota', id_petugas = '$id_petugas', kode_jaminan = '$kode_jaminan' where koperasi_web.pinjaman.kode_pinjaman = '$kode_pinjaman'";
            $q1 = mysqli_query($koneksi,$sql1);
            if($q1){
                $sukses = "Data $kode_jaminan Berhasil Di Update";
            } else {
                $gagal = "Gagal Update Data";
            }
        } else {
            $sql1 = "insert into koperasi_web.pinjaman(kode_pinjaman, besar_pinjaman, lama_angsuran, bunga, besar_angsuran, id_anggota, id_petugas, kode_jaminan) values ('$kode_pinjaman','$besar_pinjaman','$lama_angsuran','$bunga','$besar_angsuran','$id_anggota','$id_petugas','$kode_jaminan')";
            $q1   = mysqli_query($koneksi,$sql1);
    
            if ($q1) {
                $sukses = "Selamat Kamu Berhasil Melakukan Pinjaman dengan Kode Pinjaman $kode_pinjaman";
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
          <h2 class="fs-2 m-0">Dashboard Pinjaman</h2>
        </div>
      </nav>
      <div class="container-fluid px-4">
      <div class="mx-auto">
        <!-- input data -->
        <div class="card">
        <div class="card-header">
            Mengajukan Pinjaman
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
                    <label for="kode_pinjaman" class="col-sm-2 col-form-label">Kode Pinjaman</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "kode_pinjaman" name= "kode_pinjaman"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="besar_pinjaman" class="col-sm-2 col-form-label">Besar pinjaman</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "besar_pinjaman" name= "besar_pinjaman"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="lama_angsuran" class="col-sm-2 col-form-label">Lama Angsuran</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "lama_angsuran" name= "lama_angsuran"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="bunga" class="col-sm-2 col-form-label">Bunga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "bunga" name= "bunga"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="besar_angsuran" class="col-sm-2 col-form-label">Besar Angsuran</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "besar_angsuran" name= "besar_angsuran"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="id_anggota" class="col-sm-2 col-form-label">ID Anggota</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "id_anggota" name="id_anggota"  >
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="id_petugas" class="col-sm-2 col-form-label">ID Petugas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "id_petugas" name="id_petugas"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kode_jaminan" class="col-sm-2 col-form-label">Kode Jaminan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "kode_jaminan" name="kode_jaminan"  >
                    </div>
                </div>
                <div class="row d-flex justify-content-between">
                    <div class="col-12 d-flex justify-content-end justify-content-between">
                        <a href="index.html"><button type="button" class="btn btn-outline-dark">Kembali</button></a>
                        <input type="submit" name="simpan" value="Ajukan Pinjaman" class="btn btn-primary">
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
