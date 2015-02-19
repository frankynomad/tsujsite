var j$ = jQuery.noConflict();

var fullHeight = function(selector) {
	var winHeight = j$(window).height();
	j$( selector ).css({
		height: winHeight
	})
};
fullHeight("#hero")

var centerToHeight = function(selector) {
	var halfWinHeight = j$(window).height()/2;
	var currentPadding = j$( selector ).css("padding-top");
	var elementHeight = j$(selector).innerHeight() - parseInt(currentPadding);
	var centerAmount = halfWinHeight- elementHeight;

	j$( selector ).css({
		'padding-top': centerAmount
	});
};

centerToHeight("#hero h1")

j$( window ).resize( function() {
	fullHeight("#hero")
	centerToHeight("#hero h1")

});

j$(window).scroll(function() {
	var pxFromTop = j$(window).scrollTop()
	if (pxFromTop >= 250 && j$('body').hasClass('home') ){
		j$('.nav-logo').removeClass('hideLogo');
		j$('header').css("background-color", "white")
	}
	else if ( pxFromTop <= 250 && j$('body').hasClass('home') ) {
		j$('.nav-logo').addClass('hideLogo');
		j$('header').css("background-color", "transparent")
	}
})

var Silk = function(selector, color) {
	var grid = {
		thirdLineWidth: 0.2,
		thirdStrokeStyle: "#90278C",
		
		minorLineWidth: 0.25,
		minorStrokeStyle: "#90278C",
		minorDotSize: .5,
		minorFillStyle: "#90278C",
		
		majorLineWidth: 0.5,
		majorStrokeStyle: "#90278C",
		majorDotSize: 1,
		majorFillStyle: "#90278C",

		dots: function(context, x, y, w, h, majorRes, minorRes) {
			this._predraw(context);
			context.beginPath();
			context.rect(x, y, w, h);
			context.clip();

			if(minorRes) {
				context.beginPath();
				this._useMinor(context);
				for(var i = x; i <= x + w; i += minorRes) {
					for(var j = y; j <= y + h; j += minorRes) {
						context.rect(i - this.minorDotSize * .5, j - this.minorDotSize * .5, this.minorDotSize, this.minorDotSize);
					}
				}
				context.fill();
			}

			this._useMajor(context);
			context.beginPath();
			for(var i = x; i <= x + w; i += majorRes) {
				for(var j = y; j <= y + h; j += majorRes) {
					context.rect(i - this.majorDotSize * .5, j - this.majorDotSize * .5, this.majorDotSize, this.majorDotSize);
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

		_useThird: function(context) {
			context.lineWidth = this.thirdLineWidth;
			context.strokeStyle = this.thirdStrokeStyle;
		},

		_useMinor: function(context) {
			context.lineWidth = this.minorLineWidth;
			context.strokeStyle = this.minorStrokeStyle;
			context.fillStyle = this.minorFillStyle;
		},

		_useMajor: function(context) {
			context.lineWidth = this.majorLineWidth;
			context.strokeStyle = this.majorStrokeStyle;
			context.fillStyle = this.majorFillStyle;
		}
	}

	var media = j$( selector )

	var x = document.createElement("CANVAS"),
		ctx = x.getContext("2d"),
		width = x.width = window.innerWidth,
		height = x.height = width;
		x.className = "silk"
	function dots() {
		grid.dots(ctx, 0, 0, width, height, 4, 4);
	}
	dots()
	var parent = media[0].parentNode;

	parent.insertBefore( x, media[0] )
	
};
if (j$("body").hasClass("home")){
	Silk("#underlay","#90278C")
}
