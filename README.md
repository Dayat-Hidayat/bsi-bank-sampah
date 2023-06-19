# CodeIgniter 4 BSI Bank Sampah

## Apa itu Bank Sampah?

Bank Sampah adalah sebuah sistem penyimpanan sampah dengan cara kita setor sampah ke pihak bank sampah lalu nanti sampah kita akan di konversi menjadi uang dalam bentuk saldo yang nanti akan tersimpan di rekening kita

## Setup

- [XAMPP](https://www.apachefriends.org/download.html) XAMPP Versi 7.4 atau diatasnya
- [intl](http://php.net/manual/en/intl.requirements.php)

- [Git](https://git-scm.com/)
- [Composer](https://getcomposer.org/)

Lalu ketik ini di terminal

- git clone https://github.com/Dayat-Hidayat/bsi-bank-sampah.git
- composer update && composer install
- php spark migrate && php spark db:seed MainSeeder
- php spark serve
