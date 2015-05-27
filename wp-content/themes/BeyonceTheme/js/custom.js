var j$ = jQuery.noConflict();
var CONST = {
	gutter : 4
}


// REARRANGE ELEMENTS

var order = [21,21,13,13, 13,13,21,21, 21,21,17,17, 21,21,19,19, 19,21,21,21]
j$.each(order,function(index, value) {
	j$(".masonryItem:nth-child("+value+")").prependTo("#content");
})
j$(".me").prependTo("#content");

//////////////////

// SET COLUMN WIDTHS

function columnValue (windWidth ,divisions, columns) {
	var val;

	divisions = typeof divisions !== 'undefined' ? divisions : 0;
	columns = typeof columns !== 'undefined' ? columns : 1;
	
	val = Math.floor( 
		( windWidth - ( CONST.gutter * (divisions+1) ) ) / divisions 
		);
	val = val * columns;
	val += ( ( columns-1 ) * CONST.gutter ) // add value of gutters
	return val
};

// SQUAREUP

var SquareUp = function(selector, callback, smallScreenLandscaped) { // from width
	var element = j$(selector);
	//console.log(smallScreenLandscaped)

	if (smallScreenLandscaped == false) {
		element.each(function(index) {
		 	j$( selector )[index].style.height = callback+"px";
		 	j$( selector )[index].style.width = callback+"px";
		});
	}else{
		element.each(function(index) {
		 	j$( selector )[index].style.height = smallScreenLandscaped+"px";
		 	j$( selector )[index].style.width = smallScreenLandscaped+"px";
		});
	}
};

// FULL WIDTH

var fullHeight = function(parent, selector) {
	var winHeight = j$(parent).outerHeight();
	j$( selector ).css({
		height: winHeight
	})
};

// CENTER TO HEIGHT

var centerToHeight = function( parent, selector ) {

	var parentHalfWinHeight = j$(parent).height()/2;

	j$( selector ).each(function(index) {
		var selectorHeight = (j$( selector )[index].offsetHeight)/2;
		var centerAmount = parentHalfWinHeight - selectorHeight;
		j$( selector )[index].style.paddingTop = centerAmount+'px';
	})
};

var pxFromTop = j$(window).scrollTop()
var initWidth = Math.floor( j$(window).width());
var initHeight = Math.floor( j$(window).height())

j$( '.main_text' ).each(function(index) {
	if ( initWidth > 650 ){
		if( j$('.main_text')[index].innerHTML.length > 0 ) {
			j$('.main_text')[index].style.fontSize = "2em"
		}
		if( j$('.main_text')[index].innerHTML.length > 40 ) {
			j$('.main_text')[index].style.fontSize = "1.6em"
		}
		if( j$('.main_text')[index].innerHTML.length > 60 ) {
			j$('.main_text')[index].style.fontSize = "1.4em"
		}
		if( j$('.main_text')[index].innerHTML.length > 300 ) {
			j$('.main_text')[index].style.fontSize = "1em"
		}
	} else if ( initWidth < 650 ) {
		if( j$('.main_text')[index].innerHTML.length > 0 ) {
			j$('.main_text')[index].style.fontSize = "2.5em"
		}
		if( j$('.main_text')[index].innerHTML.length > 40 ) {
			j$('.main_text')[index].style.fontSize = "2em"
		}
		if( j$('.main_text')[index].innerHTML.length > 60 ) {
			j$('.main_text')[index].style.fontSize = "1.8em"
		}
		if( j$('.main_text')[index].innerHTML.length > 300 ) {
			j$('.main_text')[index].style.fontSize = "1em"
		}
	}
});


function sizing_and_centering (windowX, windowY) {
	var divisions, w2, smallScreenLandscaped = false;
	if ( windowX >= 1080 ){
		divisions = 4;
		w2 = 2;
		j$('#content').css('margin','0px');
	}else if ( windowX < 1080 && windowX >= 840 ){
		divisions = 3;
		w2 = 2;
		j$('#content').css('margin','0px');
	}else if ( windowX < 840 && windowX >= 680 ){
		divisions = 2;
		w2 = 2;
		j$('#content').css('margin','0px');
	}else if ( windowX < 680 ){
		divisions = 1;
		w2 = 1;
		j$('#content').css('margin','0 auto');
	}

	if ( windowX > windowY && windowY < 400) {
		smallScreenLandscaped = windowY;
		j$('#content').css('width', smallScreenLandscaped+'px');
	}else{
		j$('#content').css('width', windowX+'px');
		smallScreenLandscaped = false;
	}

	
	fullHeight(window, '#hero');
	SquareUp('.masonryItem', 
		columnValue( windowX, divisions, 1 ), smallScreenLandscaped);
	SquareUp(".social_options", 
		columnValue( windowX, divisions, 1 ), smallScreenLandscaped);
	SquareUp('.w2', 
		columnValue( windowX, divisions, w2 ), smallScreenLandscaped);
	centerToHeight(window, "#hero h1")
	centerToHeight(".social_options", ".intents");
	centerToHeight(".si_item", ".play");

}
sizing_and_centering(initWidth, initHeight);
// MASONRY

