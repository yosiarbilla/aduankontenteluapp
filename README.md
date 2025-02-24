# Platform Website Aduan Konten Digital TNI Siber

## Deskripsi Proyek
Platform Website Aduan Konten Digital ini dikembangkan untuk mendukung instansi **PUSSANSIAD** dalam memfasilitasi pihak terkait untuk melaporkan konten digital yang dianggap melanggar peraturan dan perundang-undangan yang berlaku. Platform ini menyediakan fitur utama berupa pengajuan aduan baru dengan berbagai kategori yang telah ditentukan serta pelaporan konten yang melanggar ketentuan hukum.

## Fitur Utama
- **Pengajuan Aduan Baru**: Pengguna dapat menambahkan aduan terkait konten digital dengan mengisi formulir yang tersedia.
- **Kategori Aduan**: Terdapat beberapa kategori yang dapat dipilih sesuai dengan jenis pelanggaran konten.
- **Pelaporan Konten**: Memungkinkan pengguna untuk melaporkan konten yang melanggar undang-undang yang berlaku.
- **Manajemen Aduan**: Admin dapat memantau, memverifikasi, dan menindaklanjuti setiap aduan yang masuk.

## Teknologi yang Digunakan
Platform ini dibangun menggunakan teknologi utama berikut:
- **Framework Backend:** Laravel (PHP)
- **Framework Frontend:** Bootstrap (HTML, CSS, JS)
- **Database:** MySQL

Selain teknologi utama di atas, platform ini juga memanfaatkan beberapa platform pendukung untuk meningkatkan fungsionalitas dan kinerja aplikasi:
- **Autentikasi dan Otorisasi:** Laravel Breeze
- **Pengiriman Email:** Laravel Mail (SMTP)
- **Validasi Formulir:** Laravel Validation
- **Pengelolaan File:** Laravel File Storage
- **Notifikasi Real-time:** Laravel Echo & Pusher


## Struktur Folder
```plaintext
├── app
│   ├── Console
│   ├── Exceptions
│   ├── Http
│   ├── Models
│   ├── Providers
├── bootstrap
├── config
├── database
│   ├── factories
│   ├── migrations
│   ├── seeders
├── public
├── resources
│   ├── css
│   ├── js
│   ├── views
├── routes
├── storage
├── tests
├── vendor
├── .env
├── artisan
├── composer.json
├── package.json
└── webpack.mix.js
```
## Kontributor
- [github/yosiarbilla](https://github.com/yosiarbilla) (Frontend Developer)
- [github/ahmdfaizf](https://github.com/ahmdfaizf) (Backend Developer)
- [github/godwimp](https://github.com/godwimp) (Server Security)

---

## Lisensi
Proyek ini dilindungi oleh lisensi
[MIT](https://choosealicense.com/licenses/mit/) dan hanya diperuntukkan bagi penggunaan resmi oleh pengembang beserta instansi **PUSSANSIAD**.

