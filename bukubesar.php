<html>
<head>
<title>Buku Besar</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="theme/style.css">
</head>
<body>
<h1><span class="red">Akuntansi</span> Keuangan</h1>
<div class="menu"><a href="index.php">Jurnal Umum</a> | <a href="bukubesar.php">Buku Besar</a> | <a href="neraca_saldo.php">Neraca Saldo</a> | <a href="laba_rugi.php">Laba Rugi</a> | <a href="neraca.php">Neraca</a></div>
<br>
<div style="text-align: right"><b><?php echo date("d-M-Y"); ?></b></div>
<br>

<h1>Buku Besar</h1>
<table>
<?php

$db = new SQLite3("database.db");
$result = $db->query("SELECT * FROM akun");
while($row = $result->fetchArray()){
?>
<tr><td><b>
<?
echo $row['akun'];
?>
</b><td>
<?
$kode = $row['kode'];
$i = 0;
$result2 = $db->query("SELECT * FROM jurnal WHERE debit = $kode OR kredit = $kode ORDER BY tanggal DESC, id DESC LIMIT 5");
while($row2 = $result2->fetchArray()){
$data[$i] = $row2;
$i++;
}

$reverse = array_reverse($data);
// var_dump($reverse);
foreach($reverse as $key => $res){
if((int)$res['nominal'] > 0){
?>
<tr><td width="80%">
<?
echo $res['tanggal'];
?>
<td align="right">
<?
if($res['debit'] == $kode){
echo (int)$res['nominal'];
} else {
echo 0;
}
?>
</td><td align="right">
<?
if($res['kredit'] == $kode){
echo (int)$res['nominal'];
} else {
echo 0;
}
?>
</td></tr>
<?
}
}
}

?>
</table>