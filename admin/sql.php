<?php
session_start();
if(!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
$db = new SQLite3("../database.db");

$code = "gagal";

$result = $db->query("select id FROM jurnal ORDER BY id DESC LIMIT 1");
while($row = $result->fetchArray()){
	$last_id_jurnal = (int)$row['id'] + 1;
}

$result = $db->query("select id FROM akun ORDER BY id DESC LIMIT 1");
while($row = $result->fetchArray()){
	$last_id_akun = (int)$row['id'] + 1;
}


if(isset($_GET['perintah'])){
if($_GET['perintah'] == "tambah"){
	$tanggal = $_GET['tanggal'];
	$debit = (int)$_GET['debit'];
	$kredit = (int)$_GET['kredit'];
	$nominal = (int)$_GET['nominal'];
	$keterangan = $_GET['keterangan'];
	
if(!empty($tanggal) && !empty($debit) && !empty($kredit) && !empty($nominal)){
$result = $db->query("INSERT INTO jurnal VALUES ($last_id_jurnal, '$tanggal', $debit, $kredit, $nominal, '$keterangan')");
// var_dump($result);
if($result){ $code = "sukses"; }
}
}

if($_GET['perintah'] == "hapus"){
$id = (int)$_GET['id'];
if(!empty($id)){
$result = $db->query("DELETE FROM jurnal WHERE id = $id");
// var_dump($result);
if($result){ $code = "sukses"; }
}
}

if($_GET['perintah'] == "tambahakun"){
$id = $last_id_akun;

$kode = (int)$_GET['kode'];
$akun = $_GET['akun'];

if(!empty($kode) && !empty($akun)){
$result = $db->query("INSERT INTO akun VALUES ($id, $kode, '$akun')");
// var_dump($result);
if($result){ $code = "sukses"; }
}
}

if($_GET['perintah'] == "hapusakun"){
$id = (int)$_GET['id'];
if(!empty($id)){
$result = $db->query("DELETE FROM akun WHERE id = $id");
if($result){ $code = "sukses"; }
}
}

// end if isset() get perintah
}

header("Location: index.php?code=" . $code);
exit();
?>