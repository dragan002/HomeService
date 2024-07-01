<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home Service</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/chblue.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/theme-responsive.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/dtb/jquery.dataTables.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet" media="screen">        
    <script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-ui.1.10.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/modernizr.js') }}"></script>
    
    @livewireStyles
</head>
<body>
    <div id="layout">
        <header id="header" class="header-v3">
            <nav class="flat-mega-menu">
                <label for="mobile-button"> <i class="fa fa-bars"></i></label>
                <input id="mobile-button" type="checkbox">

                <ul class="collapse">
                    {{-- <li class="title">
                        <a href="/"><img src="images/logo.png"></a>
                    </li> --}}

                    <li> <a href="{{ route('service.serviceCategories') }}">Kategorije Usluga</a>

                        <li> <a href="#">Aparati</a>
                            <ul class="drop-down one-column hover-fade">
                                <li><a href="servicesbycategory/11.html">Popravka računara</a></li>
                                <li><a href="servicesbycategory/12.html">Televizor</a></li>
                                <li><a href="servicesbycategory/1.html">Klima uređaj</a></li>
                                <li><a href="servicesbycategory/14.html">Bojler</a></li>
                                <li><a href="servicesbycategory/21.html">Veš mašina</a></li>
                                <li><a href="servicesbycategory/22.html">Mikrotalasna pećnica</a></li>
                                <li><a href="servicesbycategory/9.html">Nape i ploče za kuvanje</a></li>
                                <li><a href="servicesbycategory/10.html">Prečišćivač vode</a></li>
                                <li><a href="servicesbycategory/13.html">Frižider</a></li>
                            </ul>
                        </li>
                        <li> <a href="#">Kućne potrebe</a>
                            <ul class="drop-down one-column hover-fade">
                                <li><a href="servicesbycategory/19.html">Pranje veša</a></li>
                                <li><a href="servicesbycategory/4.html">Električari</a></li>
                                <li><a href="servicesbycategory/8.html">Dezinsekcija</a></li>
                                <li><a href="servicesbycategory/7.html">Stolarija</a></li>
                                <li><a href="servicesbycategory/3.html">Vodoinstalateri</a></li>
                                <li><a href="servicesbycategory/20.html">Farbanje</a></li>
                                <li><a href="servicesbycategory/17.html">Selidbe</a></li>
                                <li><a href="servicesbycategory/5.html">Tuš filteri</a></li>
                            </ul>
                        </li>
                        <li> <a href="#">Čišćenje doma</a>
                            <ul class="drop-down one-column hover-fade">
                                <li><a href="service-details/bedroom-deep-cleaning.html">Dubinsko čišćenje spavaće sobe</a></li>
                                <li><a href="service-details/overhead-water-storage.html">Čišćenje rezervoara za vodu</a></li>
                                <li><a href="/service-details/tank-cleaning">Čišćenje rezervoara</a></li>
                                <li><a href="service-details/underground-sump-cleaning.html">Čišćenje podzemnih rezervoara</a></li>
                                <li><a href="service-details/dining-chair-shampooing.html">Šamponiranje stolica u trpezariji</a></li>
                                <li><a href="service-details/office-chair-shampooing.html">Šamponiranje kancelarijskih stolica</a></li>
                                <li><a href="service-details/home-deep-cleaning.html">Dubinsko čišćenje doma</a></li>
                                <li><a href="service-details/carpet-shampooing.html">Šamponiranje tepiha</a></li>
                                <li><a href="service-details/fabric-sofa-shampooing.html">Šamponiranje tkanine na sofama</a></li>
                                <li><a href="service-details/bathroom-deep-cleaning.html">Dubinsko čišćenje kupatila</a></li>
                                <li><a href="service-details/floor-scrubbing-polishing.html">Ribanje i poliranje podova</a></li>
                                <li><a href="service-details/mattress-shampooing.html">Šamponiranje dušeka</a></li>
                                <li><a href="service-details/kitchen-deep-cleaning.html">Dubinsko čišćenje kuhinje</a></li>
                            </ul>
                        </li>
                        <li> <a href="#">Posebne usluge</a>
                            <ul class="drop-down one-column hover-fade">
                                <li><a href="servicesbycategory/16.html">Usluge dokumentacije</a></li>
                                <li><a href="servicesbycategory/15.html">Automobili i motocikli</a></li>
                                <li><a href="servicesbycategory/17.html">Selidbe</a></li>
                                <li><a href="servicesbycategory/18.html">Automatizacija doma</a></li>
                            </ul>
                        </li>
                        

                    @if(Route::has('login'))
                    @auth   
                        @if(Auth::user()->utype === 'ADM')
                        <li class="login-form"> <a href="#" title="Registruj se">Moj nalog (Admin)</a>
                            <ul class="drop-down one-column hover-fade">
                                <li><a href="{{ route('admin.serviceCategories') }}">Kategorije usluga</a></li>
                                <li><a href="{{ route('admin.allServices') }}">Sve usluge</a></li>
                                <li><a href="{{ route('admin.slider') }}">Upravljanje slajderom</a></li>
                                <li><a href="{{ route('admin.contacts') }}">Svi kontakti</a></li>
                                <li><a href="{{ route('admin.serviceProviders') }}">Svi pružaoci usluga</a></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Odjava</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('messages.index') }}" class="fa fa-envelope">Poruke</a></li>
                        @elseif(Auth::user()->utype === 'SVP')
                        <li class="login-form"> <a href="#" title="Registruj se">Moj nalog (Pružalac usluga)</a>
                            <ul class="drop-down one-column hover-fade">
                                <li><a href="{{ route('sprovider.profile') }}">Profil</a></li>
                                <li><a href="{{ route('sprovider.addService') }}">Dodaj uslugu</a></li>
                                <li><a href="{{ route('sprovider.list') }}">Moje usluge</a></li>
                                <li><a href="{{ route('sprovider.bookingManage') }}">Rezervisane usluge</a></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Odjava</a></li>    
                            </ul>
                        </li>
                        <li><a href="{{ route('messages.index') }}">Poruke</a></li>
                        @else
                        <li class="login-form"> <a href="#" title="Registruj se">Moj nalog (Korisnik)</a>
                            <ul class="drop-down one-column hover-fade">
                                <li><a href="{{ route('bookings.index')}}">Moji statusi rezervacija</a></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Odjava</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('messages.index') }}" class="fa fa-envelope">Inbox</a></li>
                        @endif
                        <form action="{{ route('logout') }}" id="logout-form" method="post" style="display: none;">
                            @csrf
                        </form>
                        @else
                        <li class="login-form"> <a href="{{ route('register') }}" title="Registruj se">Registruj se</a></li>
                        <li class="login-form"> <a href="{{ route('login') }}" title="Prijavi se">Prijavi se</a></li>
                        
                    @endauth
                @endif
                    </li>
                </ul>
            </nav>
        </header>
        {{ $slot }}
        <footer id="footer" class="footer-v1">
            <div class="container">
                <div class="row visible-md visible-lg">
                    <div class="col-md-3 col-xs-6 col-sm-6">
                        <h3>USLUGE ZA APARATE</h3>
                        <ul>
                            <li><i class="fa fa-check"></i> <a href="servicesbycategory/12.html">Televizori</a></li>
                            <li><i class="fa fa-check"></i> <a href="servicesbycategory/14.html">Bojleri</a></li>
                            <li><i class="fa fa-check"></i> <a href="servicesbycategory/13.html">Frižideri</a></li>
                            <li><i class="fa fa-check"></i> <a href="servicesbycategory/21.html">Veš mašine</a></li>
                            <li><i class="fa fa-check"></i> <a href="servicesbycategory/22.html">Mikrotalasne pećnice</a></li>
                            <li><i class="fa fa-check"></i> <a href="servicesbycategory/10.html">Prečišćivači vode</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-xs-6 col-sm-6">
                        <h3>USLUGE ZA KLIMATIZACIJU</h3>
                        <ul>
                            <li><i class="fa fa-check"></i> <a href="service-details/ac-installation.html">Instalacija</a></li>
                            <li><i class="fa fa-check"></i> <a href="service-details/ac-uninstallation.html">Deinstalacija</a></li>
                            <li><i class="fa fa-check"></i> <a href="service-details/ac-repair.html">Popravka klima uređaja</a></li>
                            <li><i class="fa fa-check"></i> <a href="service-details/ac-gas-refill.html">Dopuna gasa</a></li>
                            <li><i class="fa fa-check"></i> <a href="service-details/ac-wet-servicing.html">Servisiranje vlažno</a></li>
                            <li><i class="fa fa-check"></i> <a href="service-details/ac-dry-servicing.html">Servisiranje suvo </a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-xs-6 col-sm-6">
                        <h3>POTREBE ZA DOM</h3>
                        <ul>
                            <li><i class="fa fa-check"></i> <a href="servicesbycategory/19.html">Pranje veša</a></li>
                            <li><i class="fa fa-check"></i> <a href="servicesbycategory/4.html">Električari</a></li>
                            <li><i class="fa fa-check"></i> <a href="servicesbycategory/8.html">Dezinsekcija</a></li>
                            <li><i class="fa fa-check"></i> <a href="servicesbycategory/7.html">Stolarija</a></li>
                            <li><i class="fa fa-check"></i> <a href="servicesbycategory/3.html">Vodoinstalateri</a></li>
                            <li><i class="fa fa-check"></i> <a href="servicesbycategory/20.html">Farbanje</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-xs-6 col-sm-6">
                        <h3>KONTAKTIRAJTE NAS</h3>
                        <ul class="contact_footer">
                            <li class="location">
                                <i class="fa fa-map-marker"></i> <a href="#">Bosna i Hercegovina</a>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i> <a href="mailto:draganvujic29@gmail.com">draganvujic29@gmail.com</a>
                            </li>
                            <li>
                                <i class="fa fa-headphones"></i> <a href="tel:+387644441119">064 444 111 9</a>
                            </li>
                        </ul>
                        <h3 style="margin-top: 10px">PRATITE NAS</h3>
                        <ul class="social">
                            <li class="facebook"><span><i class="fa fa-facebook"></i></span><a href="#"></a></li>
                            <li class="twitter"><span><i class="fa fa-twitter"></i></span><a href="#"></a></li>
                            <li class="github"><span><i class="fa fa-instagram"></i></span><a href="#"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row visible-sm visible-xs">
                    <div class="col-md-6">
                        <h3 class="mlist-h">KONTAKTIRAJTE NAS</h3>
                        <ul class="contact_footer mlist">
                            <li class="location">
                                <i class="fa fa-map-marker"></i> <a href="#">Prnjavor</a>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i> <a href="mailto:draganvujic29@gmail.com">draganvujic29@gmail.com</a>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i> <a href="tel:+387644441119">+387644441119</a>
                            </li>
                        </ul>
                        <ul class="social mlist-h">
                            <li class="facebook"><span><i class="fa fa-facebook"></i></span><a href="#"></a></li>
                            <li class="twitter"><span><i class="fa fa-twitter"></i></span><a href="#"></a></li>
                            <li class="github"><span><i class="fa fa-instagram"></i></span><a href="#"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-down">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="nav-footer">
                                <li><a href="about-us.html">O nama</a> </li>
                                <li><a href="{{ route('contact') }}">Kontaktirajte nas</a></li>
                                <li><a href="faq.html">FAQ</a></li>
                                <li><a href="terms-of-use.html">Uslovi korišćenja</a></li>
                                <li><a href="privacy.html">Privatnost</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <p class="text-xs-center crtext">&copy; Dragan Vujić</p>
                        </div>
                    </div>
                </div>                
            </div>            
        </footer>
        
    </div>
    <script type="text/javascript" src="{{ asset('assets/js/nav/jquery.sticky.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/totop/jquery.ui.totop.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/accordion/accordion.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/maps/gmap3.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/fancybox/jquery.fancybox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/carousel/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/filters/jquery.isotope.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/twitter/jquery.tweet.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/flickr/jflickrfeed.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/theme-options/theme-options.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/theme-options/jquery.cookies.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap/bootstrap-slider.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dtb/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dtb/jquery.table2excel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dtb/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/validation-rule.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap3-typeahead.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>    
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('.tp-banner').show().revolution({
                dottedOverlay: "none",
                delay: 5000,
                startwidth: 1170,
                startheight: 480,
                minHeight: 250,
                navigationType: "none",
                navigationArrows: "solo",
                navigationStyle: "preview1"
            });
        });
    </script>
    @stack('scripts')
    @livewireScripts
</body>
</html>

