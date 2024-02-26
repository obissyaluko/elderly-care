<?php
include "header.php";
?>
         <!-- BANNER-SECTION -->
         <div class="home-banner-section overflow-hidden home-banner-section2 home-banner-section1 sub-banner">
            <div class="banner-container-box">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-md-0 mb-4 text-md-left text-center d-flex align-items-center">
                            <div class="home-banner-text"  data-aos="fade-up">
                                
                                <h2>Contact Us</h2>
                                <p class="banner-paragraph about-us-p">Want to enquire anything, ask without hesitation</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- offer-section -->
    <div class="offer-section offer-section1 about-offer-section contact-offer-section mt-3"  data-aos="fade-up">
        <h2 class="offer-heading">We alway here to<span class="support"> help you</span></h2>
       <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 mb-lg-0 mb-md-0 mb-3">
                <div class="offer-section-box">
                    <div class="offer-section-inner">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h5>Address</h5>
                    <p>Envato Pty Ltd,  121 King Street Melbourne,3000, Australia</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 mb-lg-0 mb-md-0 mb-3">
                <div class="offer-section-box">
                    <div class="offer-section-inner">
                        <i class="fa-solid fa-phone-volume"></i>
                    </div>
                    <h5>Phone</h5>
                    <p>Phone: 0800 123 45 67 890 Fax: 0800 123 45 67 890</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 mb-lg-0 mb-md-0 mb-0">
                <div class="offer-section-box">
                    <div class="offer-section-inner">
                        <i class="fa-sharp fa-solid fa-envelope"></i>
                    </div>
                    <h5>Email</h5>
                    <p>info@spec.com support@spec.com</p>
                </div>
            </div>
        </div>
       </div>
    </div>

    <!--Happy-Clients-Section  -->
<section class="happy-clients-section happy-clients-section3 contact-form-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2  data-aos="fade-up">Contact Form</h2>
                    <div class="carousel-card-form position-relative"> 
                            <form method="post" action="contact-form.php">
                                <div class="row">                           
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                       <div class="border-bottom-outer position-relative">
                                        <input class="form-input-fields" type="text" id="fname" name="fname" placeholder="First Name">
                                       </div>
                                        <input class="form-input-fields" type="text" id="email" name="email" placeholder="Email">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <input class="form-input-fields" type="text" id="lname" name="lname" placeholder="Last Name">
                                        <input class="form-input-fields" type="text" id="phone" name="phone" placeholder="Phone">
                                    </div>                         
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" id="message" name="message" class="message-field" placeholder="Message">
                                        <div class="popup-btn">
                                            <button type="submit" class="btn btn-primary">SEND MESSAGE</button>
                                        </div>
                                    </div>
                                    <figure class="carousel-bottom-fig"><img src="./assets/images/carousel-bottom-img.png" alt="" class="img-fluid"></figure>
                                </div>
                            </form>
                    </div>
            </div> 
        </div>
    </div>
</section> 

<?php
include "footer.php";
?>