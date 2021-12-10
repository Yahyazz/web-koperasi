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



$id_anggota        = "";
$nama         = "";
$jenis_kelamin= "";
$alamat   = "";
$tanggungan = "";

$gagal ="";
$sukses="";

if(isset($_POST['simpan'])){
    $id_anggota= $_POST['id_anggota'];
    $nama= $_POST['nama'];
    $jenis_kelamin= $_POST['jenis_kelamin'];
    $alamat= $_POST['alamat'];
    $tanggungan= $_POST['tanggungan'];
    

    if($id_anggota && $nama && $jenis_kelamin && $alamat && $tanggungan){
        $sql1 = "insert into koperasi_web.anggota(id_anggota,nama,jenis_kelamin,alamat,tanggungan) values ('$id_anggota','$nama','$jenis_kelamin','$alamat','$tanggungan')";
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
                    <label for="id_anggota" class="col-sm-2 col-form-label">ID Anggota</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "id_anggota" name="id_anggota"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "nama" name= "nama"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "jenis_kelamin" name="jenis_kelamin"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "alamat" name="alamat"  >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggungan" class="col-sm-2 col-form-label">Jumlah Tanggungan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id = "tanggungan" name= "tanggungan"  >
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