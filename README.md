<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Panduan API Input Suhu

API ini digunakan perangkat IoT untuk mengirim data pembacaan suhu ke aplikasi Monitoring Suhu.

### Endpoint

```http
POST /api/temperature-readings
```

Contoh base URL lokal:

```text
http://127.0.0.1:8001/api/temperature-readings
```

### Autentikasi

API menggunakan Laravel Sanctum bearer token.

1. Login ke aplikasi sebagai admin.
2. Buka menu `API Token`.
3. Klik buat token baru.
4. Pilih user pemilik token.
5. Isi nama token, misalnya `Device Ruang Server`.
6. Centang ability `Kirim data suhu` atau `temperature:write`.
7. Simpan token yang muncul. Token hanya ditampilkan sekali.

Setiap request dari device wajib mengirim header:

```http
Authorization: Bearer TOKEN_ANDA
Accept: application/json
Content-Type: application/json
```

### Body Request

```json
{
  "device_id": 1,
  "temperature": 27.45,
  "recorded_at": "2026-05-07T13:30:00+07:00",
  "metadata": {
    "battery": 89,
    "signal": -62
  }
}
```

Field:

| Field | Wajib | Tipe | Keterangan |
| --- | --- | --- | --- |
| `device_id` | Ya | integer | ID device yang sudah terdaftar di aplikasi. |
| `temperature` | Ya | numeric | Nilai suhu, valid dari `-99.99` sampai `999.99`. |
| `recorded_at` | Tidak | date/datetime | Waktu pembacaan suhu. Disarankan dikirim agar grafik time series akurat. |
| `metadata` | Tidak | object | Data tambahan dari perangkat, misalnya baterai, sinyal, firmware, atau sensor ID. |

### Contoh cURL

```bash
curl -X POST http://127.0.0.1:8001/api/temperature-readings \
  -H "Authorization: Bearer TOKEN_ANDA" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "device_id": 1,
    "temperature": 27.45,
    "recorded_at": "2026-05-07T13:30:00+07:00",
    "metadata": {
      "battery": 89,
      "signal": -62
    }
  }'
```

### Response Berhasil

Status HTTP: `201 Created`

```json
{
  "message": "Temperature reading accepted.",
  "data": {
    "id": 123,
    "device_id": 1,
    "temperature": "27.45",
    "recorded_at": "2026-05-07T06:30:00.000000Z"
  }
}
```

### Error Umum

`401 Unauthorized`

Token tidak dikirim, token salah, atau token sudah dicabut.

`403 Forbidden`

Token valid, tetapi tidak memiliki ability `temperature:write`.

`422 Unprocessable Entity`

Body request tidak valid. Contoh penyebab:

- `device_id` tidak ada di tabel device.
- `temperature` kosong, bukan angka, atau di luar rentang valid.
- `recorded_at` bukan format tanggal yang valid.
- `metadata` bukan object JSON.

### Rekomendasi Pengiriman dari Device

- Kirim data setiap 5 menit agar sesuai dengan grafik time series aplikasi.
- Gunakan waktu ISO 8601 dengan timezone, misalnya `2026-05-07T13:30:00+07:00`.
- Simpan token di konfigurasi perangkat, bukan di source code publik.
- Jika device gagal mengirim data karena koneksi internet, simpan sementara di buffer lokal lalu kirim ulang saat koneksi pulih.
- Untuk melihat data yang masuk, gunakan menu `Data Suhu`.
- Untuk melihat pergerakan suhu, gunakan menu `Grafik Suhu`.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
