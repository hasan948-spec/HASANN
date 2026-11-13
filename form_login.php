<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Online Cashier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="side">
        <div class="text">
            <h3>Welcome Back</h3>
            <h1>Please login as <br> an super admin</h1>
            <p>This is website kasir online this <br> website allows you to manage <br> your inventory and sales efficiently.</p>
        </div>
        
        <div class="form-container">
            <form action="proses_login.php" method="POST">
                <h2 style="text-align: center; margin-bottom: 8px;">Login</h2>
                
                <p>
                    <label>Username</label>
                    <input type="text" placeholder="masukkan username" name="username">
                </p>
                <p>
                    <label>Email</label>
                    <input type="email" placeholder="masukkan email" name="email">
                </p>
                <p>
                    <label>Password</label>
                    <input type="password" placeholder="masukkan password" name="password">
                </p>
                <button type="submit" name="login">Login</button>
            </form>

            <?php
            $error = '';
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
            }
            
            $pesan = '';
            if ($error == 'login') {
                $pesan = 'Username atau password salah.';
            } elseif ($error == 'invalid') {
                $pesan = 'Anda harus login terlebih dahulu.';
            }
            
            if ($pesan !== '') {
                echo '<p class="error-msg">' . $pesan . '</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>