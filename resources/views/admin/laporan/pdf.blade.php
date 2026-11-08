<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rental GearCamp</title>

    <style>
        @page {
            margin: 30px 32px 45px;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; /* Font standar PDF formal */
            font-size: 9px;
            color: #26352b;
            line-height: 1.5;
        }

        /* =========================================
           KOP SURAT
           ========================================= */
        .kop {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px solid #1f4d3a;
            margin-bottom: 20px;
        }

        .kop td {
            border: none;
            padding: 0 0 13px;
            vertical-align: middle;
        }

        .logo-container {
            width: 65px;
            vertical-align: middle;
        }

        /* SVG Logo agar pasti muncul di PDF */
        .logo-svg {
            width: 55px;
            height: 55px;
            display: block;
            fill: #1f4d3a;
        }

        .brand {
            padding-left: 12px !important;
        }

        .brand h1 {
            margin: 0;
            color: #1f4d3a;
            font-size: 24px;
            letter-spacing: 2px;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-weight: bold;
        }

        .brand p {
            margin: 2px 0 0;
            color: #68766c;
            font-size: 8.5px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .brand p.sub {
            font-weight: normal;
            letter-spacing: 0;
            font-size: 8px;
            margin-top: 4px;
        }

        .kontak {
            text-align: right;
            color: #526056;
            font-size: 8px;
            line-height: 1.6;
            vertical-align: bottom;
        }

        /* =========================================
           JUDUL & INFORMASI
           ========================================= */
        .judul {
            text-align: center;
            margin: 22px 0 17px;
        }

        .judul h2 {
            color: #1f4d3a;
            font-size: 16px;
            margin: 0 0 5px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .judul p {
            color: #78847a;
            margin: 0;
            font-size: 8.5px;
            font-weight: 600;
        }

        .info-wrapper {
            background: #f9faf9;
            border: 1px solid #e5e7eb;
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .informasi {
            width: 100%;
            border-collapse: collapse;
        }

        .informasi td {
            border: none;
            padding: 4px 0;
            font-size: 8.5px;
        }

        .informasi .label {
            width: 120px;
            font-weight: bold;
            color: #374151;
        }

        .informasi .titik {
            width: 15px;
            color: #6b7280;
        }

        .section-title {
            font-size: 10px;
            color: #1f4d3a;
            font-weight: bold;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #dce5dc;
        }

        /* =========================================
           TABEL UTAMA
           ========================================= */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .data-table thead {
            display: table-header-group;
        }

        .data-table th {
            background: #1f4d3a;
            color: white;
            border: 1px solid #1f4d3a;
            padding: 9px 6px;
            text-align: center;
            font-size: 7.5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .data-table td {
            border: 1px solid #dce5dc;
            padding: 8px 6px;
            vertical-align: top;
            font-size: 8px;
        }

        .data-table tbody tr:nth-child(even) {
            background: #f9faf9;
        }

        .center { text-align: center; }
        .right { text-align: right; }

        .kode {
            color: #1f4d3a;
            font-weight: bold;
        }

        .nama { font-weight: bold; color: #111827; }
        .email { color: #6b7280; font-size: 7.5px; }

        /* =========================================
           TABEL ANAK (RINCIAN BARANG)
           ========================================= */
        .barang-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .barang-table th {
            background: #eaf2ed;
            color: #1f4d3a;
            border: 1px solid #cce0d4;
            padding: 5px 4px;
            font-size: 7px;
            text-align: center;
            text-transform: none;
        }

        .barang-table td {
            border: 1px solid #dce5dc;
            padding: 5px 4px;
            font-size: 7.5px;
            color: #374151;
        }

        .barang-table tr:last-child td {
            border-bottom: none;
        }

        .harga {
            font-weight: bold;
            color: #1f4d3a;
            font-size: 8.5px;
        }

        .kosong {
            text-align: center;
            padding: 30px !important;
            color: #6b7280;
            font-style: italic;
        }

        /* =========================================
           TANDA TANGAN
           ========================================= */
        .ttd {
            width: 100%;
            border-collapse: collapse;
            margin-top: 35px;
            page-break-inside: avoid;
        }

        .ttd td {
            border: none;
            vertical-align: top;
        }

        .ttd-kanan {
            text-align: center;
            width: 220px;
        }

        .ruang-ttd {
            height: 65px;
        }

        .nama-admin {
            font-size: 11px;
            font-weight: bold;
            color: #1f4d3a;
            text-decoration: underline;
        }

        .jabatan {
            font-size: 8.5px;
            color: #6b7280;
            margin-top: 2px;
        }

        /* =========================================
           FOOTER
           ========================================= */
        .footer {
            position: fixed;
            bottom: -28px;
            left: 0;
            right: 0;
            border-top: 1px solid #dce5dc;
            padding-top: 8px;
            font-size: 7.5px;
            color: #89948b;
        }

        .footer table {
            width: 100%;
            border-collapse: collapse;
        }

        .footer td {
            border: none;
        }

        .page-number:after {
            content: counter(page);
        }

        .page-count:after {
            content: counter(pages);
        }
    </style>
</head>

<body>

    {{-- KOP SURAT --}}
    <table class="kop">
        <tr>
            <td class="logo-container">
                <!-- SVG Logo Gunung dan Matahari (Warna GearCamp) -->
                <svg class="logo-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <!-- Matahari -->
                    <circle cx="16" cy="7" r="2.5" fill="#d49a4a" />
                    <!-- Gunung -->
                    <path d="M3.5 18L10 9.5l4.5 5.5 2.5-3 3.5 6H3.5z" fill="#1f4d3a" />
                    <path d="M10 9.5l4.5 5.5 2.5-3 3.5 6H10V9.5z" fill="#183b2b" />
                </svg>
            </td>

            <td class="brand">
                <h1>GEARCAMP</h1>
                <p>CAMPING EQUIPMENT RENTAL</p>
                <p class="sub">Sistem Informasi Penyewaan Peralatan Camping</p>
            </td>

            <td class="kontak">
                Jl. Petualangan No. 123<br>
                Padang, Sumatera Barat<br>
                Telp. 0812-3456-7890<br>
                Email: info@gearcamp.test<br>
                Website: www.gearcamp.test
            </td>
        </tr>
    </table>

    {{-- JUDUL LAPORAN --}}
    <div class="judul">
        <h2>LAPORAN DATA PENYEWAAN</h2>
        <p>GEARCAMP CAMPING EQUIPMENT RENTAL</p>
    </div>

    {{-- INFO LAPORAN --}}
    <div class="info-wrapper">
        <table class="informasi">
            <tr>
                <td class="label">Tanggal Cetak</td>
                <td class="titik">:</td>
                <td>{{ now()->translatedFormat('d F Y H:i') }} WIB</td>
            </tr>

            <tr>
                <td class="label">Periode Laporan</td>
                <td class="titik">:</td>
                <td>
                    {{ request('tanggal_mulai') ? \Carbon\Carbon::parse(request('tanggal_mulai'))->translatedFormat('d M Y') : 'Semua tanggal' }}
                    s/d
                    {{ request('tanggal_selesai') ? \Carbon\Carbon::parse(request('tanggal_selesai'))->translatedFormat('d M Y') : 'Semua tanggal' }}
                </td>
            </tr>

            <tr>
                <td class="label">Status Rental</td>
                <td class="titik">:</td>
                <td>{{ request('status') ? ucfirst(request('status')) : 'Semua status' }}</td>
            </tr>
        </table>
    </div>

    <div class="section-title">A. DATA TRANSAKSI PENYEWAAN</div>

    {{-- TABEL UTAMA --}}
    <table class="data-table">
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="11%">Kode Rental</th>
                <th width="15%">Data Penyewa</th>
                <th width="13%">Tanggal Sewa</th>
                <th width="6%">Durasi</th>
                <th width="25%">Rincian Barang</th>
                <th width="11%">Total Harga</th>
                <th width="8%">Pembayaran</th>
                <th width="7%">Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($laporan as $index => $rental)
                <tr>
                    <td class="center">{{ $index + 1 }}</td>

                    <td class="center kode">
                        {{ $rental->kode_rental }}
                    </td>

                    <td>
                        <div class="nama">{{ $rental->user->name ?? '-' }}</div>
                        <div class="email">{{ $rental->user->email ?? '-' }}</div>
                    </td>

                    <td class="center">
                        {{ \Carbon\Carbon::parse($rental->tanggal_mulai)->format('d/m/Y') }}
                        <br><span style="color:#9ca3af;font-size:6.5px;">s/d</span><br>
                        {{ \Carbon\Carbon::parse($rental->tanggal_selesai)->format('d/m/Y') }}
                    </td>

                    <td class="center">
                        <strong>{{ $rental->total_hari }}</strong> hari
                    </td>

                    {{-- TABEL ANAK RINCIAN BARANG --}}
                    <td>
                        <table class="barang-table">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Qty</th>
                                    <th>Harga/Hari</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rental->details as $detail)
                                    <tr>
                                        <td>{{ $detail->barang->nama_barang ?? 'Barang dihapus' }}</td>
                                        <td class="center">{{ $detail->jumlah }}</td>
                                        <td class="right">
                                            Rp{{ number_format($detail->harga_per_hari, 0, ',', '.') }}
                                        </td>
                                        <td class="right">
                                            Rp{{ number_format($detail->subtotal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>

                    <td class="right harga">
                        Rp{{ number_format($rental->total_harga, 0, ',', '.') }}
                    </td>

                    <td class="center">
                        {{ strtoupper(str_replace('_', ' ', $rental->status_pembayaran)) }}
                    </td>

                    <td class="center">
                        {{ ucfirst($rental->status) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="kosong">
                        Tidak ada data penyewaan yang sesuai dengan filter.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- TANDA TANGAN --}}
    <table class="ttd">
        <tr>
            <td></td>
            <td class="ttd-kanan">
                Padang, {{ now()->translatedFormat('d F Y') }}<br>
                Mengetahui,<br>
                Admin GearCamp

                <div class="ruang-ttd"></div>

                <div class="nama-admin">
                    {{ $admin->name ?? 'Administrator' }}
                </div>

                <div class="jabatan">
                    Administrator
                </div>
            </td>
        </tr>
    </table>

    {{-- FOOTER --}}
    <div class="footer">
        <table>
            <tr>
                <td width="75%">
                    Dokumen ini dibuat secara otomatis oleh Sistem GearCamp.
                </td>
                <td width="25%" class="right">
                    Halaman <span class="page-number"></span>
                    dari <span class="page-count"></span>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>