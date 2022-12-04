<!-- start banner Area -->
<section id="home">
	<div class="container-fluid" style="padding: 0;">

		<div class="test">
			<div id="main-carousel" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#main-carousel" data-slide-to="0" class="active"></li>
					<li data-target="#main-carousel" data-slide-to="1"></li>
					<li data-target="#main-carousel" data-slide-to="2"></li>
				</ol>

				<div class="carousel-inner" role="listbox">
					<style>
						.carousel-item {
							height: 570px;
						}

						#bg {
							object-fit: cover;
						}
					</style>
					<div class="carousel-item active">
						<img id="bg" src="<?= base_url('assets/') ?>img/bg-ugd.jpg" class="img-responsive fill" alt="Responsive image">
						<div class="carousel-caption">
							<h3 style="color: white !important">Fasilitas UGD</h3>
							<p>Pelayanan Gawat Darurat hadir melayani selama 24 jam untuk memenuhi kebutuhan anda akan pelayanan kasus gawat darurat medis, bedah maupun non bedah.</p>
						</div>
					</div>
					<div class="carousel-item">
						<img id="bg" src="<?= base_url('assets/') ?>img/bg-ambulan.jpg" class="img-responsive fill" alt="Responsive image">
						<div class="carousel-caption">
							<h3 style="color: white !important">Layanan Ambulan</h3>
							<p>Untuk memberikan kemudahan dan pelayanan bagi pasien, Klinik PKU Muhammadiyah Gandrungmangu menyediakan layanan ambulan 24 jam yang didampingi oleh tim medis & paramedik profesional.</p>
						</div>
					</div>
					<div class="carousel-item">
						<img id="bg" src="<?= base_url('assets/') ?>img/bg-dokter.jpg" class="img-responsive fill" alt="Responsive image">
						<div class="carousel-caption">
							<h3 style="color: white !important">Slide 03</h3>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam, ut beatae porro ullam quidem officia
								dignissimos facilis? Blanditiis nesciunt labore pariatur quaerat exercitationem quibusdam modi!</p>
						</div>
					</div>
				</div>

				<a href="#main-carousel" class="carousel-control-prev" data-slide="prev">
					<span class="carousel-control-prev-icon"></span>
					<span class="sr-only" aria-hidden="true">Prev</span>
				</a>
				<a href="#main-carousel" class="carousel-control-next" data-slide="next">
					<span class="carousel-control-next-icon"></span>
					<span class="sr-only" aria-hidden="true">Next</span>
				</a>
			</div>
		</div>

	</div>
</section>
<!-- End banner Area -->

<!-- Start service Area -->
<section class="section-gap">
	<div class="container">
		<div class="row">
			<div class="col mb-3">
				<div class="card" style="padding:10px; background-color:#EBEDEE; height: 100%; border: 0; border-radius: 0; box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.2); background: linear-gradient(rgba(255,255,255,.7), rgba(255,255,255,.7)), url(<?= base_url('assets/') ?>img/bg-dokter.jpg) 20% 1%/cover no-repeat;">
					<div class="card-body d-flex flex-column" style="height: 100%;">
						<h5 class="card-title">Jadwal Dokter</h5>
						<p class="card-text" style="font-weight: 400; color:black">Cek Jadwal Praktik Dokter.</p>
						<a href="<?= base_url() ?>page/jadwal_dokter" class="genric-btn primary radius mt-auto ml-auto">Cek Sekarang</a>
					</div>
				</div>
			</div>

			<div class="col mb-3">
				<div class="card" style="padding:10px; background-color:#EBEDEE; height: 100%; border: 0; border-radius: 0; box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.2); background: linear-gradient(rgba(255,255,255,.7), rgba(255,255,255,.7)), url(<?= base_url('assets/') ?>img/bg-pelayanan.jpg) 20% 1%/cover no-repeat;">
					<div class="card-body d-flex flex-column" style="height: 100%;">
						<h5 class="card-title">Jadwal Pelayanan</h5>
						<p class="card-text" style="font-weight: 400; color:black">Cek jam buka pelayanan dan kunjungan pasien</p>
						<a href="<?= base_url() ?>page/jam_layanan" class="genric-btn primary radius mt-auto ml-auto">Cek Sekarang</a>
					</div>
				</div>
			</div>

			<!-- <div class="col-lg-6 col-md-12">
        <div class="single-service">
          <a href="#">
            <h4>Jadwal Dokter</h4>
          </a>
          <p>
            Cek Jadwal untuk Dokter
          </p>
          <a href="<?= base_url() ?>page/jadwal_dokter" class="genric-btn primary radius small">Baca</a>
        </div>
      </div>
      <div class="col-lg-6 col-md-12">
        <div class="single-service">
          <a href="#">
            <h4>Jadwal Pelayanan</h4>
          </a>
          <p>
            Cek jam buka pelayanan dan kunjungan pasien
          </p>
          <a href="<?= base_url() ?>page/jam_layanan" class="genric-btn primary radius small">Baca</a>
        </div>
      </div> -->
		</div>
	</div>
