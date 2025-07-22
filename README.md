<p align="center">
    <img src="./public/images/logo.png" align="center" width="30%">
</p>
<p align="center"><h1 align="center">Aplikasi Note Taking Sederhana</h1></p>
<p align="center">
    <em><code>Laravel 12.0 | Tailwind 4.0.0</code></em>
</p>

<p align="center"><!-- default option, no dependency badges. -->
</p>
<p align="center">
    <!-- default option, no dependency badges. -->
</p>
<br>


## 📍 1. Overview

Aplikasi Note Taking adalah perangkat lunak yang dirancang untuk membantu pengguna mencatat, mengatur, dan menyimpan informasi dalam bentuk digital dengan fungsi utamanya adalah sebagai pengganti buku catatan fisik, memo, atau alat tulis tradisional.

---

## 📁 2. Rancangan Struktur Database
Berikut adalah skema rancangan database:

1. Tabel users
<br>Tabel ini akan menyimpan informasi tentang setiap pengguna.

| Kolom | Tipe Data | Keterangan |
|---|---|---|
|id |	INT (PK, AI) | ID unik untuk setiap pengguna |
|slug| UUID| ID Unik untuk param|
|name|	VARCHAR(255)|	Nama pengguna|
|email|	VARCHAR(255)|	Alamat email pengguna|
|password|	VARCHAR(255)|	Hash kata sandi pengguna|
|avatar| VARCHAR(255)| Photo pengguna|
|created_at|	DATETIME|	Stempel waktu pembuatan akun|

2. Tabel posts
<br>Tabel ini akan menyimpan informasi tentang setiap postingan atau catatan.

|Kolom|	Tipe Data|Keterangan|
|---|---|---|
|id|	INT (PK, AI)|	ID unik untuk setiap postingan|
|slug| UUID| ID Unik untuk param|
|user_id|	INT (FK)|	ID pengguna yang membuat postingan ini|
|content|	TEXT|	Isi atau deskripsi postingan|
|visibility|	ENUM('public', 'private', 'shared')|	Menentukan visibilitas postingan|
|created_at|	DATETIME|	Stempel waktu pembuatan postingan|

3. Tabel comments
<br>Tabel ini akan menyimpan komentar pada setiap postingan.

|Kolom|	Tipe Data|	Keterangan|
|---|---|---|
|id|	INT (PK, AI)|	ID unik untuk setiap komentar|
|note_id|	INT (FK)|	ID postingan yang dikomentari|
|user_id|	INT (FK)|	ID pengguna yang membuat komentar|
|comment|	TEXT|	Isi komentar|
|comment_parent_id| INT | Merujuk ke comments.id lain (opsional/nullable). Untuk fitur balasan komentar (reply)|
|created_at|	DATETIME|	Stempel waktu pembuatan komentar|

4. Tabel post_shares
<br>Tabel ini akan mengelola postingan yang di-share ke pengguna tertentu. Ini akan digunakan ketika visibility diatur ke 'shared'.

|Kolom|	Tipe Data|	Keterangan|
|---|---|---|
|id	|INT (PK, AI)|	ID unik untuk setiap pembagian|
|note_id	|INT (FK)|	ID postingan yang dibagikan|
|shared_with_user_id|	INT (FK)|	ID pengguna yang dibagikan postingan ini|
|created_at|	DATETIME|	Stempel waktu pembagian|

---

## 👾 Flow Process dari Aplikasi.

1. Pendaftaran & Login Pengguna 🚪
<br/>Alur ini adalah gerbang utama bagi pengguna untuk masuk ke dalam aplikasi.

- Pengguna (Baru):
<br/>
<br/>- Membuka aplikasi dan memilih opsi "Daftar".
<br/>- Mengisi formulir dengan nama, email, dan password.
<br/>- Menekan tombol "Daftar & Masuk".
<br/>

- Pengguna (Terdaftar):
<br/>
<br/>- Membuka aplikasi dan memilih opsi "Login".
<br/>- Memasukkan email dan password.
<br/>- Menekan tombol "Masuk".
---

2. Membuat & Mengelola Catatan 📝
<br/>Ini adalah fungsi inti dimana pengguna membuat konten pribadinya.
<br/>
<br/>- Pada halaman dashboard, tekan tombol <b>"Buat Catatan Baru"</b>.
<br/>- <b>Isi konten catatan</b>.
<br/>- Pilih <b>Visibility Public, Private</b>  atau <b>Bagikan ke</b>.
<br/>- Jika pengguna memilih visibility <b>Bagikan ke</b> maka pengguna harus mengisi pengguna lain yang dituju.
<br/>- Setelah semua telah terisi tekan tombol <b>Simpan Catatan</b>.

3. Membagikan Catatan 🤝
<br>Alur ini menjelaskan bagaimana sebuah catatan pribadi bisa diakses oleh orang lain.
<br>
<br>a. Berbagi ke Pengguna Tertentu (Pemilik Catatan) :
<br>- Membuka salah satu catatan pribadinya.
<br>- Mencari dan menekan tombol "Bagikan" atau "Share".
<br>- Pilih pengguna yang dituju.
<br>- Menekan tombol "Undang".
<br>
<br>b. Berbagi ke Publik (Pemilik Catatan) :
<br>- Membuka catatan pribadinya.
<br>- Menemukan opsi seperti "Jadikan Publik".
<br>- Mengaktifkan opsi tersebut.

4. Berkomentar 💬
<br>Alur ini menjelaskan bagaimana seorang pengguna melihat catatan dan berinteraksi.
<br>- Buka catatan yang ingin dikomentari .
<br>- Mengetik komentar di kolom yang tersedia.
<br>- Kirim komentar
<br>
---
## 📌 Library / Plugin

- <b>@iconify/tailwind4</b>
<br>Digunakan sebagai icon set yang digunakan,  Alasan penggunaan plugin ini karena open source dan banyak pilihan paket icon.
- <b>Tinymce</b>
<br>Digunakan sebagai TextEditor pada saat tambah catatan. Alasan penggunaan plugin ini karena fitur lumayan bagus dan mudah digunakan.
- <b>Toastr</b>
<br>Digunakan untuk menampilkan notifikasi. Alasan penggunaan plugin ini karena mudah dipakai.
