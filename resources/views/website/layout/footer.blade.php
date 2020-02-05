<!-- footer -->
<footer>
    <div class="footer-top-first">
        <div class="container py-md-5 py-sm-4 py-3">
            <!-- footer first section -->
            <!-- //footer first section -->
            <!-- footer second section -->
            <div class="row w3l-grids-footer border-top border-bottom py-sm-4 py-3">
                <div class="col-md-4 offer-footer">
                    <div class="row">
                        <div class="col-4 icon-fot">
                            <i class="fas fa-dolly"></i>
                        </div>
                        <div class="col-8 text-form-footer">
                            <h3>Miễn phí giao hàng</h3>
                            <p>cho đơn hàng trên 3 triệu</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 offer-footer my-md-0 my-4">
                    <div class="row">
                        <div class="col-4 icon-fot">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="col-8 text-form-footer">
                            <h3>Cash on delivery</h3>
                            <p>Hỗ trợ giao hàng thu tiền</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 offer-footer">
                    <div class="row">
                        <div class="col-4 icon-fot">
                            <i class="far fa-thumbs-up"></i>
                        </div>
                        <div class="col-8 text-form-footer">
                            <h3>Uy tín</h3>
                            <p>tạo nên thành công</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //footer second section -->
        </div>
    </div>
    <!-- footer third section -->
    <div class="w3l-middlefooter-sec">
        <div class="container py-md-5 py-sm-4 py-3">
            <div class="row footer-info w3-agileits-info">
                <!-- footer categories -->
                <div class="col-md-3 col-sm-6 footer-grids">
                    <h3 class="text-white font-weight-bold mb-3">Danh mục</h3>
                    <ul>
                        @foreach ($view_categories as $category)
                            <li class="mb-3">
                                <a href="{{ route('category', $category->slug) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- //footer categories -->
                <!-- quick links -->
                <div class="col-md-3 col-sm-6 footer-grids mt-sm-0 mt-4">
                    <h3 class="text-white font-weight-bold mb-3">Giới thiệu</h3>
                    <ul>
                        <li class="mb-3">
                            <a href="about.html">Về chúng tôi</a>
                        </li>
                        <li class="mb-3">
                            <a href="contact.html">Tuyển dụng</a>
                        </li>
                        <li class="mb-3">
                            <a href="help.html">Giúp đỡ</a>
                        </li>
                        <li class="mb-3">
                            <a href="faqs.html">Đổi trả, bảo hành</a>
                        </li>
                        <li class="mb-3">
                            <a href="terms.html">Chính sách giao hàng</a>
                        </li>
                        <li>
                            <a href="privacy.html">Điều khoản thanh toán</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 footer-grids mt-md-0 mt-4">
                    <h3 class="text-white font-weight-bold mb-3">Liên hệ</h3>
                    <ul>
                        <li class="mb-3">
                            <i class="fas fa-map-marker"></i> 96 Định Công - Hoàng Mai - Hà Nội
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-mobile"></i> 0363.07.12.98
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone"></i> 0589.07.12.98
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-envelope-open"></i>
                            <a href="mailto:buivansaobg@gmail.com"> buivansaobg@gmail.com</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 footer-grids w3l-agileits mt-md-0 mt-4">
                    <!-- newsletter -->
                    <h3 class="text-white font-weight-bold mb-3">Đăng ký nhận tin</h3>
                    <form action="#" method="post">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" name="email" required="">
                            <input type="submit" value="Gửi">
                        </div>
                    </form>
                    <!-- //newsletter -->
                    <!-- social icons -->
                    <div class="footer-grids  w3l-socialmk mt-3">
                        <h3 class="text-white font-weight-bold mb-3">Theo dõi chúng tôi</h3>
                        <div class="social">
                            <ul>
                                <li>
                                    <a target="_blank" class="icon fb" href="https://fb/buivansaobg">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="icon tw" href="#">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="icon gp" href="#">
                                        <i class="fab fa-google-plus-g"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //social icons -->
                </div>
            </div>
            <!-- //quick links -->
        </div>
    </div>
    <!-- //footer third section -->

</footer>
<!-- //footer -->
<!-- copyright -->
<div class="copy-right py-3">
    <div class="container">
        <p class="text-center text-white">© 2019 buivansao.tech. All rights reserved | Design by
            <a href="https://fb/buivansaobg"> Sao Bui Van.</a>
        </p>
    </div>
</div>
<!-- //copyright -->

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/auth.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.toast.min.js"></script>
<script src="js/cart.js"></script>
<script src="js/get-address.js"></script>
<script src="js/order.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="js/bootstrap.js"></script>
<script src="js/imagezoom.js"></script>
<script src="js/SmoothScroll.min.js"></script>
<script src="js/move-top.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script src="js/easing.js"></script>
<script src="js/rating.js"></script>
<script>
    jQuery(document).ready(function ($) {
        $(".scroll").click(function (event) {
            event.preventDefault();

            $('html,body').animate({
                scrollTop: $(this.hash).offset().top
            }, 1000);
        });
    });
</script>
<!-- //end-smooth-scrolling -->

<!-- smooth-scrolling-of-move-up -->
<script>
    $(document).ready(function () {
        $().UItoTop({
            easingType: 'easeOutQuart'
        });
    });
</script>
<!-- //smooth-scrolling-of-move-up -->

<!-- Chat facebook -->
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            xfbml: true,
            version: 'v4.0'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
     attribution=setup_tool
     page_id="102425331190933"
     logged_in_greeting="Xin chào, tôi có thể giúp gì cho bạn?"
     logged_out_greeting="Xin chào, tôi có thể giúp gì cho bạn?">
</div>
<!-- End chat facebook -->
</body>
</html>
                                                 
