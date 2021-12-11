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

?>
 
<html>
<head>    
    <title>Tampil data anggota</title>
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
            Data Pinjaman Anggota Koperasi
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
                            <th scope="col">Kode Pinjaman</th>
                            <th scope="col">Besar Pinjaman</th>
                            <th scope="col">Jumlah Angsuran</th>
                            <th scope="col">Petugas Yang Melayani</th>
                            

                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql2  = "select anggota.id_anggota, anggota.nama, anggota.jenis_kelamin, anggota.alamat, anggota.tanggungan, pinjaman.kode_pinjaman, pinjaman.besar_pinjaman, pinjaman.lama_angsuran, petugas.nama_ptgs from anggota inner join pinjaman ON anggota.id_anggota = pinjaman.id_anggota inner join petugas ON pinjaman.id_petugas = petugas.id_petugas"; 
                            $q2    = mysqli_query($koneksi,$sql2);

                            while ($r2 = mysqli_fetch_array($q2)){
                                $id_anggota     =$r2['id_anggota'];
                                $nama           =$r2['nama'];
                                $jenis_kelamin  =$r2['jenis_kelamin'];
                                $alamat         =$r2['alamat'];
                                $tanggungan      =$r2['tanggungan'];
                                $kode_pinjaman   =$r2['kode_pinjaman'];
                                $besar_pinjaman  =$r2['besar_pinjaman'];
                                $lama_angsuran   =$r2['lama_angsuran'];
                                $nama_ptgs =$r2['nama_ptgs'];


                                ?>
                                    <tr>
                                        <td scope="row"><?php echo $id_anggota ?></td>
                                        <td scope="row"><?php echo $nama ?></td>
                                        <td scope="row"><?php echo $jenis_kelamin ?></td>
                                        <td scope="row"><?php echo $alamat ?></td>
                                        <td scope="row"><?php echo $tanggungan ?></td>
                                        <td scope="row"><?php echo $kode_pinjaman ?></td>
                                        <td scope="row"><?php echo $besar_pinjaman ?></td>
                                        <td scope="row"><?php echo $lama_angsuran ?></td>
                                        <td scope="row"><?php echo $nama_ptgs ?></td>
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