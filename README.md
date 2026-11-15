# Project UKK 
## Pembuatan web kasir berbasis digital
1. Buatlah daftar kebutuhan teknis dan spesifikasi perangkat yang dibutuhkan pada
lembar yang disediakan !
2. Siapkan peralatan dan bahan yang diperlukan sesuai dengan daftar peralatan !
3. Installah text editor dan software pendukung lainnya yang digunakan untuk
memprogram aplikasi kasir !
4. Interpretasikan spesifikasi program yang diberikan
a. Aplikasi berbasis sistem client-server
b. Aplikasi dapat dibuat berbasis web atau perangkat bergerak
c. Aplikasi menggunakan pembagian privilege dengan tingkatan (administrator dan
petugas)
5. Buatlah Desain User Interface        

| Fitur | administrator | petugas |
|:---|:---:|---:|
| Login | X | X |
| Logout | X | X |
| Registrasi | X |  |
| Pendataan Barang | X | X |
| Pembelian |  |  |
| Stok Barang | X | X |

b. Desain dibuat dengan memperhatikan kaidah UI/UX              
c. Form pelaporan dibuat sekomunikatif mungkin      
d. Terapkan pemrograman berbasis objek (object oriented programming)                                            

6. Buatlah database yang digunakan untuk menambah, mengedit, menghapus, dan
melihat data penjualan barang !                                             
7. Running dan testing hasil program !                                      
8. Buatlah dikumentasi kode program dan upload portofolio pada github !

##  Fitur Login

*   **Fitur ADMIN:** Melihat isi dari stok produk, masuk kedalam dashboard admin, bisa akses pendataan barang, bisa edit ataupun menghapus dan menambah sebuah barang, dapat memantau detail penjualan, memiliki akses untuk melihat daftar pertugas, memiliki akses untuk menambah petuga.
*   **Fitur PETUGAS:** Dapat edit dan delete produk, dapat input data seorang pelanggan, memiliki akses untuk mennggunakan transaksi dan memiliki akses input barang yang di beli oleh pelanggan, melihat informasi produk
##  Tools yang Digunakan

*   [Native PHP (8.4.24)]
*   [Database: MySQL]
*   [VSC (Visual Code Studio) : (1.146.0)]

##  Struktur Folder

```text
bissmilah/
├── delete_admin.php
├── delete_produk.php
├── daftar_adm.php
├── style.css
├── edit_produk.php
├── form_login.php
├── form_tambah.php
├── index.php
├── inpt_login.php
├── koneksi.php
├── login_petugas.php
├── proses_login.php
└── register.php

```
## Desain ERD (Entity Relationship Diagram)

<img width="1033" height="367" alt="image" src="https://github.com/user-attachments/assets/245c8908-a224-4361-b648-83644093ffe7" />

## Landing Page

<img width="1279" height="585" alt="image" src="https://github.com/user-attachments/assets/0ec6e605-0af2-49b6-b7af-9b98e35498e9" />

## Login Page

<img width="1279" height="587" alt="image" src="https://github.com/user-attachments/assets/84cb7e35-ca6f-4243-9a76-ce810de2cc75" />

```php
<?php
include('koneksi.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM login_admin WHERE username='$username' AND email='$email' AND password='$password'";
    $query = mysqli_query($db, $sql);

    $tum=mysqli_num_rows($query);
    if ($tum > 0) {
        header("Location: index.php");
        echo "Login berhasil";
    } else {
        header("location: form_login.php?error=login");
    }
}else{
    echo "isi semua formulir";
}
?>

```
* proses login ini adalah proses login sebagai super admin

## Index

<img width="959" height="437" alt="Screenshot 2026-11-15 231516" src="https://github.com/user-attachments/assets/8bb1b037-ec80-4a0f-aa17-a895464f279c" />

1. Ini kondisi setelah masuk ke dashboard admin, di sini admin akan di perlihatkan penjualan, dari nama, dan hapus serta edit

```php
include('koneksi.php');

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$produk_id = $_GET['id'];

$query = mysqli_query($db, "SELECT * FROM produk WHERE produk_id='$produk_id'");
$produk = mysqli_fetch_assoc($query);

if(isset($_POST['posting'])){
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    
    mysqli_query($db, "UPDATE produk SET nama_produk='$nama_produk', harga='$harga', stok='$stok' WHERE produk_id='$produk_id'");
    
    header("Location: index.php");
    exit();
}
```

ini mengedit data dari input penjualan bisa di baca oleh admin dan admin dapat menghapus

```php
include('koneksi.php');

if (isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($db, "DELETE FROM produk WHERE produk_id='$id'");
}
header("location: index.php");
```

#Formulr tambah produk

<img width="959" height="440" alt="Screenshot 2026-11-15 231701" src="https://github.com/user-attachments/assets/ff373648-a779-4873-a072-a7446c24ab0a" />

di bagian ini bisa menambah produk dengan logic sepert ini

```php
include('koneksi.php');

if(isset($_POST['posting'])){
    $nama_produk = mysqli_real_escape_string($db, $_POST['nama_produk']);
    $harga = mysqli_real_escape_string($db, $_POST['harga']);
    $stok = mysqli_real_escape_string($db, $_POST['stok']);

    mysqli_query($db, "INSERT INTO produk (nama_produk, harga, stok) VALUES ('$nama_produk', '$harga', '$stok')");
    
    header("Location: index.php");
    exit();
}
```
# bagian daftar admin

<img width="959" height="439" alt="image" src="https://github.com/user-attachments/assets/e620dc4e-81ce-4048-9ad3-37313d8ec746" />

di bagia ini super admin bisa menambahkan akun admin biasa atau petugas dengan logic seperti ini

```php
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
```
## Bagian daftar admin dan petugas

<img width="959" height="434" alt="image" src="https://github.com/user-attachments/assets/c0217c06-07df-42ac-87d6-bc3e7d6d4be1" />

di bagian ini admin super bisa memantau menghapus daftar admin dan petugas dengan logika seperti ini

```php
<?php
include('koneksi.php');

if (isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($db, "DELETE FROM login_admin WHERE id='$id'");
}
header("location: dftr_adm.php");
?>
```
## Kesimpulan

**Dari keseluruhan project saya, yang saya kerjakan dari perancangan database, dokumentasi alur sistem, fitur role / level hingga fitur CRUD (Create Read Update Delete)**
Project ini mencakup  hal utama
* Alur kerja CRUD dan ERD, Seluruh fitur pengelolaan data (produk, pelanggan, petugas) sudah saling terhubung melalui relasi.
