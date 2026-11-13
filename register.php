<?php
include('koneksi.php');

$pesan = '';
if (isset($_POST['create'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (!empty($username) && !empty($email) && !empty($password) && !empty($role)) {
        $hashed_password = $password; 

        $stmt = mysqli_prepare($db, "INSERT INTO login_admin (username, email, password, role) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashed_password, $role);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: dftr_adm.php");
            exit;
        } else {
            $pesan = "<p style='color:red;'>Gagal menyimpan data: " . mysqli_error($db) . "</p>";
        }
        
        mysqli_stmt_close($stmt);
    } else {
        $pesan = "<p style='color:red;'>Semua kolom wajib diisi!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="side1">
        <div class="text">
            <h3>Welcome</h3>
            <h1>Please create an <br> admin account.</h1>
            <p>This is a website kasir online, this <br> website allows you to manage <br> your inventory and sales efficiently.</p>
        </div>
        
        <div class="form-regis">
            <h2 style="text-align: center; margin-bottom: 8px;">Register</h2>
            
            <form action="" method="POST">
                <p>
                    <label>Username</label><br>
                    <input type="text" placeholder="Masukkan username" name="username" required>
                </p>
                <p>
                    <label>Email</label><br>
                    <input type="email" placeholder="Masukkan email" name="email" required>
                </p>
                <p>
                    <label>Password</label><br>
                    <input type="password" placeholder="Masukkan password" name="password" required>
                </p>
                <p>
                    <label>Role</label><br>
                    <input type="text" name="role" list="role-list" placeholder="Pilih role" required>
                    <datalist id="role-list">
                        <option value="Admin">
                        <option value="Petugas">
                    </datalist>
                </p>
                
                <button type="submit" name="create">Simpan</button>
            </form>

            <?php echo $pesan; ?>
        </div>
    </div>
</body>
</html>