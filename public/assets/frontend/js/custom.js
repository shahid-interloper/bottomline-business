// $("#Header").load("layout/header.html")
// $("#Footer").load("layout/footer.html")
window.onload = () => {
    $(function() {
        $('#menu').slicknav();
    });

    // Search
    $('.search-box a').click(function(e) {
        e.preventDefault();
        if ($(this).hasClass('show-search')) {
            $(this).removeClass('show-search');
            $(this).find('i').removeClass('fa-times');
            $(this).find('i').addClass('fa-search');
        } else {
            $(this).addClass('show-search');
            $(this).find('i').removeClass('fa-search');
            $(this).find('i').addClass('fa-times');
        }
    });
    // Search

    $(".prod_det_slider").slick({
        dots: false,
        infinite: true,
        speed: 300,
        autoplay: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        asNavFor: '.product-del-conn',
    });
    $(".product-del-conn").slick({
        dots: false,
        infinite: true,
        speed: 300,
        autoplay: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: false,
        asNavFor: '.prod_det_slider',
    });



    // blogslider start
    $('.catogry-slider').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    $('.catgry-arrow>a').eq(0).click((e) => {
        e.preventDefault();
        $('.catogry-slider .slick-prev').click();
    });
    $('.catgry-arrow>a').eq(1).click((e) => {
        e.preventDefault();
        $('.catogry-slider .slick-next').click();
    });

    // blogslider end
    $('.testi-slider').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 2,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    // product slider jas start

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: true,
        centerMode: true,
        focusOnSelect: true
    });
    // product slider jas end

    // simple slick slider start
    $(".regular").slick({
        dots: true,
        infinite: true,
        speed: 300,
        autoplay: true,
        slidesToShow: 3,
        slidesToScroll: 3
    });

    // simple slick slider end

    // wow animation js 

    $(function() {
        new WOW().init();
    });


    // responsive menu js 

    $(function() {
        $('#menu').slicknav();
    });



    // slick slider in tabs js start

    function openCity(evt, cityName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace("active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += "active";
    }
    (function() {

        window.inputNumber = function(el) {

            var min = el.attr('min') || false;
            var max = el.attr('max') || false;

            var els = {};

            els.dec = el.prev();
            els.inc = el.next();

            el.each(function() {
                init($(this));
            });

            function init(el) {

                els.dec.on('click', decrement);
                els.inc.on('click', increment);

                function decrement() {
                    var value = el[0].value;
                    value--;
                    if (!min || value >= min) {
                        el[0].value = value;
                    }
                }

                function increment() {
                    var value = el[0].value;
                    value++;
                    if (!max || value <= max) {
                        el[0].value = value++;
                    }
                }
            }
        }
    })();

    inputNumber($('.input-number'));

    // slick slider in tabs js end
}