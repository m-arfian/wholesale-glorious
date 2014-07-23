/* Sidebar */
$('.sidey .nav').navgoco({accordion: true});

/* Bootstrap Carousel */
$('.carousel').carousel({
    interval: 8000,
    pause: "hover"
});

/* Ecommerce single item carousel */
$('.ecarousel').carousel({
    interval: 8000,
    pause: "hover"
});

/* Navigation Menu */
ddlevelsmenu.setup("ddtopmenubar", "topbar");

/* Dropdown Select */

/* Navigation (Select box) */

// Create the dropdown base

$("<select />").appendTo(".navis");

// Create default option "Go to..."

$("<option />", {
    "selected": "selected",
    "value": "",
    "text": "Menu"
}).appendTo(".navis select");

// Populate dropdown with menu items

$(".navi a").each(function() {
    var el = $(this);
    $("<option />", {
        "value": el.attr("href"),
        "text": el.text()
    }).appendTo(".navis select");
});

$(".navis select").change(function() {
    window.location = $(this).find("option:selected").val();
});


/* Recent post carousel (CarouFredSel) */
/* Carousel */
//$('#carousel_container').carouFredSel({
//    responsive: true,
//    width: '100%',
//    direction: 'right',
//    scroll: {
//        items: 4,
//        delay: 1000,
//        duration: 2000,
//        pauseOnHover: "true"
//    },
//    prev: {
//        button: "#car_prev",
//        key: "left"
//    },
//    next: {
//        button: "#car_next",
//        key: "right"
//    },
//    items: {
//        visible: {
//            min: 1,
//            max: 4
//        }
//    }
//});

/* Scroll to Top */
$(".totop").hide();

$(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300)
        {
            $('.totop').fadeIn();
        }
        else
        {
            $('.totop').fadeOut();
        }
    });

    $('.totop a').click(function(e) {
        e.preventDefault();
        $('body,html').animate({scrollTop: 0}, 500);
    });

});

$("#slist a").click(function(e) {
    e.preventDefault();
    $(this).next('p').toggle(200);
});

$('#myTab a').click(function(e) {
    e.preventDefault()
    $(this).tab('show')
});

/* Countdown */
//$(function() {
//    launchTime = new Date();
//    launchTime.setDate(launchTime.getDate() + 365);
//    $("#countdown").countdown({until: launchTime, format: "dHMS"});
//});

/* Datepicker */
$(function() {
    $('.datepicker').datetimepicker({
        pickTime: false,
        language: 'id',
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });
});

/* Form validation */
// $("form").validate({
// 	errorPlacement: function(error, element) {
// 		error.appendTo( element.parents(".form-field") );
// 	}
// });


$('.tip').tooltip({
    'placement': 'right',
});
$('.pop').popover({
    'trigger': 'click',
});
$('.pop').click(function(e) {
    e.preventDefault();
});
$('.fancy').fancybox({
    'transitionIn': 'elastic',
    'transitionOut': 'elastic',
    'width': '100%',
});
$('.smnote').summernote({
    height: 100,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
    ]
});
$('.smnote-full').summernote({
    height: 100,
});
$('.note-editor .btn').addClass('btn-focus');