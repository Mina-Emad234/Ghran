// JavaScript Document
$(window).load(function(){
 //Main slider Option Two Fix height

$('.content, .sidebar').height($('#resp-height').height()-40);

// Main slider Option Two Fix height with resize
$( window ).resize(function() {
$('.content, .sidebar').height($('#resp-height').height()-40);
});


});











/*$(function(){


    var bigbrother = -2;

    $('.partner-box').each(function() {
      bigbrother = bigbrother > $('.partner-box').height() ? bigbrother : $('.partner-box').height();
    });

    $('.partner-box').each(function() {
      $('.partner-box').height(bigbrother);
    });

    });*/


$(function(){
        if($(window).width() < 990) {
$( '.navbar-nav li.dropdown a.dropdown-toggle' ).before( '<sapn class="mob-btn"><i class="fa fa-plus"></i></span>' );
        }
});





$( document ).ready(function() {







$(".mob-btn").click(function () {
    if (!$(".mob-btn").hasClass("Moved")) {
    $('.mob-btn').addClass("Moved");
    $(this).parent().find("ul.dropdown-menu").addClass('anim-menu');
        $(this).parent().find("ul.dropdown-menu").css('display','block');
	$(this).find("i").removeClass('fa-plus fa-plus');
	$(this).find("i").addClass('fa-plus fa-minus');
    } else {
        $(".mob-btn").removeClass("Moved");
		$(this).find("i").removeClass('fa-plus fa-minus');
		$(this).find("i").addClass('fa-plus fa-plus');
        $(this).parent().find("ul.dropdown-menu").removeClass('anim-menu');
        $(this).parent().find("ul.dropdown-menu").css('display','none');
	    }
});








      $( '#tab-master a' ).click( function ( e ) {
        e.preventDefault();
        $( this ).tab( 'show' );
      } );

      ( function( $ ) {
          fakewaffle.responsiveTabs( [ 'xs' ] );
      } )( jQuery );


	$('#partners').owlCarousel({
		rtl:true,
		loop:true,
		margin:10,
		nav:true,
		autoplay:true,
		navText: [
                    "السابق",
                    'التالي'
                ],
		responsive:{
			0:{
				items:1
			},
			600:{
				items:3
			},
			1000:{
				items:6
			}
		}
	});

	$('#Testimonials').owlCarousel({
		rtl:true,
		loop:true,
		autoplay:true,
		margin:10,
		nav:false,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:1
			}
		}
	});


	$(".acc-head").click(function () {
		$(".acc-head").not(this).removeClass('active');
		$(this).toggleClass("active");
	});

// Gallery

        $('.popup-gallery').magnificPopup({
          delegate: 'a.gallery-item',
          type: 'image',
          tLoading: 'Loading image #%curr%...',
          mainClass: 'mfp-img-mobile',
          gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 2 after the current image
          },
          image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function(item) {
              return item.el.attr('title') + '<small></small>';
            }
          }

        });





});
