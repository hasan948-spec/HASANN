<?php
include('koneksi.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-index">
        <!-- Sidebar Menu -->
        <div class="slide">
            <h3>Menu</h3>
            <nav>
                <ul>
                    <li><a href="index.php">Product data</a></li>
                    <li><a href="form_tambah.php">Add stock</a></li>
                    <li><a href="register.php">Register person</a></li>
                    <li><a href="dftr_adm.php">Data list admin</a></li>
                </ul>
            </nav>
            <br><br><br><br><br>
            <a href="inpt_login.php" class="logout">Logout</a>
        </div>

        <!-- Area Konten Utama Sebelah Kanan -->
        <div class="main-content">
            <div class="card-index">
                <h1>Daftar Produk</h1>
                
                <table border="1" class="table-form">
                    <tr>
                        <th>No.</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok Produk</th>
                        <th>Aktivitas</th>
                    </tr>
                    <?php
                    $query = mysqli_query($db, "SELECT * FROM produk");
                    $no = 1;
                    while ($produk = mysqli_fetch_assoc($query)):
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($produk['nama_produk']) ?></td>
                        <td><?= htmlspecialchars($produk['harga']) ?></td>
                        <td><?= htmlspecialchars($produk['stok']) ?></td>
                        <td>
                            <a href="edit_produk.php?id=<?= $produk['produk_id'] ?>">Edit</a>
                            <a href="delete_produk.php?id=<?= $produk['produk_id'] ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>            
        </div>
    </div>
</body>
</html>