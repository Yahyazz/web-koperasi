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
                $sukses = "Berhasil update data";
            } else {
                $gagal = "Gagal update data";
            }
        } else {
            $sql1 = "insert into koperasi_web.pinjaman(kode_pinjaman, besar_pinjaman, lama_angsuran, bunga, besar_angsuran, id_anggota, id_petugas, kode_jaminan) values ('$kode_pinjaman','$besar_pinjaman','$lama_angsuran','$bunga','$besar_angsuran','$id_anggota','$id_petugas','$kode_jaminan')";
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