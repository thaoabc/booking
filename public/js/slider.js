// Slick js

// trang chu

$(".customer__silder").slick({
	slidesToShow: 8,
	slidesToScroll: 4,
	dots: false,
	infinite: true,
	autoplay: true,
	autoplaySpeed: 5000,
	arrows: false,
	speed: 500,
	responsive: [
	{
		breakpoint: 991,
		settings: {
			slidesToShow: 4,
			slidesToScroll: 2
		}
	},
	{
		breakpoint: 767,
		settings: {
			slidesToShow: 4,
			slidesToScroll: 2
		}
	},
	{
		breakpoint: 575,
		settings: {
			slidesToShow: 2,
			slidesToScroll: 1
		}
	}
	]
});

// Slide-service-bottom // dichvu-thietkewebgiare

$(".service__silder").slick({
  slidesToShow: 5,
  slidesToScroll: 1,
  dots: false,
  arrows: true,
  infinite: true,
  autoplay: true,
  autoplaySpeed: 3000,
  speed: 500,
  responsive: [
  {
    breakpoint: 991,
    settings: {
      slidesToShow: 4,
      slidesToScroll: 1
    }
  },
  {
    breakpoint: 767,
    settings: {
      slidesToShow: 4,
      slidesToScroll: 1
    }
  },
  {
    breakpoint: 575,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 1
    }
  }
  ]
});

// slicebox
$(function() {
				
  var Page = (function() {
    
    var $navArrows = $( '#nav-arrows' ).hide(),
        $shadow = $( '#shadow' ).hide(),
        slicebox = $( '#sb-slider' ).slicebox( {
          onReady : function() {
            
            $navArrows.show();
            $shadow.show();
            
          },
          orientation : 'r',
          cuboidsCount: 4,
          // autoplay : true,
          cuboidsRandom : true,
          disperseFactor : 0,
          speed: 800,
          interval: 9000,
          colorHiddenSides : '#fff'
        } ),
        
        init = function() {
          
          initEvents();
          
        },
        initEvents = function() {
          
          // add navigation events
          $navArrows.children( ':first' ).on( 'click', function() {
            
            slicebox.next();
            return false;
            
          } );
          
          $navArrows.children( ':last' ).on( 'click', function() {
            
            slicebox.previous();
            return false;
            
          } );
          
        };
    
    return { init : init };
    
  })();
  
  Page.init();
  
});

// 
