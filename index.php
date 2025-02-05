<?php
$db = new SQLite3("database.db");

$sql = "SELECT * FROM jurnal ORDER BY tanggal DESC, id DESC limit 20";
$results = $db->query($sql);
while ($row = $results->fetchArray()) {
$data[] = $row;
}

?>
<html>
<head>
<title>Jurnal Umum</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="theme/style.css">
</head>
<body>
<h1><span class="red">Akuntansi</span> Keuangan</h1>
<div class="menu"><a href="index.php">Jurnal Umum</a> | <a href="bukubesar.php">Buku Besar</a> | <a href="neraca_saldo.php">Neraca Saldo</a> | <a href="laba_rugi.php">Laba Rugi</a> | <a href="neraca.php">Neraca</a></div>
<br>
<div style="text-align: right"><b><?php echo date("d-M-Y"); ?></b></div>
<br>

<h1>Jurnal Umum</h1>
<table>
<?php
foreach($data as $data){
?>
<tr><td><? echo $data['tanggal']; ?></td><td>
<?
$kode = $data['debit'];
$result = $db->query("SELECT * FROM akun WHERE kode = $kode");
while($row = $result->fetchArray()){
$debit = $row['akun'];
}
echo $debit;
?> / <?

$kode = $data['kredit'];
$result = $db->query("SELECT * FROM akun WHERE kode = $kode");
while($row = $result->fetchArray()){
$kredit = $row['akun'];
}
echo $kredit;

?></td><td align="right"><? echo $data['nominal']; ?></td></tr>
<?
}
?>
</table>
<br>