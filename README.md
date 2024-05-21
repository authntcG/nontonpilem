NontonPilem - Still In Progress
=======================

Introduction
------------
Aplikasi ini merupakan aplikasi pemesanan tiket bioskop sederhana yang dibuat menggunakan Framework Zend 2.
Aplikasi ini menggunakan api untuk mendapatkan/mengirim data yang diperlukan ke database MySQL.

Work Procedure
------------
1. Pelanggan memilih film
2. Pelanggan memilih no kursi
3. Klik tombol Checkout
4. Klik tombol Bayar

System Requirements
------------
Aplikasi ini membutuhkan :
1. PHP Versi 5.x.x
2. Apache 2.4.38 (Ataupun versi sejenis yang mendukung PHP 5)
3. Composer

Installation
------------
Clone repository ini, lalu copy ke dalam aplikasi Local Server yang anda gunakan (Ex. XAMPP, Laragon, etc.)
Run aplikasi setelah menghidupkan aplikasi local server anda.

Note
------------
Jika aplikasi memunculkan pesan error ketika pertama kali dijalankan, kemungkinan file Framework Zend 2 belum terinstal dengan benar.
Untuk mengatasi hal ini, jalankan perintah php composer.phar self-update atau php composer.phar install pada Composer.
