@include('home.header')

<!-- Start Page Title Area -->
<div class="page-title-area bg-22">
    <div class="container">
        <div class="page-title-content">
            <h2>Contact</h2>
            <ul>
                <li>
                    <a href="indexbc14.html?a=home">
                        Home
                    </a>
                </li>

                <li class="active">Contact</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->


<!-- Start Contact Area -->
<section class="faq-contact-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-wrap">
                    <div class="contact-form">
                        <div class="section-title">
                            <span class="top-title">Contact Us</span>
                            <h2>Drop us a message for any query</h2>
                        </div>

                        <script language=javascript>
                            function checkform() {
if (document.mainform.name.value == '') {
  alert("Please type your full name!");
  document.mainform.name.focus();
  return false;
}
if (document.mainform.email.value == '') {
  alert("Please enter your e-mail address!");
  document.mainform.email.focus();
  return false;
}
if (document.mainform.message.value == '') {
  alert("Please type your message!");
  document.mainform.message.focus();
  return false;
}
return true;
}

                        </script>

                        <form method=post name=mainform onsubmit="return checkform()" id="contactForm"><input
                                type="hidden" name="form_id" value="16186696578527"><input type="hidden"
                                name="form_token" value="22ffc8ecde8a964caf008085c51abee7">
                            <input type=hidden name=a value=support>
                            <input type=hidden name=action value=send>


                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="name" value="" class="form-control" required
                                            placeholder="Your Name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="email" name="email" value="" class="form-control" required
                                            placeholder="Your Email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <textarea name=message class="form-control" id="message" cols="30" rows="8"
                                            required data-error="Write your message"
                                            placeholder="Your Message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="default-btn page-btn">
                                        Send Message
                                    </button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Area -->

<iframe
    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3231.873334317541!2d14.4918517!3d35.9011178!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x130e454a6a194cdb%3A0x3292dfa923c7579b!2s10%20Giuseppe%20Cali%2C%20Ta'%20Xbiex%2C%20Malta!5e0!3m2!1sen!2snl!4v1603574173716!5m2!1sen!2snl"
    width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
    tabindex="0"></iframe>


@include('home.footer')