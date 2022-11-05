</div>
            </div>
        </div>
    </section>
    <!--//contact-->

<!--footer-->
    <footer>
        <div class="container py-md-4 mt-md-3">
            <div class="row footer-top-w3layouts-agile py-5">
                <div class="col-md-4 footer-grid">
                    <div class="footer-title">
                        <h3>About Us</h3>
                    </div>
                    <div class="footer-text">
                        <p>First Silver Knights Men clothing & accessories store was opened in 2005 by the owner Mr. Linn Khant. We offer BEST services for our valuable customers.</p>
                    </div>
                </div>
                <div class="col-md-4 footer-grid">
                    <div class="footer-title">
                        <h3>Contact Us</h3>
                    </div>
                    <div class="contact-info">
                    <h4>Location :</h4>
                    <p>Main - 126 Anawrahta Rd, Sue Lay township</p>
                    <p>Branch - Mingalar Taung Nyun township</p>
                    <p>Branch - Kyimyindaing township</p>
                    <div class="phone">
                        <h4>Phone :</h4>
                        <p>Phone : +95 9533 744 844, +95 9533 744 855</p>
                        <p>Email : <a href="contact@silverknight.com">contact@silverknight.com</a></p>
                    </div>
                </div>
                </div>
                
            </div>
        </div>
    </footer>

    <!---->
    <div class="copyright py-3">
        <div class="container">
            <div class="copyrighttop">
                <ul>
                    <li>
                        <h4>Follow us on:</h4>
                    </li>
                    <li>
                        <a class="facebook" href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a class="facebook" href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a class="facebook" href="#">
                            <i class="fab fa-google-plus-g"></i>
                        </a>
                    </li>
                    <li>
                        <a class="facebook" href="#">
                            <i class="fab fa-pinterest-p"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="copyrightbottom">
                <p>© 2022. All Rights Reserved
                </p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<!-- //footer -->

<!-- js -->
    <script src="js/jquery-2.2.3.min.js"></script>
<!-- //js -->
    <!-- start-smooth-scrolling -->
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
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
            /*
            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear' 
            };
            */

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <script src="js/SmoothScroll.min.js"></script>
    <!-- //smooth-scrolling-of-move-up -->
    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.js"></script>
</body>

</html>