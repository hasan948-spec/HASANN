<?php
include('koneksi.php');

if (isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($db, "DELETE FROM login_admin WHERE id='$id'");
}
header("location: dftr_adm.php");
?>