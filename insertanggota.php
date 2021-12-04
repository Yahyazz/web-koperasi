<?php
// Create database connection using config file

$host = "localhost";
$user = "root";
$pass = "";
$db = "koperasi";
 
$koneksi = mysqli_connect($host,$user,$pass,$db);

if (!$koneksi){
    die ("tidak bisa koneksi");
}



$NIK        = "";
$Nm         = "";
$Ttl        = "";
$Jenkel     = "";
$Pekerjaan = "";
$No_telp    = "";
$Lokasi_kerja= "";
$Alamat       = "";
$gagal ="";
$sukses="";

if(isset($_POST['simpan'])){
    $NIK        = $_POST['NIK'];
    $Nm         = $_POST['Nm'];
    $Ttl        = $_POST['Ttl'];
    $Jenkel     = $_POST['Jenkel'];
    $Pekerjaan = $_POST['Pekerjaan'];
    $No_telp    = $_POST['No_telp'];
    $Lokasi_kerja = $_POST['Lokasi_kerja'];
    $Alamat       = $_POST['Alamat'];

    if($NIK && $Nm && $Ttl && $Jenkel && $Pekerjaan && $No_telp && $Lokasi_kerja && $Alamat){
        $sql1 = "insert into tbl_anggota(NIK,Nm,Ttl,Jenkel,Pekerjaan,No_telp,Lokasi_kerja,Alamat) values ('$NIK','$Nm','$Ttl','$Jenkel','$Pekerjaan','$No_telp','$Lokasi_kerja','$Alamat')";
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
                    <label for="NIK" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "NIK" name= "NIK"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="Nm" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "Nm" name="Nm"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="Ttl" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id = "Ttl" name= "Ttl"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="Jenkel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "Jenkel" name="Jenkel"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="Pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "Pekerjaan" name= "Pekerjaan"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="No_telp" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "No_telp" name="No_telp"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="Lokasi_kerja" class="col-sm-2 col-form-label">Lokasi Kerja</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "Lokasi_kerja" name="Lokasi_kerja"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "Alamat" name= "Alamat"  >
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

<!-- mengeluarkan data -->

    <div class="card">
        <div class="card-header text-white bg-secondary">
            Data Anggota
        </div>
        <div class="card-body">
                <table class ="table">
                    <thead>
                        <tr>
                            <th scope="col">NIK</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Pekerjaan</th>
                            <th scope="col">Nomor Telepon</th>
                            <th scope="col">Lokasi Kerja</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql2  = "select * from tbl_anggota"; 
                            $q2    = mysqli_query($koneksi,$sql2);
                        
                            while ($r2 = mysqli_fetch_array($q2)){
                                $NIK            =$r2['NIK'];
                                $Nm             =$r2['Nm'];
                                $Ttl            =$r2['Ttl'];
                                $Jenkel         =$r2['Jenkel'];
                                $Pekerjaan      =$r2['Pekerjaan'];
                                $No_telp        =$r2['No_telp'];
                                $Lokasi_kerja   =$r2['Lokasi_kerja'];
                                $Alamat         =$r2['Alamat'];

                                ?>
                                    <tr>
                                        <td scope="row"><?php echo $NIK ?></td>
                                        <td scope="row"><?php echo $Nm ?></td>
                                        <td scope="row"><?php echo $Ttl ?></td>
                                        <td scope="row"><?php echo $Jenkel ?></td>
                                        <td scope="row"><?php echo $Pekerjaan ?></td>
                                        <td scope="row"><?php echo $No_telp ?></td>
                                        <td scope="row"><?php echo $Lokasi_kerja ?></td>
                                        <td scope="row"><?php echo $Alamat ?></td>
                                        <td scope="row">
                                            <button type="button" class="btn btn-outline-warning">Edit</button>
                                            <button type="button" class="btn btn-outline-danger">Delete</button>
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
</body>
</html>