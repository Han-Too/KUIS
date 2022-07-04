<?php
    $conn = mysqli_connect("localhost", "root","","farhan");
    error_reporting(0);
    

    if(isset($_POST['submit'])){

    $kode = $_POST['kdbuku'];
    $nama = $_POST['namapinjam'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['tanggal'];

    $query = "INSERT INTO tbl_farhan VALUES ('$kode','$nama','$jumlah','$harga')";
    mysqli_query($conn,$query);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>input form</title>
    </head>
    <body bgcolor="#afeeee">
<center>
    <h1>INPUT DATA PEMINJAM</h1>
        
        <form action="" method="post">
            <label>Cari</label><br>
            <input type="text" name="key"><br>
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
            <td><label for="">Kode Buku</label></td>
            <td>
                <select name="kdbuku">
                    <option value="SOS010">SOS010</option>
                    <option value="SOS112">SOS112</option>
                    <option value="MAT270">MAT270</option>
                    <option value="MAT711">MAT711</option>
                    <option value="IPA146">IPA146</option>
                    <option value="IPA102">IPA102</option>
                </select>
                <br>
            </td>
            </tr>
            <tr>
            <td><label for="">Nama Peminjam</label></td>
            <td><input type="text" name="namapinjam"><br></td>
            </tr><tr>
            <td><label for="">Jumlah</label></td>
            <td><input type="text" name="jumlah"><br></td>
            </tr><tr>
            <td><label for="">Tanggal Pinjam</label></td>
            <td><input type="date" name="tanggal"><br></td>
            </tr><tr>
            <td colspan="2" align="center"><input type="submit" name="submit" value="KIRIM"></td></tr>
            </table>
        </form>
  
        <h1>Data Peminjaman Buku</h1>
        <?php $i = 1 ?>
        <table border="1" cellspacing="0" cellpadding="2">
            <tr>
                <th>No</th>
                <th>Kode Buku</th>
                <th>Nomor Urut</th>
                <th>Nama Peminjam</th>
                <th>Jumlah</th>
                <th>Jenis Buku</th>
                <th>Harga Sewa</th>
                <th>Potongan</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
            <?php 
if(isset($_POST["key"])){ 
    $cari = $_POST["key"];
    $view = mysqli_query($conn,"SELECT * FROM tbl_farhan WHERE kdbuku LIKE '%".$cari."%' OR nama_peminjam LIKE '%".$cari."%' OR jumlah LIKE '%".$cari."%' ");
}
else { 
    $view = mysqli_query($conn,"SELECT * FROM tbl_farhan ORDER BY kdbuku ASC");
}
    while($v = mysqli_fetch_array($view))
       {    
    if($v['kdbuku'] == 'SOS010' || $v['kdbuku'] == 'SOS112'){
        $new = $v['kdbuku'];
        $kode = substr($new,0,3);
            $jenis = "Sosial";
            $harga = 12000;
            $x = $v['jumlah'] * $harga;
            
            if($x >= 75000){
            $y = $x * 0.3;
            }
        else if($x >= 50000 && $x <75000){
            $y = $x * 0.15;
        } 
        $total = $x - $y;
    } else if($v['kdbuku'] == 'MAT711' || $v['kdbuku'] == 'MAT270'){
        $new = $v['kdbuku'];
        $kode = substr($new,0,3);
        $jenis = "Matematika";    
        $harga = 15000;
            $x = $v['jumlah'] * $harga;
            
        if($x >= 75000){
            $y = $x * 0.3;
        }
         else if($x >= 50000 && $x <75000){
            $y = $x * 0.15;
        }
        $total = $x - $y;
    } else if($v['kdbuku'] == 'IPA146' || $v['kdbuku'] == 'IPA102'){
        $new = $v['kdbuku'];
        $kode = substr($new,0,3);
        $jenis = "Pengetahuan Alam";    
        $harga = 17500;
            $x = $v['jumlah'] * $harga;   
        if($x >= 75000){
            $y = $x * 0.3;
        }
        else if($x >= 50000 && $x <75000){
            $y = $x * 0.15;
        }
        $total = $x - $y;
        }
        $totalharga += $total;
        $totaldiskon += $y;
        ?>
            
            <tr>
                <th><?=$i?></th>
                <th><?=$v['kdbuku'] ?></th>
                <th><?=$kode ?></th>
                <th><?=$v['nama_peminjam'] ?></th>
                <th><?=$v['jumlah'] ?></th>
                <th><?=$jenis?></th>
                <th><?=$x?></th>
                <th><?=$y?></th>
                <th><?=$total?></th>
                <th><?=$v['tgl_pinjam'] ?></th>
                <th>
                    <a href="hapus.php?kdbuku=<?=$v['kdbuku'] ?>">Hapus</a>
                </th>
            </tr>
            <?php $i++; }    ?>
                </table>
                <br>
                <table>
                <th>Total Diskon = <?=$totaldiskon ?> | </th>
                <th>Total Harga Sewa = <?=$totalharga ?></th>
                </table>
              </body>
              </center>
</html>