</section>
<!-- End service Area -->

<!-- Start service Area -->
<section class="section-gap">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="col-md-12 pb-40 header-text">
				<h1 class="pb-10">Berita</h1>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="example-1 card">
					<div class="wrapper" style="background: url(<?= base_url('assets/') ?>img/s5.jpeg) 20% 1%/cover no-repeat;">
						<div class="date">
							<span class="day">12</span>
							<span class="month">Aug</span>
							<span class="year">2016</span>
						</div>
						<div class="data">
							<div class="content">
								<span class="author">Jane Doe</span>
								<h3 class="title" style="text-align: justify;"><a href="#">Khitan Massal Klinik PKU Muhammadiyah Gandrungmangu Diikuti 281 Anak</a></h3>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="example-1 card">
					<div class="wrapper" style="background: url(<?= base_url('assets/') ?>img/s6.jpg) 20% 1%/cover no-repeat;">
						<div class="date">
							<span class="day">12</span>
							<span class="month">Aug</span>
							<span class="year">2016</span>
						</div>
						<div class="data">
							<div class="content">
								<span class="author">Jane Doe</span>
								<h3 class="title"><a href="#">Vivamus odio ante, feugiat eget nisi sit amet, dignissim velit</a></h3>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="example-1 card">
					<div class="wrapper" style="background: url(<?= base_url('assets/') ?>img/s8.jpg) 20% 1%/cover no-repeat;">
						<div class="date">
							<span class="day">12</span>
							<span class="month">Aug</span>
							<span class="year">2016</span>
						</div>
						<div class="data">
							<div class="content">
								<span class="author">Jane Doe</span>
								<h3 class="title"><a href="#">Vivamus odio ante, feugiat eget nisi sit amet, dignissim velit</a></h3>
							</div>
						</div>
					</div>
				</div>
			</div>
			<a href="<?= base_url() ?>page/berita" class="genric-btn primary radius" style="margin-top: 20px;">Berita Lainnya</a>
		</div>
	</div>
</section>
<!-- End service Area -->

<!-- Start home-about Area -->
<section class="home-about-area section-gap relative">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col text-white">
				<h2 class="mb-20 text-white">
					Alamat
				</h2>
				<p class="text-justify mb-40" style="max-width: 80%;">
					Jl. Raya Gandrungmangu, Tambangan, Wringinharjo, Kec. Gandrungmangu, Kabupaten Cilacap, Jawa Tengah 53254
				</p>

				<div class="single-footer-widget mail-chimp">
					<h2 class="mb-20 text-white">Kontak</h2>
					<table class="table" style="color: white; max-width: 80%;">
						<tr>
							<td>Gawat Darurat</td>
							<td>0811-233-8899</td>
						</tr>
						<tr>
							<td>Whatsapp</td>
							<td>022-20277564</td>
						</tr>
						<tr>
							<td>Pusat Panggilan</td>
							<td>0811-235-9988</td>
						</tr>
					</table>
				</div>
			</div>

			<div class="col" style="min-width: 300px;">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126579.7472684171!2d108.79465202882365!3d-7.507452309541276!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e657888b48a2b97%3A0xf18f4def8deb9b8e!2sKlinik%20PKU%20Muhammadiyah%20Gandrungmangu!5e0!3m2!1sen!2sid!4v1614540748316!5m2!1sen!2sid" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
			</div>
		</div>
	</div>
</section>
<!-- End home-about Area -->

<section class="section-gap">
	<div class="container">

	</div>
</section>
<!-- End service Area -->