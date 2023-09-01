jQuery('document').ready(function(){
  var owl = jQuery('#latest-product .owl-carousel');
    owl.owlCarousel({
    margin:50,
    nav: true,
    autoplay : true,
    lazyLoad: true,
    autoplayTimeout: 3000,
    loop: false,
    dots:true,
    navText : ['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 2
      },
      1000: {
        items: 4
      },
      1200: {
        items: 5
      }
    },
    autoplayHoverPause : true,
    mouseDrag: true
  });
});
