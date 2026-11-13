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
                    <li><a href="form_tambah.php">Add stok</a></li>
                    <li><a href="register.php">Register person</a></li>
                    <li><a href="#">Data list admin</a></li>
                </ul>
            </nav>
        </div>

        <!-- Area Konten Utama Sebelah Kanan -->
        <div class="main-content">
            <div class="card-index">
                <h1>Daftar Admin</h1>
                <div class="action-bar" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                </div>
                <table border="1" class="table-form">
                    <tr>
                        <th class="nyilik">No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aktivitas</th>
                    </tr>
                    <?php
                    $query = mysqli_query($db, "SELECT * FROM login_admin");
                    $no = 1;
                    while ($produk = mysqli_fetch_assoc($query)):
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($produk['username']) ?></td>
                        <td><?= htmlspecialchars($produk['email']) ?></td>
                        <td><?= htmlspecialchars($produk['role']) ?></td>
                        <td>
                            <a href="delete_admin.php?id=<?= $produk['id'] ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>            
        </div>
    </div>
</body>
</html>