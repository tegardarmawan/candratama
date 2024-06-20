<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
        <?php foreach ($greeting as $greet) : ?>
            <h1><?= $greet->title ?> <span><?= $greet->sub_title ?></span></h1>
            <h2><?= $greet->content ?></h2>
            <div class="d-flex">
                <a href="<?= $greet->link ?>" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<!-- End Hero -->

<main id="main">

    <!-- ======= Featured Services Section ======= -->
    <!-- <section id="featured-services" class="featured-services">
        <div class="container" data-aos="fade-up">
            <div class="text-center">
                <h2>Visi Misi Candratama Granites</h2>
                <p>Visi Misi</p>
            </div>
        </div>
    </section> -->
    <!-- End Featured Services Section -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Tentang Kami</h2>
                <h3>Sekilas Mengenai <span>Candratama Granites</span></h3>
                <p>Candratama Granites, berangkat dari sebuah ... </p>
            </div>

            <div class="row">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                    <img src="<?= base_url() ?>assets/img/about.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
                    <?php foreach ($visi as $vismis) : ?>
                        <h3><?= $vismis->title ?></h3>
                        <p class="fst-italic mb-0">
                            <?= $vismis->sub_title ?>
                        </p>
                    <?php endforeach; ?>
                    <ul>
                        <?php foreach ($visi as $vismis) : ?>
                            <li>
                                <i class="bx bx-store-alt"></i>
                                <div>
                                    <h6><?= $vismis->content ?></h6>
                                    <p><?= $vismis->sub_content ?></p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->


    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-4 col-md-12">
                    <div class="count-box">
                        <i class="bi bi-emoji-smile"></i>
                        <span data-purecounter-start="0" data-purecounter-end="<?= $client ?>" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Pelanggan Ditangani</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 mt-5 mt-md-0">
                    <div class="count-box">
                        <i class="bi bi-journal-richtext"></i>
                        <span data-purecounter-start="0" data-purecounter-end="<?= $project ?>" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Project Telah Diselesaikan</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 mt-5 mt-lg-0">
                    <div class="count-box">
                        <i class="bi bi-people"></i>
                        <span data-purecounter-start="0" data-purecounter-end="<?= $karyawan ?>" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Pekerja Keras</p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Counts Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients section-bg">
        <div class="container" data-aos="zoom-in">

            <div class="row">

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="<?= base_url() ?>assets/img/clients/client-1.png" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="<?= base_url() ?>assets/img/clients/client-2.png" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="<?= base_url() ?>assets/img/clients/client-3.png" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="<?= base_url() ?>assets/img/clients/client-4.png" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="<?= base_url() ?>assets/img/clients/client-5.png" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="<?= base_url() ?>assets/img/clients/client-6.png" class="img-fluid" alt="">
                </div>

            </div>

        </div>
    </section><!-- End Clients Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Layanan</h2>
                <?php foreach ($layanan as $service) : ?>
                    <h3><span><?= $service->title ?></span></h3>
                    <p><?= $service->content ?></p>
                <?php endforeach; ?>
            </div>
            <div class="row">
                <?php
                $layanan_count = count($layanan); // Menghitung jumlah item
                $col_class = 'col-lg-4'; // Default class

                if ($layanan_count == 2) {
                    $col_class = 'col-lg-6'; // Jika ada 2 item, gunakan col-lg-6
                } elseif ($layanan_count == 1) {
                    $col_class = 'col-lg-12'; // Jika ada 1 item, gunakan col-lg-12
                }

                foreach ($layanan as $srv) : ?>
                    <div class="<?= $col_class ?> col-md-12 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bxl-dribbble"></i></div>
                            <h6><a href=""><?= $srv->sub_title ?></a></h6>
                            <p><?= $srv->sub_content ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="zoom-in">

            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    <?php foreach ($testi as $test) : ?>
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="<?= base_url('assets/img/testimonials/') . $test->file_name ?>" class="testimonial-img" alt="testimonial">
                                <h3><?= $test->title ?></h3>
                                <h6><?= $test->sub_title ?></h6>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    <?= $test->content ?>
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Portfolio</h2>
                <h3>Portofolio <span>Candratama Granites</span></h3>
                <p></p>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <?php foreach ($category as $ctg) : ?>
                            <li data-filter=".<?= str_replace(' ', '-', $ctg->name) ?>"><?= $ctg->name ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                <?php foreach ($portofolio as $porto) : ?>
                    <div class="col-lg-4 col-md-6 portfolio-item <?= str_replace(' ', '-', $porto->name) ?>">
                        <img src="<?= base_url('assets/img/portfolio/') . $porto->file_name ?>" class="img-fluid" alt="portofolio.jpg">
                        <div class="portfolio-info">
                            <h6><?= $porto->title ?></h6>
                            <p><?= $porto->description ?></p>
                            <a href="<?= base_url('assets/img/portfolio/') . $porto->file_name ?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="<?= $porto->title ?>"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

        </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Team Section ======= -->
    <!-- End Team Section -->

    <!-- ======= Pricing Section ======= -->
    <!-- End Pricing Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Contact</h2>
                <h3><span>Hubungi Kami</span></h3>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <?php foreach ($company as $comp) : ?>
                    <div class="col-lg-6">
                        <div class="info-box mb-4">
                            <i class="bx bx-map"></i>
                            <h3>Alamat Candratama Granites</h3>
                            <p><?= $comp->address ?></p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  mb-4">
                            <i class="bx bx-envelope"></i>
                            <h3>Email</h3>
                            <h3><?= $comp->email ?></h3>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  mb-4">
                            <i class="bx bx-phone-call"></i>
                            <h3>Whatsapp</h3>
                            <p><?= $comp->phone_number ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">

                <div class="col-lg-6 ">
                    <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.7603597214343!2d111.99530787380579!3d-7.815172177601349!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7856dfa43c3cb9%3A0xda594b3c9e594402!2sCandratama%20Granites%20Jasa%20Interior%20Kediri!5e0!3m2!1sid!2sid!4v1718335272500!5m2!1sid!2sid" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>


                <div class="col-lg-6">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="col form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->