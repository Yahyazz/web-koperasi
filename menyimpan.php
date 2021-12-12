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
                $sukses = "Berhasil update data";
            } else {
                $gagal = "Gagal update data";
            }
        } else {
            $sql1 = "insert into koperasi_web.menyimpan(id_anggota,kode_simpanan,tanggal,jumlah) values ('$id_anggota','$kode_simpanan','$tanggal','$jumlah')";
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
                
                <div class="col-12">
                    <input type="submit" name ="simpan" value="Simpan Data" class="btn btn-primary">
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




