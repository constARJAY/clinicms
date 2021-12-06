
<main>

<div class="slider-area hero-bg-color hero-height2">
<div class="slider-active">

<div class="single-slider">
<div class="slider-cap-wrapper">
<div class="hero-caption hero-caption2">
<h2 data-animation="fadeInUp" data-delay=".2s">Anouncement</h2>

<div class="hero-shape2">
<img src="<?=base_url()?>assets/website/assets/img/hero/tooth2.png" alt="">
</div>
</div>
<div class="hero-img hero-img2 position-relative">
<center><img src="<?=base_url()?>assets/website/assets/img/hero/h1_hero1.png" alt="" data-animation="pulse" data-transition-duration="5s"></center>
</div>
</div>
</div>
</div>
</div>


<section class="testimonial-area2 section-padding">
<div class="container-fluid fix pb-40">
<div class="row justify-content-center">
<div class="col-xxl6 col-xl-7 col-lg-7 col-md-6">
<div class="testimonial-active owl-carousel ">
    <?php foreach ($anouncement as $key => $value):?>
        <div class="single-testimonial ">

            <div class="testimonial-caption ">
                <div class="testimonial-top-cap">
                    <h5><?=$value["title"]?></h5>
                    <p><?=$value["description"]?></p>
                </div>

                <div class="testimonial-founder d-flex align-items-center">
                    <div class="founder-text">
                        <span>- <?=$value["fullname"]?></span>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;?>

</div>
</div>
</div>
</div>
</section>




</main>
