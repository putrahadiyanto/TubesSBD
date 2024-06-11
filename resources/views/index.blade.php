@extends('layouts.app')

@section('content')

<main class="main">

  <!-- Hero Section -->
  <section id="hero" class="hero section">

    <div class="info d-flex align-items-center">
      <div class="container">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-6 text-center">
            <h2>Selamat Datang di Gor Haji Ridho</h2>
            <p>Tingkatkan Performa dan Keahlianmu di Gor Badminton Kami, Tempat Dimana Setiap Smash Menjadi Kenangan yang Mengesankan. Bergabunglah dengan Komunitas Badminton kami untuk Membangun Kebugaran, Keterampilan, dan Pertemanan yang Tak Terlupakan. Bersiaplah untuk Meraih Prestasi dan Kemenangan, karena di Sini, Setiap Pukulan adalah Langkah Menuju Kemenanganmu yang Gemilang!</p>
            <a href="{{route('booking')}}" class="btn-get-started">Sewa Sekarang</a>
          </div>
        </div>
      </div>
    </div>

    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

      <div class="carousel-item">
        <img src="assets/img/fotofor.jpg" alt="">
      </div>

      <div class="carousel-item active">
        <img src="assets/img/fotomember.jpg" alt="">
      </div>

      <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>

  </section><!-- /Hero Section -->

  <!-- Bagian Mulai -->
<section id="get-started" class="get-started section">

  <div class="container">

    <div class="row justify-content-between gy-4">

      <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
        <div class="content">
          <h3>Fakta Menarik tentang Kesehatan</h3>
          <p>Tahukah Anda? Bermain badminton selama satu jam dapat membakar hingga 450 kalori! Selain itu, olahraga ini juga membantu meningkatkan keseimbangan, koordinasi, dan kebugaran kardiovaskular Anda. Jadi, mari jaga kesehatan dengan berolahraga secara teratur.</p>
          <p>Badminton juga baik untuk kesehatan mental karena dapat membantu mengurangi stres dan meningkatkan suasana hati. Nikmati permainan dan rasakan manfaat kesehatannya!</p>
        </div>
      </div>

      <div class="col-lg-5" data-aos="zoom-out" data-aos-delay="200">
        <form action="forms/quote.php" method="post" class="php-email-form">
          <h3>Dapatkan Saran dan Masukan</h3>
          <p>Silakan isi formulir di bawah ini untuk memberikan saran dan masukan kepada kami.</p>
          <div class="row gy-3">

            <div class="col-md-12">
              <input type="text" name="name" class="form-control" placeholder="Nama" required="">
            </div>

            <div class="col-md-12">
              <input type="email" class="form-control" name="email" placeholder="Email" required="">
            </div>

            <div class="col-md-12">
              <input type="text" class="form-control" name="phone" placeholder="Telepon" required="">
            </div>

            <div class="col-md-12">
              <textarea class="form-control" name="message" rows="6" placeholder="Silakan isi keluhan dan testimoni Anda tentang GOR Badminton H Ridho" required=""></textarea>
            </div>

            <div class="col-md-12 text-center">
              <div class="loading">Memuat</div>
              <div class="error-message"></div>
              <div class="sent-message">Saran dan masukan Anda telah berhasil dikirim. Terima kasih!</div>

              <button type="submit">Kirim Saran dan Masukan</button>
            </div>

          </div>
        </form>
      </div><!-- Akhir Formulir Saran dan Masukan -->

    </div>

  </div>

</section><!-- /Bagian Mulai -->
  <!-- Services Section -->
  <section id="services" class="services section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Services kami</h2>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="row gy-4">
    
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="fa-solid fa-shuttlecock"></i>
            </div>
            <h3>Penyewaan Lapangan</h3>
            <p>Kami menawarkan lapangan badminton berkualitas tinggi dengan harga terjangkau. Lapangan kami dilengkapi dengan fasilitas modern untuk memastikan kenyamanan Anda.</p>
            <a href="#" class="readmore stretched-link">Selengkapnya <i class="bi bi-arrow-right"></i></a>
          </div>
        </div><!-- Akhir Item Layanan -->
    
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="fa-solid fa-racket"></i>
            </div>
            <h3>Perlengkapan Badminton</h3>
            <p>Kami menyediakan perlengkapan badminton seperti raket, kok, dan sepatu yang bisa Anda sewa atau beli. Semua perlengkapan kami berkualitas tinggi dan terawat dengan baik.</p>
            <a href="#" class="readmore stretched-link">Selengkapnya <i class="bi bi-arrow-right"></i></a>
          </div>
        </div><!-- Akhir Item Layanan -->
    
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="fa-solid fa-users"></i>
            </div>
            <h3>Pelatihan dan Kursus</h3>
            <p>Kami menyediakan pelatihan dan kursus badminton untuk berbagai tingkat keahlian, dari pemula hingga profesional, dengan pelatih berpengalaman dan bersertifikat.</p>
            <a href="#" class="readmore stretched-link">Selengkapnya <i class="bi bi-arrow-right"></i></a>
          </div>
        </div><!-- Akhir Item Layanan -->
    
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="fa-solid fa-calendar-alt"></i>
            </div>
            <h3>Reservasi Online</h3>
            <p>Kemudahan dalam memesan lapangan secara online melalui sistem reservasi kami. Pilih waktu yang sesuai dengan jadwal Anda dan pastikan lapangan tersedia.</p>
            <a href="#" class="readmore stretched-link">Selengkapnya <i class="bi bi-arrow-right"></i></a>
          </div>
        </div><!-- Akhir Item Layanan -->
    
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="fa-solid fa-trophy"></i>
            </div>
            <h3>Turnamen dan Kompetisi</h3>
            <p>Kami menyelenggarakan berbagai turnamen dan kompetisi badminton untuk semua kategori usia dan tingkat keahlian. Ikuti dan uji kemampuan Anda!</p>
            <a href="#" class="readmore stretched-link">Selengkapnya <i class="bi bi-arrow-right"></i></a>
          </div>
        </div><!-- Akhir Item Layanan -->
    
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="fa-solid fa-users-cog"></i>
            </div>
            <h3>Event dan Kegiatan Khusus</h3>
            <p>Kami juga menyediakan lapangan untuk event dan kegiatan khusus seperti gathering perusahaan, acara sekolah, atau kegiatan komunitas.</p>
            <a href="#" class="readmore stretched-link">Selengkapnya <i class="bi bi-arrow-right"></i></a>
          </div>
        </div><!-- Akhir Item Layanan -->
    
      </div>
    
    </div>
    
    </section><!-- /Bagian Layanan -->
    
    </main>
    
    @endsection
    