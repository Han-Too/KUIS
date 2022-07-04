<?php
    $conn = mysqli_connect("localhost", "root","","KUIS");

    $view = mysqli_query($conn,"SELECT * FROM tbl_ikan");
    $view2 = mysqli_query($conn,"SELECT COUNT(kd_ikan) FROM tblM tbl_ikan");
    

if(isset($_POST["cari"])){
    $conn = mysqli_connect("localhost", "root","","KUIS");

    $cari = $_POST["cari"];

    $kueri = mysqli_query($conn,"SELECT * FROM tbl_ikan WHERE cari LIKE '%$cari%'");

}

    if(isset($_POST['submit'])){
    $conn = mysqli_connect("localhost", "root","","KUIS");

    $kode = $_POST['kdikan'];
    $nama = $_POST['namaikan'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['hargasatuan'];

    $query = "INSERT INTO tbl_ikan VALUES ('$kode','$nama','$jumlah','$harga')";
    mysqli_query($conn,$query);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>input form</title>
    </head>
    <body bgcolor="#afeeee">
        <h1>INPUT DATA IKAN</h1>
        
        <form action="" method="post">
            <label>Cari</label>
            <input type="text" name="key">
            <input type="submit" name="cari" value="CARI"><br><br><br>
        </form>
    <table border="1">
        
    </table>
        <form action="" method="post">
            <label for="">Kode Ikan</label>
            <input type="text" name="kdikan"><br>
            <label for="">Nama Ikan</label>
            <input type="text" name="namaikan"><br>
            <label for="">Jumlah</label>
            <input type="text" name="jumlah"><br>
            <label for="">Harga Satuan</label>
            <input type="text" name="hargasatuan"><br>
            <input type="submit" name="submit" value="KIRIM">
        </form>
  
        <h1>Data IKAN</h1>
        <table border="1" cellspacing="0" cellpadding="2">
            <tr>
                <th>Kode Ikan</th>
                <th>Nama Ikan</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
                <th>Diskon</th>
                <th>Harga Bersih</th>
            </tr>
            <?php 
                foreach($view as $v):
                    $kaliharga = $v['jumlah']*$v['harga_satuan'];
    if($kaliharga >= 60000){
        $dis = 0.6;
        $x = $dis*$kaliharga;
        $totalharga = $kaliharga - $x; 

    } else if($kaliharga >= 40000){
        $dis = 0.4;
        $x = $dis*$kaliharga;
        $totalharga = $kaliharga - $x; 

    }
    else{
        $dis = 1;
        $x = $dis*$kaliharga;
        $totalharga = $kaliharga - $x; 

    }


            ?>
            
            <tr>
                <th><?=$v['kd_ikan'] ?></th>
                <th><?=$v['nama_ikan'] ?></th>
                <th><?=$v['jumlah'] ?></th>
                <th><?=$v['harga_satuan'] ?></th>
                <th><?=$kaliharga ?></th>
                <th><?=$x ?></th>
                <th><?=$totalharga ?></th>
            </tr>
            <?php
endforeach; ?>
                </table>
              </body>
</html>