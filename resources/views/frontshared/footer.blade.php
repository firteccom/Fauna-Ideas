<footer>
    <div class="footer-top">
        <div class="container-fluid">
            <div class="footer-left widget-newsletter">
                <div class="widget-newsletter-info">
                    <a href="{{ route('front.blog.page') }}" class="widget-newsletter-title">Visita nuestro Blog</a>
                    <p class="widget-newsletter-content">Recibe toda la información sobre nuevos productos y ofertas.</p>
                </div>
                <form action="#">
                    <div class="footer-submit-wrapper">
                        <input type="email" class="form-control" placeholder="Correo electrónico..." required>
                        <button type="submit" class="btn">Suscribir</button>
                    </div>
                </form>
            </div>
            <div class="footer-right">
                <div class="social-icons">

                    @if(isset($facebook))
                        <a href="{{$facebook}}" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    @endif

                    @if(isset($twitter))
                        <a href="{{$twitter}}" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>
                    @endif
                    
                    <!--<a href="#" class="social-icon" target="_blank"><i class="fab fa-linkedin-in"></i></a>-->
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
                                    <h4 class="widget-title">Dirección</h4>
                                    <a href="#">Ca. Thomas Ramsey Nº. 915 Dpto. 702, Magdalena del mar, Lima, Perú</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="contact-widget email">
                                    <h4 class="widget-title">Correo electrónico</h4>
                                    <a target="_blank" href="mailto:fauna.ideas@gmail.com">fauna.ideas@gmail.com</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="contact-widget">
                                    <h4 class="widget-title">Celular</h4>
                                    <a href="#">+51 942 088 668</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="contact-widget">
                                    <h4 class="widget-title">Horario de atención</h4>
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
                                <li><a href="{{ route('front.about.page') }}">Nosotros</a></li>
                                <li><a href="{{ route('front.contact.page') }}">Contacto</a></li>
                                <li><a href="{{ route('front.blog.page') }}">Blog</a></li>
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