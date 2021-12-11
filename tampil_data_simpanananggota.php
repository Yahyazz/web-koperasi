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
    <title>Tampil data Simpanan anggota</title>
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

    <div class="card">
        <div class="card-header text-white bg-secondary">
            Data Anggota Koperasi
        </div>
        <div class="card-body">
                <table class ="table">
                    <thead>
                        <tr>
                            <th scope="col">ID Anggota</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Tanggungan</th>
                            <th scope="col">Kode Simpanan</th>
                            <th scope="col">Tanggal Menyimpan</th>
                            <th scope="col">Jumlah</th>

                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql2  = "select anggota.id_anggota, anggota.nama, anggota.jenis_kelamin, anggota.alamat, anggota.tanggungan, menyimpan.kode_simpanan, menyimpan.tanggal, menyimpan.jumlah from anggota inner join menyimpan ON anggota.id_anggota = menyimpan.id_anggota"; 
                            $q2    = mysqli_query($koneksi,$sql2);

                            while ($r2 = mysqli_fetch_array($q2)){
                                $id_anggota     =$r2['id_anggota'];
                                $nama           =$r2['nama'];
                                $jenis_kelamin  =$r2['jenis_kelamin'];
                                $alamat         =$r2['alamat'];
                                $tanggungan      =$r2['tanggungan'];
                                $kode_simpanan   =$r2['kode_simpanan'];
                                $tanggal          =$r2['tanggal'];
                                $jumlah            =$r2['jumlah'];


                                ?>
                                    <tr>
                                        <td scope="row"><?php echo $id_anggota ?></td>
                                        <td scope="row"><?php echo $nama ?></td>
                                        <td scope="row"><?php echo $jenis_kelamin ?></td>
                                        <td scope="row"><?php echo $alamat ?></td>
                                        <td scope="row"><?php echo $tanggungan ?></td>
                                        <td scope="row"><?php echo $kode_simpanan ?></td>
                                        <td scope="row"><?php echo $tanggal ?></td>
                                        <td scope="row"><?php echo $jumlah ?></td>
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