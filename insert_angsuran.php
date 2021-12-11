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

$kode_pinjaman = "";
$id_anggota        = "";
$id_petugas        = "";
$tanggal_pembayaran ="";
$angsuran_ke ="";
$jumlah= "";


$gagal ="";
$sukses="";

if(isset($_POST['simpan'])){
    
    
    $kode_pinjaman= $_POST['kode_pinjaman'];
    $id_anggota= $_POST['id_anggota'];
    $id_petugas= $_POST['id_petugas'];
    $tanggal_pembayaran =$_POST['tanggal_pembayaran'];
    $angsuran_ke=$_POST['angsuran_ke'];
    $jumlah= $_POST['jumlah'];
    
    

    if($kode_pinjaman && $id_anggota && $id_petugas &&  $tanggal_pembayaran && $angsuran_ke && $jumlah){
        $sql1 = "insert into koperasi_web.angsur(kode_pinjaman,id_anggota,id_petugas,tanggal_pembayaran,angsuran_ke,jumlah) values ('$kode_pinjaman','$id_anggota','$id_petugas','$tanggal_pembayaran','$angsuran_ke','$jumlah')";
        $q1   = mysqli_query($koneksi,$sql1);

        if ($q1) {
            $sukses = "Berhasil Memasukan Data Baru";
        }else {
            $gagal  = "Gagal Memasukan Data";
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
                    <label for="kode_pinjaman" class="col-sm-2 col-form-label">Kode Pinjaman</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "kode_pinjaman" name="kode_pinjaman"  >
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
                        <input type="text" class="form-control" id = "id_petugas" name= "id_petugas"  >
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="tanggal_pembayaran" class="col-sm-2 col-form-label">Tanggal Pembayaran</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id = "tanggal_pembayaran" name="tanggal_pembayaran"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="angsuran_ke" class="col-sm-2 col-form-label">Angsuran Ke-</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "angsuran_ke" name="angsuran_ke"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jumlah" class="col-sm-2 col-form-label">Jumlah Yang Dibayar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "jumlah" name= "jumlah"  >
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