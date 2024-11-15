<?php
session_start();
include '../config/database.php';

$nisn = $_POST['nisn'];
$nis = $_POST['nis'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$id_kelas = $_POST['id_kelas'];

$stmt = $db->prepare("INSERT INTO siswa (nisn, nis, nama, alamat, no_telp, id_kelas) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([$nisn, $nis, $nama, $alamat, $no_telp, $id_kelas]);

header("Location: ../views/manage_students.php");
