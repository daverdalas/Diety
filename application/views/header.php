<header>
        <nav class="navbar navbar-default">
            <div class = "col-xs-12 col-md-10 col-md-offset-1">
                <div class = "pull-right text-uppercase text-right margin-bottom-20 margin-top-10 login">
                    <figure class = "col-sm-6 to-log">
                        <img src = <?php echo base_url()."/media/images/person.png"?>>
                        <figcaption>
                            <a href = <?php echo base_url() ?>><strong>moje konto</strong></a>
                        </figcaption>
                    </figure>
                    <figure class = "col-sm-6 text-left">
                        <img src = <?php echo base_url()."/media/images/mobile.png" ?>>
                        <figcaption>
                            <strong>61 258 258</strong>
                        </figcaption>
                    </figure>
                    </div>
                </div>
                <div class="col-sm-12 no-padding margin-top-30">
                <!-- Mobile -->
                <div class="navbar-header">
                    <a class = "only-mobile" href="http://cooking.tenseo.pl/"><img class = "brand" alt="Brand" src=<?php echo base_url()."/media/images/logo.png" ?>></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- Mobile End-->
                <div class="collapse navbar-collapse text-uppercase" id="navbar">
                    <div class = "navigation">
                        <img class = "no-mobile" src = <?php echo base_url()."/media/images/cutlery.png"?>>
                        <ul class="nav navbar-nav navigation-left">
                            <li><strong><a href = "http://cooking.tenseo.pl/">o nas</a></strong></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><strong>Oferta</strong></br><img class = "dropdown-arrow" src =<?php echo base_url()."/media/images/dropdown.png" ?>></a>
                                <ul class="dropdown-menu">
                                    <li><a href="http://cooking.tenseo.pl/dieta-standardowa" class = "no-padding">dieta standardowa</a></li>
                                    <li><a href="http://cooking.tenseo.pl/dieta-weganska" class = "no-padding">dieta wegańska</a></li>
                                    <li><a href="http://cooking.tenseo.pl/dieta-wegetarianska" class = "no-padding">dieta wegetariańska</a></li>
                                    <li><a href="http://cooking.tenseo.pl/dieta-bezglutenowa" class = "no-padding">dieta bezglutenowa</a></li>
                                    <li><a href="http://cooking.tenseo.pl/dieta-sportowa" class = "no-padding">dieta sportowa</a></li>
                                    <li><a href="http://cooking.tenseo.pl/dieta-dla-kobiet-w-ciazy-i-matek-karmiacych" class = "no-padding">dieta dla kobiet w ciąży</a></li>
                                </ul>
                            </li>
                            <li><strong><a href = "http://cooking.tenseo.pl/cennik">cennik</a></strong></li>
                        </ul>
                        <a class = "no-mobile" href="http://cooking.tenseo.pl/"><img class = "brand" alt="Brand" src=<?php echo base_url()."/media/images/logo.png" ?>></a>
                        <ul class="nav navbar-nav navigation-right">
                            <li><strong><a href = "http://cooking.tenseo.pl/kontakt">kontakt</a></strong></li>
                            <li><strong><a href = "http://cooking.tenseo.pl/blog">blog</a></strong></li>
                            <li><strong><?=anchor('/order', 'zamów', "class = 'order'");?></strong></li>
                        </ul>
                        <img class = "no-mobile" src = <?php echo base_url()."/media/images/cutlery.png" ?>>
                    </div>
                </div>
            </div>
        </nav>
        <div class = "social-media">
            <a href = "#"><img src = <?php echo base_url()."/media/images/fb.png" ?>></a>
            <a href = "#"><img src = <?php echo base_url()."/media/images/instagram.png" ?>></a>
            <a href = "#"><img src = <?php echo base_url()."/media/images/pinterest.png" ?>></a>
        </div>
    </header>