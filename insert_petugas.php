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
$id_petugas        = "";
$nama_petugas       = "";
$jenis_kelamin     = "";
$bagian            = "";
$gagal              ="";
$sukses             ="";

if(isset($_GET['op'])){
    $op = $_GET['op'];
} else {
    $op = "";
}

if($op == 'edit'){
    $id = $_GET['id_petugas'];
    $sql1 = "select * from koperasi_web.petugas where koperasi_web.petugas.id_petugas = '$id'";
    $q1 = mysqli_query($koneksi,$sql1);
    $r1 = mysqli_fetch_array($q1);
    $id_petugas         = $r1['id_petugas'];
    $nama_petugas       = $r1['nama_petugas'];
    $jenis_kelamin      = $r1['jenis_kelamin'];
    $bagian             = $r1['bagian'];

    if($id_petugas == ''){
        $gagal = "Data tidak ditemukan";
    } else {
        $sukses = "Anda akan memperbarui data untuk id petugas = $id_petugas
        <br/>
        Dengan rincian
        <br/>
        Nama = $nama_petugas
        <br/>
        Jenis Kelamin = $jenis_kelamin
        <br/>
        Bagian = $bagian
        <br/>
        <br/>
        Note : Tulis ulang id_petugas, karena id_petugas tidak boleh diubah.";
    }
}

if($op == 'delete'){
    $id = $_GET['id_petugas'];
    $sql1 = "delete from koperasi_web.petugas where koperasi_web.petugas.id_petugas = '$id'";
    $q1 = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Data $id Berhasil Dihapus";
    } else {
        $gagal = "Gagal Hapus Data";
    }
}

if(isset($_POST['simpan'])){
    $id_petugas         = $_POST['id_petugas'];
    $nama_petugas       = $_POST['nama_petugas'];
    $jenis_kelamin      = $_POST['jenis_kelamin'];
    $bagian             = $_POST['bagian'];
   
    


    if($id_petugas && $nama_petugas && $jenis_kelamin && $bagian){
        if($op == 'edit'){
            $sql1 = "update petugas set id_petugas = '$id_petugas',nama_petugas = '$nama_petugas', jenis_kelamin = '$jenis_kelamin', bagian = '$bagian' where id_petugas = '$id_petugas'";
            $q1 = mysqli_query($koneksi,$sql1);
            if($q1){
                $sukses = "Selamat $nama_petugas, Data Kamu Berhasil di Update";
            } else {
                $gagal = "Gagal Update Data";
            }
        } else {
            $sql1 = "insert into koperasi_web.petugas(id_petugas,nama_petugas,jenis_kelamin,bagian) values ('$id_petugas','$nama_petugas','$jenis_kelamin','$bagian')";
            $q1   = mysqli_query($koneksi,$sql1);
    
            if ($q1) {
                $sukses = "Selamat $nama_petugas, Kamu Berhasil Terdaftar sebagai Petugas";
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
          <h2 class="fs-2 m-0">Dashboard Petugas</h2>
        </div>
      </nav>
      <div class="container-fluid px-4">
      <div class="mx-auto">
        <!-- input data -->
    <div class="card">
        <div class="card-header">
            Daftar Petugas Baru
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
                    <label for="id_petugas" class="col-sm-2 col-form-label">ID Petugas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "id_petugas" name= "id_petugas" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama_petugas" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "nama_petugas" name="nama_petugas"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "jenis_kelamin" name= "jenis_kelamin"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="bagian" class="col-sm-2 col-form-label">Bagian</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "bagian" name="bagian"  >
                    </div>
                </div>
                <div class="row d-flex justify-content-between">
                    <div class="col-12 d-flex justify-content-end justify-content-between">
                        <a href="admin.html"><button type="button" class="btn btn-outline-dark">Kembali</button></a>
                        <input type="submit" name="simpan" value="Daftar" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>

<!-- mengeluarkan data -->

    <div class="card">
        <div class="card-header text-white bg-secondary">
            Data Petugas
        </div>
        <div class="card-body">
                <table class ="table">
                    <thead>
                        <tr>
                            <th scope="col">ID Anggota</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Bagian</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql2  = "select * from koperasi_web.petugas"; 
                            $q2    = mysqli_query($koneksi,$sql2);
                        
                            while ($r2 = mysqli_fetch_array($q2)){
                                $id_petugas                =$r2['id_petugas'];
                                $nama_petugas                      =$r2['nama_petugas'];
                                $jenis_kelamin            =$r2['jenis_kelamin'];
                                $bagian         =$r2['bagian'];
                
                                

                                ?>
                                    <tr>
                                        <td scope="row"><?php echo $id_petugas ?></td>
                                        <td scope="row"><?php echo $nama_petugas ?></td>
                                        <td scope="row"><?php echo $jenis_kelamin ?></td>
                                        <td scope="row"><?php echo $bagian ?></td>
                                       
                                        <td scope="row">
                                            <a href="insert_petugas.php?op=edit&id_petugas=<?php echo $id_petugas ?>"><button type="button" class="btn btn-outline-warning">Edit</button></a>
                                            <a href="insert_petugas.php?op=delete&id_petugas=<?php echo $id_petugas ?>" onclick="return confirm('Apakah Anda yakin akan menghapus data?')"><button type="button" class="btn btn-outline-danger">Delete</button></a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
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