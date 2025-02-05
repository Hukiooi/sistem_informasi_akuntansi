<?php
session_start();
if(!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
$db = new SQLite3("../database.db");
?>
<html>
<head>
<title>Akuntansi Keuangan</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../theme/style.css">
</head>
<body>
<h1>Tambah Transaksi</h1>
<div style="text-align: right"><b><?php echo date("d-M-Y"); ?></b></div>
<br>

<h1>Tambah</h1>
<form action="sql.php" method="get" name="tambah">
<input type="hidden" name="perintah" value="tambah" />
<div>Tanggal : <br /><input type="date" name="tanggal" /></div>
<div>Debit : <br />
<select name="debit">
<?php
$sql = "select * from akun order by kode ASC";
if($result = $db->query($sql)){
while($row = $result->fetchArray()){
?>
<option value="<?php echo $row['kode']; ?>"><?php echo $row['akun']; ?></option>
<?php }} ?>
</select>
</div>
<div>Kredit : <br />
<select name="kredit">
<?php
$sql = "select * from akun order by kode ASC";
if($result = $db->query($sql)){
while($row = $result->fetchArray()){
?>
<option value="<?php echo $row['kode']; ?>"><?php echo $row['akun']; ?></option>
<?php }} ?>
</select>
<div>Nominal : <br /><input type="number" name="nominal" /></div>
<div>Keterangan : <br /><input type="text" name="keterangan" /></div>
<br />
<button>Tambah</button>
</form>