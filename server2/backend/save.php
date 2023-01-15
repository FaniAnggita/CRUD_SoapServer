<?php
include 'database.php';

// fungsi untuk menyimpan data ke database
if (count($_POST) > 0) {
    if ($_POST['type'] == 1) {
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $deskripsi = $_POST['deskripsi'];
        $sql = "INSERT INTO `buku`( `judul`, `pengarang`,`penerbit`,`tahun_terbit`, `deskripsi`) 
		VALUES ('$judul','$pengarang','$penerbit','$tahun_terbit', '$deskripsi')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("statusCode" => 200));
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}

// fungsi untuk update data pada database
if (count($_POST) > 0) {
    if ($_POST['type'] == 2) {
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $deskripsi = $_POST['deskripsi'];
        $sql = "UPDATE `buku` SET `judul`='$judul',`pengarang`='$pengarang',`penerbit`='$penerbit',`tahun_terbit`='$tahun_terbit', `deskripsi`='$deskripsi' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("statusCode" => 200));
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}

// fungsi untuk delete data pada database
if (count($_POST) > 0) {
    if ($_POST['type'] == 3) {
        $id = $_POST['id'];
        $sql = "DELETE FROM `buku` WHERE id=$id ";
        if (mysqli_query($conn, $sql)) {
            echo $id;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
if (count($_POST) > 0) {
    if ($_POST['type'] == 4) {
        $id = $_POST['id'];
        $sql = "DELETE FROM buku WHERE id in ($id)";
        if (mysqli_query($conn, $sql)) {
            echo $id;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
