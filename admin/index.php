<?php
session_start();
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit(); }
$db = new SQLite3("../database.db");
?>
<html>
<head>
<title>Administrator Area</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../theme/style.css">
</head>
<body>
<h1><span class="red">Administrator</span> Area</h1>
<div style="text-align: right"><b><?php echo date("d-M-Y"); ?></b></div>
<br>

<?php
if(isset($_SESSION['user_id'])){
echo "<div><a href=\"logout.php\">Logout</a></div>";
}

?>
<h1>Jurnal Umum</h1>
<div><a href="transaksi.php">Tambah Transaksi</a></div>
<br />
<p><table>
<?php
$page = 0;
if(isset($_GET['page'])){
$page = (int)$_GET['page'];
}

$id = $page * 10;
$sql = "SELECT * FROM jurnal WHERE id > $id ORDER BY tanggal ASC LIMIT 10";
if ($result = $db->query($sql)) {
while($row = $result->fetchArray()){
echo "<tr>";
echo "<td>" . $row['tanggal'] . "</td>";
echo "<td>" . $row['keterangan'] . "</td>";
echo "<td align=\"right\">" . $row['nominal'] . "</td>";
echo "<td><a href=\"sql.php?perintah=hapus&id=" . $row['id'] ."\">[ x ]</a></td>";
echo "</tr>";
        
}
}

?>
</table></p>
<br>
<div>
Halaman : 
<?php
$result = $db->query("SELECT count(id) as count FROM jurnal");
while($row = $result->fetchArray()){
$count = $row['count'];
}
$page2 = (int)($count / 10);

echo "<a href=\"?page=0\">[0]</a> ";
for($i=$page; $i < $page + 5 + 1; $i++){
echo "<a href=\"?page=". $i . "\">[" . $i . "]</a> ";
}
?>
... <?php
echo "<a href=\"?page=". $page2 . "\">[" . $page2 . "]</a> ";
?>
</div>
<br /><br />
<h1>Akun</h1>
<table>
<?php
$sql = "SELECT * FROM akun ORDER BY kode ASC";
if($result = $db->query($sql)){
while($row= $result->fetchArray()){
echo "<tr><td>" . $row['kode'] . "</td>";
echo "<td>" . $row['akun'] . " ";
echo "<a href=\"sql.php?perintah=hapusakun&id=" . $row['id'] . "\">[ x ]</a><td>";
echo "</tr>";
}
}

?>
</table>

<h1>Tambah Akun</h1>
<form action="sql.php" method="get">
<input type="hidden" name="perintah" value="tambahakun">
Kode : <input type="number" name="kode">
Nama Akun : <input type="text" name="akun"><br>
<button>Tambah</button>
</form>