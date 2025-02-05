<html>
<head>
<title>Laporan Laba Rugi</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="theme/style.css">
</head>
<body>
<h1><span class="red">Akuntansi</span> Keuangan</h1>
<div class="menu"><a href="index.php">Jurnal Umum</a> | <a href="bukubesar.php">Buku Besar</a> | <a href="neraca_saldo.php">Neraca Saldo</a> | <a href="laba_rugi.php">Laba Rugi</a> | <a href="neraca.php">Neraca</a></div>
<br>
<div style="text-align: right"><b><?php echo date("d-M-Y"); ?></b></div>
<br>
<h1>Laba / Rugi</h1>

<?php
$db = new SQLite3("database.db");

$sql = "select sum(nominal) as sum from jurnal where kredit > 3000 and kredit < 4000";
if($result = $db->query($sql)){
while($row = $result->fetchArray()){
$pemasukan = $row['sum'];
}
}

$sql = "select sum(nominal) as sum from jurnal where debit > 4000 and debit < 5000";
if($result = $db->query($sql)){
while($row = $result->fetchArray()){
$pengeluaran = $row['sum'];
}
}
?>

<h3>Pemasukan</h3>
<table>
<?php
$sql = "select * from akun where kode > 3000 and kode < 4000";
if($result = $db->query($sql)){
while($row = $result->fetchArray()){
echo "<tr><td width=\"90%\">" . $row['akun'] . "</td>";

$id = $row['kode'];
$sql = "select sum(nominal) as sum from jurnal where kredit = $id";
if($nominal = $db->query($sql)){
while($row = $nominal->fetchArray()){
echo "<td align=\"right\">" . (int)$row['sum']. "</td>";
}
}

}
}
?>
</table>
<br />
<table><tr>
<td width="90%"><b>Total Pemasukan</b></td>
<td align="right"><b><?php echo $pemasukan; ?></b></td>
</tr>
</table>

<h3>Pengeluaran</h3>
<table>
<?php
$sql = "select * from akun where kode > 4000 and kode < 5000";
if($result = $db->query($sql)){
while($obj = $result->fetchArray()){
echo "<tr><td width=\"90%\">" . $obj['akun'] . "</td>";

$id = $obj['kode'];
$sql = "select sum(nominal) as sum from jurnal where debit = $id";
if($nominal = $db->query($sql)){
while($akun = $nominal->fetchArray()){
if($akun['sum'] < 1){ $n = 0; } else { $n = $akun['sum']; }
echo "<td align=\"right\">" . $n . "</td>";
}
}

}
}
?>
</table>
<br />
<table><tr>
<td width="90%"><b>Total Pengeluaran</b></td>
<td><b><?php echo $pengeluaran; ?></b></td>
</tr>
</table>

<h3>Laba / Rugi</h3>

<table><tr><td width="90%">
<?
if($pemasukan == $pengeluaran){
echo "Impas";
} else if($pemasukan > $pengeluaran){
echo "Laba";
} else {
echo "Rugi";
}

?></td><td align="right"><b>
<?php
echo $pemasukan - $pengeluaran;
?>
</b></td></tr>
</table>
