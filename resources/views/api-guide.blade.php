<x-layouts.app title="Panduan API">
    <div class="mb-4">
        <h1 class="h3 mb-1 d-flex align-items-center gap-2">
            <i data-lucide="book-open" class="text-success"></i>
            <span>Panduan API Input Suhu</span>
        </h1>
        <p class="text-muted mb-0">Panduan integrasi perangkat IoT untuk mengirim pembacaan suhu ke aplikasi.</p>
    </div>

    <div class="row g-4">
        <div class="col-xl-7">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h2 class="h5 mb-3">Endpoint</h2>
                    <div class="bg-light border rounded p-3 mb-3">
                        <code>POST {{ url('/api/temperature-readings') }}</code>
                    </div>

                    <h2 class="h5 mb-3">Header Request</h2>
                    <pre class="bg-light border rounded p-3 mb-0"><code>Authorization: Bearer TOKEN_ANDA
Accept: application/json
Content-Type: application/json</code></pre>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h2 class="h5 mb-3">Body JSON</h2>
                    <pre class="bg-light border rounded p-3 mb-0"><code>{
  "device_id": 1,
  "temperature": 27.45,
  "recorded_at": "2026-05-07T13:30:00+07:00",
  "metadata": {
    "battery": 89,
    "signal": -62
  }
}</code></pre>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h2 class="h5 mb-3">Contoh cURL</h2>
                    <pre class="bg-light border rounded p-3 mb-0"><code>curl -X POST {{ url('/api/temperature-readings') }} \
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
  }'</code></pre>
                </div>
            </div>
        </div>

        <div class="col-xl-5">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h2 class="h5 mb-3">Cara Membuat Token</h2>
                    <ol class="mb-0 ps-3">
                        <li>Login sebagai admin.</li>
                        <li>Buka menu <span class="fw-semibold">API Token</span>.</li>
                        <li>Klik <span class="fw-semibold">Buat Token</span>.</li>
                        <li>Pilih user pemilik token.</li>
                        <li>Centang ability <code>temperature:write</code>.</li>
                        <li>Simpan token yang muncul karena hanya ditampilkan sekali.</li>
                    </ol>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h2 class="h5 mb-3">Field Request</h2>
                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Wajib</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code>device_id</code></td>
                                    <td>Ya</td>
                                    <td>ID device yang sudah terdaftar.</td>
                                </tr>
                                <tr>
                                    <td><code>temperature</code></td>
                                    <td>Ya</td>
                                    <td>Angka dari <code>-99.99</code> sampai <code>999.99</code>.</td>
                                </tr>
                                <tr>
                                    <td><code>recorded_at</code></td>
                                    <td>Tidak</td>
                                    <td>Waktu pembacaan. Disarankan ISO 8601 dengan timezone.</td>
                                </tr>
                                <tr>
                                    <td><code>metadata</code></td>
                                    <td>Tidak</td>
                                    <td>Object JSON untuk data tambahan device.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h2 class="h5 mb-3">Response dan Error</h2>
                    <div class="mb-3">
                        <div class="fw-semibold">Berhasil: <code>201 Created</code></div>
                        <pre class="bg-light border rounded p-3 mt-2 mb-0"><code>{
  "message": "Temperature reading accepted.",
  "data": {
    "id": 123,
    "device_id": 1,
    "temperature": "27.45",
    "recorded_at": "2026-05-07T06:30:00.000000Z"
  }
}</code></pre>
                    </div>
                    <ul class="mb-0 ps-3">
                        <li><code>401</code>: token tidak valid atau tidak dikirim.</li>
                        <li><code>403</code>: token tidak punya ability <code>temperature:write</code>.</li>
                        <li><code>422</code>: body request tidak valid.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
