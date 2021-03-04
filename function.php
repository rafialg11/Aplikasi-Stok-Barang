<?php
session_start();
//membuat koneksi ke database
$conn = mysqli_connect("localhost","root", "","stokbarang");

//tambah barang baru
if (isset($_POST['tambahbarang'])) {
    $namabarang=$_POST['namabarang'];
    $deskripsi=$_POST['deskripsi'];
    $jumlah=$_POST['jumlah'];

    $addtotable=mysqli_query($conn, "insert into stock (namabarang, deskripsi, jumlah) values('$namabarang','$deskripsi','$jumlah')");
    if ($addtotable) {
        header('location:index.php');
    }else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//menambah barang masuk
if (isset($_POST['barangmasuk'])) {
    $pilihbaranngnya=$_POST['pilihbarangnya'];
    $penerima=$_POST['penerima'];
    $qty=$_POST['qty'];

    $cekstoksekarang=mysqli_query($conn, "select * from stock where idbarang='$pilihbaranngnya'");
    $ambildata=mysqli_fetch_array($cekstoksekarang);

    $stoksekarang=$ambildata['jumlah'];
    $totalsetelahdijumlah=$stoksekarang+$qty;

    $addtomasuk=mysqli_query($conn, "insert into masuk (idbarang, keterangan, qty) values('$pilihbaranngnya','$penerima','$qty')");
    $updatestokmasuk=mysqli_query($conn, "update stock set jumlah='$totalsetelahdijumlah' where idbarang='$pilihbaranngnya'");
    if ($addtomasuk&&$updatestokmasuk) {
        header('location:barangmasuk.php');
    }else {
        echo 'Gagal';
        header('location:barangmasuk.php');
    }
}


//menambah barang keluar
if (isset($_POST['barangkeluar'])) {
    $pilihbaranngnya=$_POST['pilihbarangnya'];
    $penerima=$_POST['penerima'];
    $qty=$_POST['qty'];

    $cekstoksekarang=mysqli_query($conn, "select * from stock where idbarang='$pilihbaranngnya'");
    $ambildata=mysqli_fetch_array($cekstoksekarang);

    $stoksekarang=$ambildata['jumlah'];
    $totalsetelahdikurang=$stoksekarang-$qty;

    $addtokeluar=mysqli_query($conn, "insert into keluar (idbarang, penerima, qty) values('$pilihbaranngnya','$penerima','$qty')");
    $updatestokkeluar=mysqli_query($conn, "update stock set jumlah='$totalsetelahdikurang' where idbarang='$pilihbaranngnya'");
    if ($addtokeluar&&$updatestokkeluar) {
        header('location:barangkeluar.php');
    }else {
        echo 'Gagal';
        header('location:barangkeluar.php');
    }
}

//edit detail barang
if (isset($_POST['updatebarang'])) {
    $idb= $_POST['idb'];
    $namabarang= $_POST['namabarang'];
    $deskripsi= $_POST['deskripsi'];

    $editdetail= mysqli_query($conn, "update stock set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang='$idb'");
    if ($editdetail) {
        header('location:index.php');
    }else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//hapus barang
if (isset($_POST['hapusbarang'])) {
    $idb= $_POST['idb'];
    
    $hapusbarang= mysqli_query($conn, "delete from stock where idbarang='$idb'");
    if ($hapusbarang) {
        header('location:index.php');
    }else {
        echo 'Gagal';
        header('location:index.php');
    }
}


?>