j$('.masonryItem:nth-child(2)').addClass('grid-sizer');

var j$container = j$('#content');
j$container.masonry({
  // options
	itemSelector: '.masonryItem',
	columnWidth: '.grid-sizer',
	gutter: '.gutter-sizer',
	isResizable: true
});


//RESIZE EVENTS

j$(window).bind( 'resize',function(e){
  // code that takes it easy...
  	var resizeWidth = Math.floor( j$(window).width());
  	var resizeHeight = Math.floor( j$(window).height());
	sizing_and_centering(resizeWidth, resizeHeight);
});

//SCROLL EVENTS

var OnScroll = function() {
	if (pxFromTop >= 250 && j$('body').hasClass('home') ){
		j$('.nav-logo').removeClass('hideLogo');
		j$('header').css("background-color", "white")
	}
	else if ( pxFromTop <= 250 && j$('body').hasClass('home') ) {
		j$('.nav-logo').addClass('hideLogo');
		j$('header').css("background-color", "transparent")
	}
};
OnScroll(pxFromTop);

j$(window).scroll(function() {
	pxFromTop = j$(window).scrollTop()
	OnScroll(pxFromTop);
})

// SILK RENDERING

var Silk = function(selector, color) {
	var grid = {

		majorLineWidth: 10,
		majorStrokeStyle: color,
		majorDotSize: 1.5,
		majorFillStyle: color,

		dots: function(context, x, y, w, h, majorRes, minorRes) {
			this._predraw(context);
			context.beginPath();
			context.rect(x, y, w, h);
			context.clip();

			this._useMajor(context);
			context.beginPath();
			for(var i = x; i <= x + w; i += majorRes) {
				for(var j = y; j <= y + h; j += majorRes) {
					context.rect(
						i - 
						this.majorDotSize * 
						.5, 
						j - 
						this.majorDotSize * 
						.5, 
						this.majorDotSize, 
						this.majorDotSize
						);
				}
			}
			context.fill();
			this._postDraw(context);

		},
		_predraw: function(context) {
			context.save();
			context.translate(-0.5, -0.5);
			this._useMajor(context);
		},
		_postDraw: function(context) {
			context.restore();
		},
		_useMajor: function(context) {
			context.lineWidth = this.majorLineWidth;
			context.strokeStyle = this.majorStrokeStyle;
			context.fillStyle = this.majorFillStyle;
		}
	}

	j$( selector ).each(function(index) {
		var self = j$(this);
		var media = j$( selector );


		var g = document.createElement("CANVAS");
		var gridWidth = g.width = media.parent().width();

		if (media.parent()[0].id == 'hero' ){
			var gridHeight = g.height = gridWidth*2;
		}else{
			var gridHeight = g.height = gridWidth;
		}
		
		var ctx = g.getContext("2d");
			g.className = "silk";

			grid.dots(ctx, 0, 0, gridWidth, gridHeight, 3, 3);

	
			var grd = ctx.createRadialGradient( 
					gridWidth/2 , 
					gridHeight , 
					10 , 
					gridWidth/2 , 
					gridHeight/2.5, 
					gridWidth/1.5
					);
				grd.addColorStop(0,"rgba(0,0,0,0");
				grd.addColorStop(1,"rgba(0,0,0,.5)");

			ctx.fillStyle = grd;
			ctx.fillRect(0, 0, gridWidth, gridHeight);	

		j$(g).insertAfter( media[index] )
	});
};
if (j$("body").hasClass("home")){
	Silk(".underlay","#90278C")
	Silk(".tweet .intents","#90278C")
	Silk(".si_item .intents","#90278C")
}

// MASON ITEMS MOUSEOVER EVENTS

j$('.meta_trigger').mouseenter(function() {
	j$(this).next().addClass('currentOptions');
	j$(this).next().next().css('-webkit-filter', 'blur(3px)')
})
j$('.masonryItem').mouseleave(function() {
	var parent = j$(this).find('.social_options')
	parent.removeClass('currentOptions');
	parent.next().css('-webkit-filter', 'blur(0px)')
})

// INSTAGRAM PLAY CONTROLS

j$('.play').click(function() {
    if( j$(this).prev().get(0).paused ){
    	j$(this).prev().get(0).play()
    	j$(this).html('&#xf04c;')
    }else { 
    	j$(this).prev().get(0).pause();
    	j$(this).html('&#xf04b;')
    }  
})




