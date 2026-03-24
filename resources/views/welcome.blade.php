<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Complaint & Feedback System Desa Bitungsari</title>

    <style>
        /* ================= GLOBAL ================= */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f0f2f5;
            font-family: Arial, sans-serif;
            padding-top: 80px;
        }

        a {
            text-decoration: none;
        }

        /* ================= HEADER ================= */
        .top-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: white;
            padding: 12px 40px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            z-index: 1000;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-group a {
            background: #d6812a;
            padding: 6px 14px;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .btn-group a:hover {
            background: #c06e1f;
        }

        .btn-footer {
            background: #2563eb;
        }

        .btn-footer:hover {
            background: #1e40af;
        }

        /* ================= HERO ================= */
        .hero {
            background: linear-gradient(135deg, #1877f2, #0f5ec7);
            padding: 80px 20px;
            color: white;
        }

        .hero-content {
            max-width: 1000px;
            margin: auto;
            text-align: center;
        }

        .hero h2 {
            font-size: 38px;
            margin-bottom: 16px;
        }

        .hero p {
            font-size: 16px;
            line-height: 1.6;
            opacity: 0.95;
        }

        .hero-buttons {
            margin-top: 24px;
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: #d6812a;
            color: white;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: bold;
        }

        .btn-secondary {
            background: white;
            color: #1877f2;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: bold;
        }

        /* ================= INFO ================= */
        .info {
            background: white;
            padding: 60px 20px;
        }

        .info-container {
            max-width: 1000px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .info-card {
            background: #f9fafb;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        }

        .info-card h3 {
            margin-bottom: 10px;
            font-size: 18px;
        }

        .info-card p {
            font-size: 14px;
            color: #555;
            line-height: 1.6;
        }

        /* ================= FEEDBACK ================= */
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 16px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .section-title h3 {
            margin: 0;
            font-size: 24px;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 16px;
            margin-bottom: 20px;
        }

        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #1877f2;
            color: white;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        .post-author {
            font-weight: bold;
            font-size: 14px;
        }

        .post-time {
            font-size: 12px;
            color: gray;
        }

        .post-text {
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 10px;
            white-space: pre-line;
        }

        .post img {
            width: 100%;
            border-radius: 8px;
            margin-top: 8px;
        }

        /* ================= FOOTER================= */
        footer {
            background: #1f2937;
            color: #ccc;
            text-align: center;
            padding: 20px;
            margin-top: 60px;
            font-size: 14px;
        }

        .footer-extra {
            max-width: 1100px;
            margin: 0 auto 20px;
            padding: 30px 20px;

            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 30px;
            text-align: left;
        }

        .footer-extra h4 {
            margin-bottom: 12px;
            font-size: 16px;
            color: #ffffff;
        }

        .footer-extra p {
            margin: 6px 0;
            line-height: 1.6;
            color: #d1d5db;
        }

        .footer-extra a {
            color: #d1d5db;
            text-decoration: none;
        }

        .footer-extra a:hover {
            color: #ffffff;
        }
    </style>
</head>
<body>

{{-- ================= HEADER ================= --}}
<div class="top-header">
    <h1>Desa Bitungsari</h1>
    <div class="btn-group">
        <a href="/admin/login">Login Admin</a>
        <a href="/penduduk/login">Login Penduduk</a>
        <a href="#footer-target" class="btn-footer">Kontak Desa</a>
    </div>
</div>

{{-- ================= HERO ================= --}}
<div class="hero">
    <div class="hero-content">
        <h2>Complaint & Feedback System<br>Desa Bitungsari</h2>
        <p>
            Media resmi masyarakat Desa Bitungsari untuk menyampaikan
            pengaduan, saran, dan masukan demi pelayanan desa yang transparan
            dan berkelanjutan.
        </p>

        <div class="hero-buttons">
            <a href="/penduduk/login" class="btn-primary">Laporkan Pengaduan</a>
            <a href="#feedback" class="btn-secondary">Lihat Feedback</a>
        </div>
    </div>
</div>

{{-- ================= INFO ================= --}}
<div class="info">
    <div class="info-container">
        <div class="info-card">
            <h3>Transparan</h3>
            <p>Setiap pengaduan tercatat dan dapat dipantau secara terbuka.</p>
        </div>
        <div class="info-card">
            <h3>Partisipatif</h3>
            <p>Masyarakat terlibat aktif dalam pembangunan desa.</p>
        </div>
        <div class="info-card">
            <h3>Responsif</h3>
            <p>Perangkat desa merespon pengaduan dengan cepat dan tepat.</p>
        </div>
    </div>
</div>

{{-- ================= FEEDBACK ================= --}}
<div class="container" id="feedback">
    <div class="section-title">
        <h3>Feedback & Informasi Desa</h3>
    </div>

    @foreach ($feedback as $item)
        <div class="card post">
            <div class="post-header">
                <div class="avatar">A</div>
                <div>
                    <div class="post-author">Admin Desa</div>
                    <div class="post-time">{{ $item->created_at->diffForHumans() }}</div>
                </div>
            </div>

            <div class="post-text">{{ $item->keterangan }}</div>

            @if ($item->gambar)
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar Feedback">
            @endif
        </div>
    @endforeach

    {{-- ================= PAGINATION ================= --}}
        <div style="margin-top: 30px; display: flex; justify-content: center;">
        @if ($feedback->hasPages())
        <nav style="display: flex; justify-content: center; align-items: center; gap: 6px; flex-wrap: wrap; margin: 20px 0;">

            {{-- Previous --}}
            @if ($feedback->onFirstPage())
                <span style="padding: 6px 12px; border-radius: 6px; background: #e5e7eb; color: #9ca3af; cursor: not-allowed; font-size: 14px;">&laquo; Previous</span>
            @else
                <a href="{{ $feedback->previousPageUrl() }}" style="padding: 6px 12px; border-radius: 6px; background: #1877f2; color: white; font-size: 14px; text-decoration: none;">&laquo; Previous</a>
            @endif

            {{-- Nomor Halaman --}}
            @php
                $current = $feedback->currentPage();
                $last = $feedback->lastPage();
                $start = max(1, $current - 2);
                $end = min($last, $current + 2);
            @endphp

            {{-- Halaman pertama + titik-titik --}}
            @if ($start > 1)
                <a href="{{ $feedback->url(1) }}" style="padding: 6px 12px; border-radius: 6px; background: #f3f4f6; color: #374151; font-size: 14px; text-decoration: none;">1</a>
                @if ($start > 2)
                    <span style="padding: 6px 6px; font-size: 14px; color: #6b7280;">...</span>
                @endif
            @endif

            {{-- Nomor halaman tengah --}}
            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $current)
                    <span style="padding: 6px 12px; border-radius: 6px; background: #d6812a; color: white; font-weight: bold; font-size: 14px;">{{ $page }}</span>
                @else
                    <a href="{{ $feedback->url($page) }}" style="padding: 6px 12px; border-radius: 6px; background: #f3f4f6; color: #374151; font-size: 14px; text-decoration: none;">{{ $page }}</a>
                @endif
            @endfor

            {{-- Titik-titik + halaman terakhir --}}
            @if ($end < $last)
                @if ($end < $last - 1)
                    <span style="padding: 6px 6px; font-size: 14px; color: #6b7280;">...</span>
                @endif
                <a href="{{ $feedback->url($last) }}" style="padding: 6px 12px; border-radius: 6px; background: #f3f4f6; color: #374151; font-size: 14px; text-decoration: none;">{{ $last }}</a>
            @endif

            {{-- Next --}}
            @if ($feedback->hasMorePages())
                <a href="{{ $feedback->nextPageUrl() }}" style="padding: 6px 12px; border-radius: 6px; background: #1877f2; color: white; font-size: 14px; text-decoration: none;">Next &raquo;</a>
            @else
                <span style="padding: 6px 12px; border-radius: 6px; background: #e5e7eb; color: #9ca3af; cursor: not-allowed; font-size: 14px;">Next &raquo;</span>
            @endif

        </nav>
        @endif
    </div>

</div>

<div id="footer-target"></div>

<footer>
    <div class="footer-extra">
        <div>
            <h4>Desa Bitungsari</h4>
            <p>
                Sistem Complaint & Feedback Desa Bitungsari merupakan media
                resmi masyarakat untuk menyampaikan aspirasi dan pengaduan
                demi pelayanan publik yang lebih baik.
            </p>
        </div>

        <div>
            <h4>Alamat Desa</h4>
            <p>
                Desa Bitungsari<br>
                Kecamatan Ciawi<br>
                Kabupaten Bogor<br>
                Provinsi Jawa Barat
            </p>
        </div>

        <div>
            <h4>Kontak</h4>
            <p>Email: <a href="mailto:desabitungsari@gmail.com">desabitungsari@gmail.com</a></p>
            <p>Telepon: 08xx-xxxx-xxxx</p>
            <p>Jam Layanan: 08.00 – 16.00 WIB</p>
        </div>
    </div>

    © {{ date('Y') }} Desa Bitungsari · Complaint & Feedback System
</footer>

</body>
</html>
