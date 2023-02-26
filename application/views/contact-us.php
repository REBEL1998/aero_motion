<section class="breadcrumb breadcrumb_bg banner-bg-1 overlay2 ptb200">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-1">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                         <h2><?php echo $pageTitle;?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="contact-title text-center">Get in Touch with AERO Motion</h2>
            </div>
            <div class="col-lg-12">
                <form id="contact-form" class="form-contact contact_form" action="<?php echo base_url("contact-us"); ?>" method="post">
                    <div class="row" >
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control valid" name="txtUserName" id="txtUserName" type="text" placeholder="Enter your Name" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your Name'" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="number" name="txtPhoneNum" id="txtPhoneNum" value="" placeholder="Phone" class="form-control valid" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Phone'" placeholder="Enter Phone">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control valid" name="txtUserEmail" id="txtUserEmail" type="email" placeholder="Enter Email" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email'">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control valid" name="txtSubject" id="txtSubject" type="text" placeholder="Enter Subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" name="txtMessage" id="txtMessage" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder="Enter Message"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mt-3 text-center">
                                <button type="submit" class="button button-contactForm boxed-btn"  onclick='submitInquiry()'>Send Message</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 offset-lg-1" style="display:none">
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-home"></i></span>
                    <div class="media-body">
                        <h3>Buttonwood, California.</h3>
                        <p>Rosemead, CA 91770</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                    <div class="media-body">
                        <h3>+1 253 565 2365</h3>
                        <p>Mon to Fri 9am to 6pm</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-email"></i></span>
                    <div class="media-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
