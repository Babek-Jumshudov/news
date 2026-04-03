<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xeberler..</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:800|Roboto:400,400i,700,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- <header>
        <div class="header">
            <div class="header-top">
                <div class="logo-img">
                    <div class="logo">
                        <a href="#">Real vaxt rejimində <br> ictimai təhlükəsizlik </a>
                    </div>
                </div>
                <div class="menu">
                    <ul class="list-menu">
                        <li><a class="list-menu-item-active" href="#">Blog</a></li>
                        <li><a class="list-menu-item" href="#">Haqqımızda</a></li>
                        <li><a class="list-menu-item" href="#">Xidmətlərimiz</a></li>
                        <li><a class="list-menu-item" href="#">Əlaqə</a></li>
                    </ul>
                </div>
            </div>
            <div class="header-bottom">
                <h3 data-aos="fade-up">Babek Jumshudov </h3>
            </div>
        </div>
    </header> -->
    <div class="container"></div>
        <section>


            <div class="main-content">
                <!-------------------------Blog CONTENT Start---------------------------------------------------------------->

                <div class="blog-wrapper">

                    @foreach($news as $item)
                        @if($item->image == null)

                        @else
                            <br> <br>
                            <div class="blog-content">

                                <div data-aos="fade-right">

                                    @if($item->image)
                                        <img src="{{ $item->image }}" width="100%" alt="news image">
                                    @else
                                        <img src="/images/default-news.jpg" width="50px" alt="default image">
                                    @endif

                                </div>
                                <div class="blog-details" data-aos="fade-down">
                                    {{ $item->published_at }}
                                </div>
                                <div class="blog-title" data-aos="flip-left">
                                    <h2>{{ $item->title }}</h2>
                                </div>
                                <div class="blog-text" data-aos="fade-up">
                                    <p>{{ $item->content }}</p>

                                </div>
                                <div class="blog-read-more" data-aos="fade-right">
                                    <a style="color: red;" href="{{ $item->link }}">Daha ətraflı...</a>
                                </div>
                            </div>
                            <hr><br>
                        @endif
                    @endforeach


                    <div class="pages" data-aos="fade-up">
                        <a href="#!" class="page-list-active">1</a>
                        <a href="#!" class="page-list">2</a>
                        <a href="#!" class="page-list">3</a>
                        <a href="#!" class="page-list">4</a>
                        <a href="#!" class="page-list">...</a>
                        <a href="#!" class="page-list">Sonuncu</a>
                    </div>


                </div>


                <!-----------------------------------------------Sidebar Start------------------------------------------>


                <div class="sidebar">

                    <div class="widget-reklam" data-aos="fade-down-left">
                        <div class="widget-shaddow">


                            <video autoplay loop muted playsinline width="300">
                                <source src="{{ asset('/video/reklam.mp4') }}" type="video/mp4">
                                Brauzeriniz video etiketini desteklemir..((

                            </video>
                            <button class="btn" onclick="toggleSound(this)">Səs</button>

                            <script>
                                function toggleSound(btn) {
                                    const video = btn.previousElementSibling;
                                    video.muted = !video.muted;
                                }
                            </script>
                            <a href="https://www.instagram.com/reel/DVJDRjFDgAY/?igsh=MWoyZDZsOXp1NWZmYg=="
                                target="_blank" rel="noopener noreferrer">daha etrafli.. </a>
                        </div>

                    </div>

                </div>
            </div>
        </section>

    

    <!-- <footer>
        <div class="footer-content">
            <div class="footer-menu">

                <div class="footer-menu-contact" data-aos="fade-right">
                    <div class="footer-logo">
                        <a href="#">CB</a>
                    </div>
                    <div class="menu-contact-email">
                        nümunə@gmail.com
                    </div>
                    <div class="menu-contact-phone">
                        + 994 (050) 555-55-55
                    </div>
                </div>

                <div class="footer-menu-services" data-aos="fade-up">
                    <h4 class="services-title">
                        Xİdmətlərİmİz
                    </h4>
                    <ul class="services-list">
                        <li class="services-list-item"><a href="#!">Veb Dizayn</a> </li>
                        <li class="services-list-item"><a href="#!">Proqram Təminatı</a></li>
                        <li class="services-list-item"><a href="#!">WordPress ilə saytlar</a></li>
                        <li class="services-list-item"><a href="#!">İnternet marketinq</a></li>
                        <li class="services-list-item"><a href="#!">Mətn köçürülməsi</a></li>
                    </ul>
                </div>

                <div class="footer-menu-services" data-aos="fade-down">
                    <h4 class="services-title">
                        Müəllİf haqqında
                    </h4>
                    <ul class="services-list">
                        <li class="services-list-item"><a href="#!">Haqqımda</a> </li>
                        <li class="services-list-item"><a href="#!">Portfolio</a></li>
                        <li class="services-list-item"><a href="#!">Komanda</a></li>
                        <li class="services-list-item"><a href="#!">Qiymətlər</a></li>
                        <li class="services-list-item"><a href="#!">Bloq</a></li>
                    </ul>
                </div>

                <div class="footer-menu-location" data-aos="fade-left">
                    <h4 class="services-title">
                        Ünvan
                    </h4>
                    <div class="location-text">
                        Bakı şəhəri, Xətai rayonu, Üzeyir Hacıbəyov küçəsi, ev 45, mənzil 55
                    </div>
                    <div class="social">
                        <div class="facebook fb">

                        </div>
                        <div class="gmail">

                        </div>
                        <div class="twitter">

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="footer-end" data-aos="flip-right">
            &copy; 2019 Bütün hüquqlar qorunur.
        </div>
    </footer> -->
    <!-----------------------------------------------Footer END------------------------------------------>


</body>

</html>