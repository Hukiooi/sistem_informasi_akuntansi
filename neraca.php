<html>
<head>
<title>Laporan Neraca Keuangan</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="theme/style.css">
</head>
<body>
<h1><span class="red">Akuntansi</span> Keuangan</h1>
<div class="menu"><a href="index.php">Jurnal Umum</a> | <a href="bukubesar.php">Buku Besar</a> | <a href="neraca_saldo.php">Neraca Saldo</a> | <a href="laba_rugi.php">Laba Rugi</a> | <a href="neraca.php">Neraca</a></div>
<br>
<div style="text-align: right"><b><?php echo date("d-M-Y"); ?></b></div>
<br>
<h1>Neraca</h1>

<?php
$db = new SQLite3("database.db");

# pasiva (pendapatan, beban)
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

$labarugi = $pemasukan - $pengeluaran;
?>

<?php
#pasiva (hutang)
$sql = "select sum(nominal) as sum from jurnal where kredit > 5000 and kredit < 6000";
if($result = $db->query($sql)){
while($row = $result->fetchArray()){
$hutang_kredit = $row['sum'];
}
}

$sql = "select sum(nominal) as sum from jurnal where debit> 5000 and debit < 6000";
if($result = $db->query($sql)){
while($row = $result->fetchArray()){
$hutang_debit= $row['sum'];
}
}

$hutang_total = $hutang_kredit - $hutang_debit;
?>

<?php
#pasiva (modal)
$sql = "select sum(nominal) as sum from jurnal where kredit > 2000 and kredit < 3000";
if($result = $db->query($sql)){
while($row = $result->fetchArray()){
$modal_kredit = $row['sum'];
}
}

$sql = "select sum(nominal) as sum from jurnal where debit > 2000 and debit < 3000";
if($result = $db->query($sql)){
while($row = $result->fetchArray()){
$modal_debit = $row['sum'];
}
}

$modal_total = $modal_kredit - $modal_debit;
?>

<?php
# aktiva (kas)
$sql = "select sum(nominal) as sum from jurnal where debit > 1000 and debit < 2000";
if($result = $db->query($sql)){
while($row = $result->fetchArray()){
$kas_debit = (int)$row['sum'];
}
}

$sql = "select sum(nominal) as sum from jurnal where kredit > 1000 and kredit < 2000";
if($result = $db->query($sql)){
while($row = $result->fetchArray()){
$kas_kredit = (int)$row['sum'];
}
}

$kas_total = $kas_debit - $kas_kredit;
?>

<?php
# aktiva (piutang)
$sql = "select sum(nominal) as sum from jurnal where debit > 6000 and debit < 7000";
if($result = $db->query($sql)){
while($row = $result->fetchArray()){
$piutang_debit = (int)$row['sum'];
}
}

$sql = "select sum(nominal) as sum from jurnal where kredit > 6000 and kredit < 7000";
if($result = $db->query($sql)){
while($row = $result->fetchArray()){
$piutang_kredit = (int)$row['sum'];
}
}

$piutang_total = $piutang_debit - $piutang_kredit;
?>

<h3>Aktiva</h3>
<table>
<?php
# kas
$sql = "select * from akun where kode > 1000 and kode < 2000";
if($result = $db->query($sql)){
while($row = $result->fetchArray()){
echo "<tr><td width=\"90%\">" . $row['akun'] . "</td>";

$id = $row['kode'];
$sql = "select sum(nominal) as sum from jurnal where debit = $id";
if($result2 = $db->query($sql)){
while($row2 = $result2->fetchArray()){
$kas2 = (int)$row2['sum'];
}
}

$id = $row['kode'];
$sql = "select sum(nominal) as sum from jurnal where kredit = $id";
if($result3 = $db->query($sql)){
while($row3 = $result3->fetchArray()){
$kas3 = (int)$row3['sum'];
}
}

$kas = $kas2 - $kas3;
echo "<td align=\"right\">" . $kas . "</td>";
echo "</tr>";
}
}

# piutang
$sql = "select * from akun where kode > 6000 and kode < 7000";
if($result = $db->query($sql)){
while($row = $result->fetchArray()){
echo "<tr><td width=\"90%\">" . $row['akun'] . "</td>";

$id = $row['kode'];
$sql = "select sum(nominal) as sum from jurnal where debit = $id";
if($result2 = $db->query($sql)){
while($row2 = $result2->fetchArray()){
$piutang2 = (int)$row2['sum'];
}
}

$id = $row['kode'];
$sql = "select sum(nominal) as sum from jurnal where kredit = $id";
if($result3 = $db->query($sql)){
while($row3 = $result3->fetchArray()){
$piutang3 = (int)$row3['sum'];
}
}

$piutang = $piutang2 - $piutang3;
echo "<td align=\"right\">" . $piutang . "</td>";
echo "</tr>";
}
}

?>
</table>
<br />
<table><tr>
<td width="90%"><b>Total Aktiva</b></td>
<td><b><?php echo $kas_total + $piutang_total; ?></b></td>
</tr>
</table>

<h3>Pasiva</h3>
<table>
<?php

# modal
$sql = "select * from akun where kode > 2000 and kode < 3000";
if($result = $db->query($sql)){
while($row = $result->fetchArray()){
echo "<tr><td width=\"90%\">" . $row['akun'] . "</td>";

$id = $row['kode'];
$sql = "select sum(nominal) as sum from jurnal where debit = $id";
if($result2= $db->query($sql)){
while($row2 = $result2->fetchArray()){
$modal2 = (int)$row2['sum'];
}
}

$id = $row['kode'];
$sql = "select sum(nominal) as sum from jurnal where kredit = $id";
if($result2= $db->query($sql)){
while($row3 = $result2->fetchArray()){
$modal3 = (int)$row3['sum'];
}
}

$modal = $modal2 - $modal3;
echo "<td align=\"right\">" . $modal . "</td>";
echo "</tr>";
}
}

# hutang
$sql = "select * from akun where kode > 5000 and kode < 6000";
if($result = $db->query($sql)){
while($row = $result->fetchArray()){
echo "<tr><td width=\"90%\">" . $row['akun'] . "</td>";

$id = $row['kode'];
$sql = "select sum(nominal) as sum from jurnal where kredit = $id";
if($result2 = $db->query($sql)){
while($row2= $result2->fetchArray()){
$hutang2 = (int)$row2['sum'];
}
}

$id = $row['kode'];
$sql = "select sum(nominal) as sum from jurnal where debit = $id";
if($result2 = $db->query($sql)){
while($row3= $result2->fetchArray()){
$hutang3 = (int)$row3['sum'];
}
}


$hutang = $hutang2 - $hutang3;
echo "<td align=\"right\">" . $hutang . "</td>";
echo "</tr>";
}
}

echo "<tr><td width=\"90%\">Laba / Rugi</td><td>" . $labarugi . "</td></tr>";
?>
</table>
<br />
<table><tr>
<td width="90%"><b>Total Pasiva</b></td>
<td><b><?php echo $modal_total + $hutang_total + $labarugi; ?></b></td>
</tr>
</table>
