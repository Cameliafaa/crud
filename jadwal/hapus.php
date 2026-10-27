<?php
require_once "../config/database.php";
$id=(int)($_GET['id']??0);
$stmt=mysqli_prepare($conn,"DELETE FROM tbl_jadwal WHERE id_jadwal=?");
mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);
header("Location: index.php");
exit;
?>
