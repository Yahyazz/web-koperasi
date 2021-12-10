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
                $sukses = "Berhasil update data";
            } else {
                $gagal = "Gagal update data";
            }
        } else {
            $sql1 = "insert into koperasi_web.anggota(id_anggota,nama,jenis_kelamin,alamat,tanggungan) values ('$id_anggota','$nama','$jenis_kelamin','$alamat','$tanggungan')";
            $q1   = mysqli_query($koneksi,$sql1);

            if ($q1) {
                $sukses = "Berhasil Memasukan Data Baru";
            }else {
                $gagal  = "Gagal Memasukan Data";
            }
        }
    }else {
        $gagal = "Silakan memasukan semua data";
    }
}
?>
 
<html>
<head>    
    <title>Input data anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .mx-auto{
            width : 1250px;
        }
        .card{
            margin-top : 50px;
        }
        .col-123{
            position: absolute;
            top : -45px;
            left : 1150px;
        }
    </style>
</head>
 
<body>

<div class="mx-auto">
        <!-- input data -->
    <div class="card">
        <div class="card-header">
            Create / Edit Data
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
                header("refresh:5;url=insert_anggota_koperasi.php");
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
                header("refresh:5;url=insert_anggota_koperasi.php");
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
                <div class="col-12">
                    <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                </div>
                <div class="col-123">
                <a href="index.html"><button type="button" class="btn btn-outline-dark">HOME</button></a>
                </div>
                
            </form>
        </div>
    </div>
</div>
</body>
</html>