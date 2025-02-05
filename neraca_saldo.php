<html>
<head>
<title>Laporan Neraca Saldo</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="theme/style.css">
</head>
<body>
<h1><span class="red">Akuntansi</span> Keuangan</h1>
<div class="menu"><a href="index.php">Jurnal Umum</a> | <a href="bukubesar.php">Buku Besar</a> | <a href="neraca_saldo.php">Neraca Saldo</a> | <a href="laba_rugi.php">Laba Rugi</a> | <a href="neraca.php">Neraca</a></div>
<br>
<div style="text-align: right"><b><?php echo date("d-M-Y"); ?></b></div>
<br>
<h1>Neraca Saldo</h1>

<!---
<center><form><input type="text" name="dari" /> <input type="text" name="sampai" /></form></center>

--->

<table>
<?php
$db = new SQLite3("database.db");

$sql = "select * from akun order by kode ASC";
if($result = $db->query($sql)){
while($obj = $result->fetchArray()){
echo "<tr><td width=\"80%\">" . $obj['akun'] . "</td>";

$id = $obj['kode'];
$sql = "select sum(nominal) as sum from jurnal where debit = $id";
if($nominal = $db->query($sql)){
while($akun = $nominal->fetchArray()){
if($akun['sum'] < 1){ $n = 0; } else { $n = $akun['sum']; }
echo "<td align=\"right\">" . $n . "</td>";
}
}

$id2 = $obj['kode'];
$sql2 = "select sum(nominal) as sum from jurnal where kredit = $id2";
if($nominal2 = $db->query($sql2)){
while($akun2 = $nominal2->fetchArray()){
if($akun2['sum'] < 1){ $n = 0; } else { $n = $akun2['sum']; }
echo "<td align=\"right\">" . $n . "</td>";
}
}

echo "</tr>";

}
}

echo "<tr><td></td>";
$sql3 = "select sum(nominal) as sum from jurnal where debit > 0";
if($nominal3 = $db->query($sql3)){
while($akun3 = $nominal3->fetchArray()){
if($akun3['sum'] < 1){ $n = 0; } else { $n = $akun3['sum']; }
echo "<td align=\"right\"><b>" . $n . "</b></td>";
}
}

$sql4 = "select sum(nominal) as sum from jurnal where kredit > 0";
if($nominal4 = $db->query($sql4)){
while($akun4 = $nominal4->fetchArray()){
if($akun4['sum'] < 1){ $n = 0; } else { $n = $akun4['sum']; }
echo "<td align=\"right\"><b>" . $n . "</b></td>";
}
}

echo "</tr>";
?>
</table>