@extends('layouts.default')

@push('page-title')
RW - Dashboard
@endpush

@push('custom-style')
    <style>
        .page-background {
            background-image: url("{{ asset('img/login-image.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 75vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .container {
            position: relative;
            z-index: 1;
        }

        /* Card container */
        .card {
            position: relative;
            opacity: 0;
            transform: translateY(30px) scale(0.95);
            animation: fadeInUpSmooth 1s ease-out forwards;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            border: none;
            border-radius: 15px;
            background: linear-gradient(135deg, #4e73df, #1cc88a); /* Gradient background */
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1); /* Soft shadow */
            color: white;
            overflow: hidden;
        }

        .card-body {
            padding: 25px;
        }

        /* Card title with icon */
        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            color: white;
        }

        .card-title i {
            font-size: 1.5rem;
            margin-right: 10px;
            animation: iconPulse 1.5s infinite;
        }

        /* Animating icons */
        @keyframes iconPulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }

        /* Hover effect */
        .card:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.2); /* Deeper shadow */
        }

        /* Animation for fadeIn */
        @keyframes fadeInUpSmooth {
            0% {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            50% {
                opacity: 0.7;
                transform: translateY(10px) scale(1.02);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Delayed animation for cards */
        .card:nth-child(1) {
            animation-delay: 0.3s;
        }
        .card:nth-child(2) {
            animation-delay: 0.5s;
        }
        .card:nth-child(3) {
            animation-delay: 0.7s;
        }

        .card-text {
            font-size: 1rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.85);
        }

        .card-body:after {
            content: '';
            display: block;
            width: 50%;
            height: 2px;
            background: rgba(255, 255, 255, 0.3);
            margin-top: 15px;
            margin-bottom: 15px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Styling for the news section */
        .news-section {
            margin-top: 50px;
            padding: 40px;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUpSmooth 1.2s ease-out forwards;
        }

        /* News heading */
        .news-section h4 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
            color: #f0f0f0;
            animation: textGlow 2s ease-in-out infinite alternate;
        }

        /* Animating the title */
        @keyframes textGlow {
            0% {
                color: #f0f0f0;
            }
            50% {
                color: #1cc88a;
            }
            100% {
                color: #f0f0f0;
            }
        }

        .news-section p {
            font-size: 1.2rem;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.85);
        }

        /* Fade-in animation for the news section */
        @keyframes fadeInUpSmooth {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Adding hover effect to news */
        .news-section:hover {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
            transform: translateY(-5px);
        }

    </style>
@endpush

@section('content')
<div class="page-background" style="background-image: url('{{ asset('assets/img/login.jpg') }}');">

    <div class="container text-center">
        <h1 class="mb-4 text-white">Dashboard Kecamatan Batuceper</h1>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm rounded-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="mdi mdi-office-building me-2"></i> Profil Wilayah
                        </h5>
                        <p class="card-text">
                            Kecamatan Batuceper adalah salah satu kecamatan di Kota Tangerang, Provinsi Banten.
                            Terdiri dari beberapa kelurahan dan memiliki posisi strategis dekat dengan Bandara Soekarno-Hatta.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm rounded-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="mdi mdi-map-marker me-2"></i> Lokasi
                        </h5>
                        <p class="card-text">
                            Berbatasan dengan Kecamatan Neglasari di utara, Kecamatan Cibodas di timur, dan Kecamatan Benda di barat.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm rounded-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="mdi mdi-account-group-outline me-2"></i> Jumlah Penduduk
                        </h5>
                        <p class="card-text">
                            Perkiraan jumlah penduduk sekitar 90.000 jiwa dengan kepadatan yang tinggi di area permukiman padat.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- News Section with Animation -->
        <div class="news-section">
            <h4><i class="mdi mdi-newspaper me-2"></i> Berita Terbaru</h4>
            <p>Informasi berita atau kegiatan terkini di wilayah Batuceper bisa ditampilkan di sini.</p>
        </div>
    </div>
</div>
@endsection
