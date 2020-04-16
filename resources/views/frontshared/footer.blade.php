<footer>
    <div class="footer-top">
        <div class="container-fluid">
            <div class="footer-left widget-newsletter">
                <div class="widget-newsletter-info">
                    <a href="#" class="widget-newsletter-title">Visita nuestro Blog</a>
                    <p class="widget-newsletter-content">Get all the latest information on Events, Sales and Offers.</p>
                </div>
                <form action="#">
                    <div class="footer-submit-wrapper">
                        <input type="email" class="form-control" placeholder="Email address..." required>
                        <button type="submit" class="btn">Subscribe</button>
                    </div>
                </form>
            </div>
            <div class="footer-right">
                <div class="social-icons">
                    <a href="#" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                </div><!-- End .social-icons -->
            </div>
        </div>
    </div>
    <div class="footer-middle">
            <div class="container-fluid">
            <div class="row row-sm">
                <div class="col-lg-6">
                    <div class="widget">
                        <h4 class="widget-title">Información de contacto</h4>

                        <div class="row row-sm">
                            <div class="col-sm-6">
                                <div class="contact-widget">
                                    <h4 class="widget-title">DIRECCIÓN</h4>
                                    <a href="#">123 Street Name, City, England</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="contact-widget email">
                                    <h4 class="widget-title">EMAIL</h4>
                                    <a href="mailto:mail@example.com">mail@example.com</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="contact-widget">
                                    <h4 class="widget-title">TELÉFONO</h4>
                                    <a href="#">Toll Free (123) 456-7890</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="contact-widget">
                                    <h4 class="widget-title">HORARIO DE ATENCIÓN</h4>
                                    <a href="#">Lun - Dom / 9:00AM - 8:00PM</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">My Account</h4>
                        <ul class="links link-parts">
                            <div class="link-part">
                                <li><a href="about.html">Sobre nosotros</a></li>
                                <li><a href="contact.html">Contáctanos</a></li>
                            </div>
                            <div class="link-part">
                                <li><a href="#">Orders History</a></li>
                                <li><a href="#">Advanced Search</a></li>
                            </div>
                        </ul>
                    </div><!-- End .widget -->
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container-fluid">
            <p class="footer-copyright">Firteccom. &copy;  {{ now()->year }}.  Todos los derechos reservados</p>
            <img src="{{ asset('public/portal/images/payments.png') }}" alt="payment image">
        </div>
    </div>
</footer>