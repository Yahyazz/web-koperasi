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
                    <label for="status" class="col-sm-2 col-form-label">status</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "status" name= "status"  >
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