<?php
    $conn = mysqli_connect("localhost", "root","","KUIS");

    
    $view2 = mysqli_query($conn,"SELECT COUNT(kd_ikan) FROM tbl_ikan");
  

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
           <?php
            if(isset($_POST["key"])){
    $cari = $_POST["key"];
    echo "<b>Hasil pencarian : ".$cari."</b>";
}?>
        </form>
    <table border="1">
        
    </table>
        <form action="" method="post">
            <table>
                <tr>
            <td><label for="">Kode Ikan</label></td>
            <td><input type="text" name="kdikan"><br></td>
            </tr>
            <tr>
            <td><label for="">Nama Ikan</label></td>
            <td><input type="text" name="namaikan"><br></td>
            </tr><tr>
            <td><label for="">Jumlah</label></td>
            <td><input type="text" name="jumlah"><br></td>
            </tr><tr>
            <td><label for="">Harga Satuan</label></td>
            <td><input type="text" name="hargasatuan"><br></td>
            </tr><tr>
            <td colspan="2" align="center"><input type="submit" name="submit" value="KIRIM"></td></tr>
            </table>
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
                <th>Aksi</th>
            </tr>
            <?php 
if(isset($_POST["key"])){ 
    $cari = $_POST["key"];
    $view = mysqli_query($conn,"SELECT * FROM tbl_ikan WHERE kd_ikan LIKE '%".$cari."%' OR nama_ikan LIKE '%".$cari."%' OR jumlah LIKE '%".$cari."%' ");
}
else { 
    $view = mysqli_query($conn,"SELECT * FROM tbl_ikan");
}
    while($v = mysqli_fetch_array($view)){
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
                <th>
                    <a href="edit.php?kd_ikan=<?=$v['kd_ikan'] ?>">Edit</a> | 
                    <a href="hapus.php?kd_ikan=<?=$v['kd_ikan'] ?>">Hapus</a>
                </th>
            </tr>
            <?php
}    ?>
                </table>
              </body>
</html>