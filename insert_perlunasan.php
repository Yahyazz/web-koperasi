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

$no_pelunasan = "";
$id_anggota     = "";
$kode_jaminan     = "";
$jumlah_pelunasan ="";
$tgl_pelunasan ="";
$status= "";
$op="";

$gagal ="";
$sukses="";

if(isset($_POST['simpan'])){
    
    
    $no_pelunasan= $_POST['no_pelunasan'];
    $id_anggota= $_POST['id_anggota'];
    $kode_jaminan= $_POST['kode_jaminan'];
    $jumlah_pelunasan =$_POST['jumlah_pelunasan'];
    $tgl_pelunasan=$_POST['tgl_pelunasan'];
    $status= $_POST['status'];
    
    

    if($no_pelunasan && $id_anggota && $kode_jaminan &&  $jumlah_pelunasan && $tgl_pelunasan && $status){
        $sql1 = "insert into koperasi_web.pelunasan(no_pelunasan,id_anggota,kode_jaminan,jumlah_pelunasan,tgl_pelunasan,status) values ('$no_pelunasan','$id_anggota','$kode_jaminan',$jumlah_pelunasan,'$tgl_pelunasan','$status')";
        $q1   = mysqli_query($koneksi,$sql1);

        if ($q1) {
            $sukses = "Selamat Kamu Berhasil Melakukan Perlunasan dengan Nomor Pelunasan $no_pelunasan";
        }else {
            $gagal  = "Gagal Memasukan Data";
        }
    }else {
        $gagal = "Silakan memasukan semua data";
    }
}
if($op == 'delete'){
    $id = $_GET['id_anggota'];
    $sql2 = "delete from koperasi_web.angsur where koperasi_web.angsur.id_anggota = '$id'";
    $q2 = mysqli_query($koneksi,$sql1);
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
          <h2 class="fs-2 m-0">Dashboard Perlunasan</h2>
        </div>
      </nav>
      <div class="container-fluid px-4">
      <div class="mx-auto">
        <!-- input data -->
    <div class="card">
        <div class="card-header">
            Melukakan Perlunasan
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
                    <label for="no_pelunasan" class="col-sm-2 col-form-label">NO Pelunasan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "kode_pinjaman" name="no_pelunasan"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="id_anggota" class="col-sm-2 col-form-label">ID Anggota</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "id_anggota" name="id_anggota"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kode_jaminan" class="col-sm-2 col-form-label">Kode Jaminan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "kode_jaminan" name= "kode_jaminan"  >
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="jumlah_pelunasan" class="col-sm-2 col-form-label">Jumlah Pelunasan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "jumlah_pelunasan" name="jumlah_pelunasan"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tgl_pelunasan" class="col-sm-2 col-form-label">Tanggal Pelunasan</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id = "angsuran_ke" name="tgl_pelunasan"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "status" name= "status"  >
                    </div>
                </div>
                <div class="row d-flex justify-content-between">
                    <div class="col-12 d-flex justify-content-end justify-content-between">
                        <a href="admin.html"><button type="button" class="btn btn-outline-dark">Kembali</button></a>
                        <a href="tampil_data_pinjamananggota.php?op=delete&id_anggota=<?php echo $id_anggota ?>"><input type="submit" name="simpan" value="Perlunasan" class="btn btn-primary"></a>
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
