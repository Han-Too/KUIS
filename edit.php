<?php


    $conn = mysqli_connect("localhost", "root","","KUIS");
    $key = $_GET['kd_ikan'];

    $view = mysqli_query($conn,"SELECT * FROM tbl_ikan WHERE kd_ikan='$key'");

    if(isset($_POST['Edit'])){
        $conn = mysqli_connect("localhost", "root","","KUIS");
        $kdikan = $_POST['kdikan'];
        $nama = $_POST['namaikan'];
        $jumlah = $_POST['jumlah'];
        $harga = $_POST['hargasatuan'];
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
            $totalharga = $kaliharga; 
    
        }
        $query = "UPDATE tbl_ikan SET kd_ikan='$kdikan',nama_ikan='$nama',jumlah='$jumlah',harga_satuan='$harga' WHERE kd_ikan='$key'";
        mysqli_query($conn,$query);
        Header("Location:index.php");
    }
?>

<html>
    <head>
        <title>Rubah Data</title>
    </head>
    <body  bgcolor="#afeeee">
        <center>
    <form action="" method="post">
    <?php  while($v = mysqli_fetch_array($view)){ ?>
            <table>
            <h1>Edit Data Ikan <?=$v['nama_ikan'] ?></h1>
                <tr>
            <td><label for="">Kode Ikan</label></td>
            <td><input type="text" name="kdikan" value="<?=$v['kd_ikan'] ?>"><br></td>
            </tr>
            <tr>
            <td><label for="">Nama Ikan</label></td>
            <td><input type="text" name="namaikan" value="<?=$v['nama_ikan'] ?>"><br></td>
            </tr><tr>
            <td><label for="">Jumlah</label></td>
            <td><input type="text" name="jumlah" value="<?=$v['jumlah'] ?>"><br></td>
            </tr><tr>
            <td><label for="">Harga Satuan</label></td>
            <td><input type="text" name="hargasatuan" value="<?=$v['harga_satuan'] ?>"><br></td>
            </tr><tr>
            <td colspan="2" align="center"><input type="submit" name="Edit" value="Edit"></td>
            </tr><tr>
                <td colspan="2" align="center"><button href="index.php" name="Edit">Kembali</button></td>
        </tr>
            </table>
            <?php } ?>
        </form>
        </center></body>
</html>