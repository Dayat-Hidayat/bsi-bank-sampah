# CodeIgniter 4 BSI Bank Sampah

## Apa itu Bank Sampah?

Bank Sampah adalah sebuah sistem penyimpanan sampah dengan cara kita setor sampah ke pihak bank sampah lalu nanti sampah kita akan di konversi menjadi uang dalam bentuk saldo yang nanti akan tersimpan di rekening kita

## Setup

- [XAMPP](https://www.apachefriends.org/download.html) XAMPP Versi 7.4 atau diatasnya
- [intl](http://php.net/manual/en/intl.requirements.php) Aktifkan intl pada XAMPP -> Apache -> Config -> PHP (php.ini) -> Cari ;extension=intl -> Hapus titik koma di awal lalu save
- [Composer](https://getcomposer.org/)

## Instalasi

1. Download atau clone repository ini
2. Buka terminal atau cmd
3. Masuk ke direktori project
4. `composer update && composer install` untuk menginstall dependencies
5. `php spark migrate && php spark db:seed MainSeeder` untuk membuat database dan mengisi data awal
6. Jalankan server dengan `php spark serve`
7. Buka browser dan masuk ke http://localhost:8080
