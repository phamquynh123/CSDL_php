/*	(\__/)		====================================================================================
	(>'.'<)	=== D A N I E L   W U N D E R  //  E S L Y - C O V E R L I N E S   P R O D U C T I O N S ===
	(")_(")		====================================================================================		*/
// alert('OK');
// -------------------------------------------------------------------------------------------
// --------------   !!!  J Q U E R Y - N O C O N F L I C T !!!  -------------- 
// $.noConflict();
// jQuery(document).ready(function($){
// --------------   !!!  J Q U E R Y - N O C O N F L I C T !!!  -------------- 
// -------------------------------------------------------------------------------------------
// or like following...
$(document).ready(function(){
	var abcObj = {
		/* ---------------------------------- P R O P I E T I E S */

		// ################# SPECIAL PROPIETIES, YOU CAN CHANGE - START
		// ################# SPECIAL PROPIETIES, YOU CAN CHANGE - START

		// ---------------------------------- layout of gallery propieties
		overlayBgColor: 'rgba(33,33,33,0.5)',/* for new browser versions*/
		overlayBgColorIE: 'rgb(0,0,0)',//'rgb(33,33,33)'<-- original buttons color !!!, /* ie6 - ie8 fallback */
		// ---------------------------------- gallery-navigation propieties
		navBgColor: '#212121', // this color adapted to jpg-navigation-images (for old IE versions)
		navButtonsColor: '#FFFFFF', // for new browsers (IE8+)
		navOpacity: '0.35', // FOR new broWsers (IE9+) only, --- opacity ---> 0(0%)-1(100%)
		// ---------------------------------- 'image-load' & 'image-error' propieties
		loadNoImgBgColor: 'rgba(33,33,33,0.5)',
		loadNoImgBgColorIE: 'rgb(33,33,33)',//'rgb(33,33,33)'<-- original icons bg-color !!!, /* ie6 - ie8 fallback */
		loadNoImgBorderWidth: '5', /* border width */
		loadNoImgBorderStyle: 'solid', /* border style */
		loadNoImgBorderColor: '#FFFFFF', /* border color */
		loadNoImgTextColor: '#FFFFFF', /* text color */
		// to embed another SVG take a look to 'createOverlay' - method of this object, how insert the color ---> or do it more easy... like following
		loadingAnimation: null, // null - for GIF/SVG-Images on board... //'<b>ON LOAD<br>...</b>', // <--- or like this !!!--- your text... your img... etc.
		noImg: null, // null - for PNG/SVG-Images on board... //'<b>NO IMAGE<br>available</b>', // <--- or like this !!!--- your text... your img... etc.
		// ---------------------------------- image-border-styles
		imgBorderWidth: '7', /* border width */
		imgBorderStyle: 'solid', /* border style */
		imgBorderColor: '#FFFFFF', /* border color */
		// ---------------------------------- time-intervals
		playerInterval: 2000, // image change on play
		hideShowNaviInterval: 2000, // time for showing navigation

		fadeInterval: 500, // galleryNavi, etc.
		fadeIntervalFast: 200, // gallery overlay, etc.

		onresizeBreak: 300,
		ie6_7responsiveBreak: 1200,
		// ---------------------------------- markup
		removeMobileMarkUp: false, // when 'true', removes mobile markup from buttons...

		// ################# SPECIAL PROPIETIES, YOU CAN CHANGE - END
		// ################# SPECIAL PROPIETIES, YOU CAN CHANGE - END

		/* ---------------------------------- window & browser variables*/
		galleryOn: false, // is used by key-events
		win : $(window), // used on occasion in script
		ieSvgAnimationCheck: true,
		winH: 0, // window-object height
		winW: 0, // window-object width
		ieVer: null, // IE(InternetExplorer) Versions 6-8
		oldViewport: null, // saves old viewport value...
		overlay: null, // used on occasion in script
		/* ---------------------------------- navi buttons */
		divNav: null,
		plPauseBtn: null,
		prevImg: null,
		nextImg: null,
		closeG: null,
		/* ---------------------------------- image variables */
		imgObj: null,
		imgIndexClicked: null,
		imgsCount: null,
		imgsJqCollection: null,
		divForImgs: null,

		imgPathArray : new Array(),

		preloaderHeight: 0,
		noImgHeight: 0,
		/* ---------------------------------- interval time variables*/
		ei6_7ResponseInterval: null,

		playerFlag: false,
		naviFlag: false,

		timeCounterPlayer: null,
		timeCounterNavi: null,

		resizeTimeOut: null,
		navHoverTimeOut: null,
		/* ---------------------------------- M E T H O D S */
	    winOnResize: function() {
			if (abcObj.ieVer !== null) {
					abcObj.overlayCSS();
					abcObj.showGallery();
			} else {
				clearTimeout(abcObj.resizeTimeOut);
				abcObj.resizeTimeOut = setTimeout ( function() {
					abcObj.overlayCSS();
					abcObj.showGallery(); //alert('RESIZE END');
				}, abcObj.onresizeBreak);
			}
	    },
	    showHideNavi: function() { //alert('HOVER');
	    	abcObj.divNav.css({'display': 'block'});
	    	if (abcObj.navHoverTimeOut !== null) clearTimeout( abcObj.navHoverTimeOut );
	    	if (abcObj.naviFlag === false) {	//	alert('LEAVE');
		    	abcObj.navHoverTimeOut = setTimeout ( function() {
		    		if (abcObj.ieVer !== null && abcObj.ieVer < 9) {
		    			abcObj.divNav.css({'display': 'none'});
		    		} else {
					abcObj.divNav.fadeOut(abcObj.fadeInterval); 
					}
				}, abcObj.hideShowNaviInterval);
			}
	    },
		closeGallery : function() {
			abcObj.galleryOn = false;
			// --------------------------------------------- clear Timeouts
			if (abcObj.naviFlag) { clearTimeout(abcObj.timeCounterNavi); abcObj.naviFlag = false; } // show-navi Timeout is off
			if (abcObj.playerFlag === true) { clearInterval(abcObj.timeCounterPlayer); abcObj.playerFlag = false; } // slideshow Timeout is off
			if (abcObj.ei6_7ResponseInterval !== null) {clearInterval(abcObj.ei6_7ResponseInterval); abcObj.ei6_7ResponseInterval = null;}
			// --------------------------------------------- set overflow to 'auto' value
			if (abcObj.ieVer !== null) {
			// --------------------------------------------- remove overlay
				abcObj.overlay.remove(); // remove gallery-overlay & all inside divs from DOM !!!
				if (abcObj.ieVer < 8) $('body, html').off('scroll touchmove mousewheel');
			} else {
			// --------------------------------------------- remove overlay
				abcObj.overlay.fadeOut(abcObj.fadeInterval, function(){	abcObj.overlay.remove(); }); // remove gallery-overlay & all inside divs from DOM !!!
				//setTimeout (function(){ $('html').css({'overflow': 'auto'});}, abcObj.fadeIntervalFast);
			}
			// --------------------------------------------- get old viewport values
	    	if (typeof abcObj.oldViewport !== null)	{ $("meta[name='viewport']").attr('content', abcObj.oldViewport); 
	    	} else {
	    	 	$( "meta[name='viewport']" ).remove(); 
	    	}
			$('body, html').off('scroll touchmove mousewheel');
		},
		prevImage : function() {
			abcObj.imgIndexClicked = (abcObj.imgIndexClicked - 1);
			if (abcObj.imgIndexClicked === (-1)) {abcObj.imgIndexClicked = abcObj.imgsCount -1;}
			abcObj.showGallery(abcObj.imgIndexClicked);
		},
		nextImage : function() {
			abcObj.imgIndexClicked = (abcObj.imgIndexClicked + 1);
			if (abcObj.imgIndexClicked === abcObj.imgsCount) {abcObj.imgIndexClicked = 0;}
			abcObj.showGallery(abcObj.imgIndexClicked);
		},
		playerGallery : function() {
			if (abcObj.playerFlag === false) {  // SLIDE SHOW WAS CLICKED 'PLAY'
				abcObj.playerFlag = true; // 'abcObj.playerFlag' gets value === true...

				if(abcObj.ieVer !== null) {
					abcObj.plPauseBtn.removeClass('abc-img-play').addClass('abc-img-pause');
				} else {
					abcObj.plPauseBtn.removeClass('abc-ico-play').addClass('abc-ico-pause');
				}
				abcObj.timeCounterPlayer = setInterval (abcObj.nextImage, abcObj.playerInterval);
			} else {  // SLIDE SHOW WAS CLICKED 'PAUSE'
				clearInterval(abcObj.timeCounterPlayer);
				abcObj.playerFlag = false;
				if(abcObj.ieVer !== null) {
					abcObj.plPauseBtn.removeClass('abc-img-pause').addClass('abc-img-play');
				} else {
					abcObj.plPauseBtn.removeClass('abc-ico-pause').addClass('abc-ico-play');
				}
			}
		},
		showGallery: function() {
	    	var top_Dist;
	    	var img_border; // see this method --> onload !!!
			top_Dist = Math.round((abcObj.winH - abcObj.preloaderHeight)/2);
			abcObj.divForImgs.empty(); // empty div for new images
			$('.abc-no-image').css({'display': 'none'}); // 'no-error'-div is dimmed
// ----------------------------------------------------------------------------------- preloader is on before the current image ready
			$('.abc-preloader').css({'display': 'block', 'top': (top_Dist) + 'px' }); //alert(top_Dist);
	    	if (abcObj.playerFlag === true) { clearInterval(abcObj.timeCounterPlayer); } // 'timeCounterPlayer' is stoped, when true...
	    	// !!! peculiarity !!! in javaScript for image-object !!!... 
	    	abcObj.imgObj = new Image(); // generate an image-object, after u see, how this thereby will be bypassed
	    	// !!! peculiarity !!! in javaScript for image-object !!!... --> see end rows of this 'object'-method/ 'showGallery'-method...
// ----------------------------------------------------------------------------------- event-listener by error-check by upload
	    	abcObj.imgObj.onerror = function () { // ERROR by image-upload
	    		top_Dist = Math.round((abcObj.winH - abcObj.noImgHeight)/2);
	    		$('.abc-preloader').css({'display': 'none'}); // preloader is hidden
	    		$('.abc-no-image').css({'display': 'block', 'top': + top_Dist + 'px'}); // error-symbol is displayed
	    		// in case, the play-button on --> nextImage()
	    		if (abcObj.playerFlag === true) abcObj.timeCounterPlayer = setInterval (abcObj.nextImage, abcObj.playerInterval);
	    	}; // END OF --> error-check by upload
// ----------------------------------------------------------------------------------- event-listener by pictures on upload
			abcObj.imgObj.onload = function () {
				$('.abc-div-for-images > img').css({ 'display': 'none'}); //alert('WATCHING PRELOADER ???');
				$('.abc-preloader').css({'display': 'none'}); // preloader is hidden
				$('.abc-no-image').css({'display': 'none'}); // 'no-error'-div is dimmed
				top_Dist = 0;
				var img_border = (parseInt(abcObj.imgBorderWidth));
				var img_border_X_2 = (img_border*2);
				abcObj.divForImgs.prepend(abcObj.imgObj); // prepend the current image
				var img_H = abcObj.imgObj.height || $('.abc-div-for-images > img').height(); //console.log(img_H); // ORIGINAL HEIGHT
				var img_W = abcObj.imgObj.width || $('.abc-div-for-images > img').width(); //console.log(img_W); // ORIGINAL WIDTH
				img_H = img_H + img_border_X_2;
				img_W = img_W + img_border_X_2;
// -----------------------------------------------------------------------------------				
				if( img_H >= abcObj.winH || img_W >= abcObj.winW ) {
// -----------------------------------------------------------------------------------
						$('.abc-div-for-images > img').css({	// set the styles
								'height': (abcObj.winH - img_border_X_2) + 'px',
								'width': 'auto'
						});
						img_W = $('.abc-div-for-images > img').width();	// alert(img_W); // current WIDTH after css-resize of HEIGHT
						if ((img_W + img_border_X_2) >= abcObj.winW) { // check proportions
							$('.abc-div-for-images > img').css({	// set the styles
							'width': (abcObj.winW - img_border_X_2) + 'px',
							'height': 'auto'
							});
						}
						img_H = $('.abc-div-for-images > img').height(); // current HEIGHT after RESIZE of WIDTH
						img_W = $('.abc-div-for-images > img').width(); // current WIDTH after RESIZE of HEIGHT
// -----------------------------------------------------------------------------------
				} else {
					img_H = abcObj.imgObj.height || $('.abc-div-for-images > img').height();
					img_W = abcObj.imgObj.width || $('.abc-div-for-images > img').width();
				}
// -----------------------------------------------------------------------------------
				if (abcObj.imgBorderWidth !== '0') {
					$('.abc-div-for-images > img').css({ 'display': 'block', 'border': abcObj.imgBorderWidth + 'px ' + abcObj.imgBorderStyle + ' ' + abcObj.imgBorderColor });
				} else {
					$('.abc-div-for-images > img').css({ 'display': 'block'});
				};
				if (abcObj.winH > img_H) {// TO CENTER THE IMAGE
					top_Dist = Math.round((abcObj.winH - (img_H + img_border_X_2 ))/2);
				}
				abcObj.divForImgs.css({	// set the styles
						'height': (img_H + img_border_X_2) + 'px',
						'width': (img_W + img_border_X_2) + 'px',
						'top': (top_Dist) + 'px', // see 'abc-gallery.css' --> margin-left: auto !important; margin-right: auto !important;
						'display': 'block'
				});
				if (abcObj.playerFlag === true) { // in case, when the slide-show is on --> nextImage()
					abcObj.timeCounterPlayer = setInterval (abcObj.nextImage, abcObj.playerInterval);
				}
			};// END OF --> onload
			// ------------------------------------------------------------------------
			abcObj.imgObj.src = (abcObj.imgPathArray[abcObj.imgIndexClicked]);
			// ------------------------------------------------------------------------
		},
	    getImagePaths: function() {
	    	var current_path = abcObj.imgObj.getAttribute ('href');
			var img_Href;
			abcObj.imgsJqCollection = $(abcObj.imgObj).parentsUntil('.abc-gallery-div').parent().find('a'); //console.log(abcObj.imgsJqCollection); // all links to images are selected
			abcObj.imgsCount = abcObj.imgsJqCollection.length; // how much links to images
			for (var i = 0; i <= (abcObj.imgsCount-1); i++) { // get values of paths in 'imgPathArray'
				img_Href = abcObj.imgsJqCollection[i].getAttribute ('href');
				if (current_path === img_Href){	abcObj.imgIndexClicked = i; /*alert (i + '---' + img_Href);*/ }
				abcObj.imgPathArray[i] = img_Href; // alert(i + '---' + abcObj.imgIndexClicked);
			};
	    },
	    overlayCSS: function() {
			abcObj.winH = $(window).height(); // height of window-object
			abcObj.winW = $(window).width(); // height of window-object
			abcObj.overlay.css ({
						'height': abcObj.winH + 'px',
						'width': abcObj.winW + 'px',
						'background': abcObj.overlayBgColor	});
			if (abcObj.ieVer !== null) { // IE < 9
				// ----------------------------------- OVERLAY-CSS >> NAVI
				abcObj.divNav.css({ 'background': abcObj.navBgColor });
				abcObj.prevImg.addClass( "abc-img-prev" );
				abcObj.nextImg.addClass( "abc-img-next" );
				if (abcObj.playerFlag === false) {
					abcObj.plPauseBtn.addClass( "abc-img-play" );
				} else {
					abcObj.plPauseBtn.addClass( "abc-img-pause" );
				}
				abcObj.closeG.addClass( "abc-img-close" );
			} else {
				// ----------------------------------- OVERLAY-CSS >> NAVI as 'icomoon'-font
				abcObj.divNav.css({ 'background': abcObj.navBgColor, 'opacity': abcObj.navOpacity });
				abcObj.prevImg.addClass( "abc-ico-prev" ).css({'color': abcObj.navButtonsColor});
				abcObj.nextImg.addClass( "abc-ico-next" ).css({'color': abcObj.navButtonsColor});
				if (abcObj.playerFlag === false) {
					abcObj.plPauseBtn.addClass( "abc-ico-play" ).css({'color': abcObj.navButtonsColor});
				} else {
					abcObj.plPauseBtn.addClass( "abc-ico-pause" ).css({'color': abcObj.navButtonsColor});
				}
				abcObj.closeG.addClass( "abc-ico-close" ).css({ 'color': abcObj.navButtonsColor });
			}

				$('.abc-preloader-inside').css({ 'border': abcObj.loadNoImgBorderWidth + 'px ' + abcObj.loadNoImgBorderStyle + ' ' + abcObj.loadNoImgBorderColor, 'color': abcObj.loadNoImgTextColor, 'background' : abcObj.loadNoImgBgColor });
				$('.abc-no-img-inside').css({ 'border': abcObj.loadNoImgBorderWidth + 'px ' + abcObj.loadNoImgBorderStyle + ' ' + abcObj.loadNoImgBorderColor, 'color': abcObj.loadNoImgTextColor, 'background' : abcObj.loadNoImgBgColor });
	    },
		createOverlay: function() {
			if (abcObj.loadingAnimation === null) {
				if (abcObj.ieSvgAnimationCheck) { // S V G - Preloader for new Browsers
				abcObj.loadingAnimation = '<svg width="80px" height="80px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="uil-spin"><rect x="0" y="0" width="100" height="100" fill="none" class="bk"></rect><g transform="translate(50 50)"><g transform="rotate(0) translate(34 0)"><circle cx="0" cy="0" r="8" fill="' + abcObj.navButtonsColor + '"><animate attributeName="opacity" from="1" to="0.1" begin="0s" dur="1s" repeatCount="indefinite"></animate><animateTransform attributeName="transform" type="scale" from="1.5" to="1" begin="0s" dur="1s" repeatCount="indefinite"></animateTransform></circle></g><g transform="rotate(45) translate(34 0)"><circle cx="0" cy="0" r="8" fill="' + abcObj.navButtonsColor + '"><animate attributeName="opacity" from="1" to="0.1" begin="0.12s" dur="1s" repeatCount="indefinite"></animate><animateTransform attributeName="transform" type="scale" from="1.5" to="1" begin="0.12s" dur="1s" repeatCount="indefinite"></animateTransform></circle></g><g transform="rotate(90) translate(34 0)"><circle cx="0" cy="0" r="8" fill="' + abcObj.navButtonsColor + '"><animate attributeName="opacity" from="1" to="0.1" begin="0.25s" dur="1s" repeatCount="indefinite"></animate><animateTransform attributeName="transform" type="scale" from="1.5" to="1" begin="0.25s" dur="1s" repeatCount="indefinite"></animateTransform></circle></g><g transform="rotate(135) translate(34 0)"><circle cx="0" cy="0" r="8" fill="' + abcObj.navButtonsColor + '"><animate attributeName="opacity" from="1" to="0.1" begin="0.37s" dur="1s" repeatCount="indefinite"></animate><animateTransform attributeName="transform" type="scale" from="1.5" to="1" begin="0.37s" dur="1s" repeatCount="indefinite"></animateTransform></circle></g><g transform="rotate(180) translate(34 0)"><circle cx="0" cy="0" r="8" fill="' + abcObj.navButtonsColor + '"><animate attributeName="opacity" from="1" to="0.1" begin="0.5s" dur="1s" repeatCount="indefinite"></animate><animateTransform attributeName="transform" type="scale" from="1.5" to="1" begin="0.5s" dur="1s" repeatCount="indefinite"></animateTransform></circle></g><g transform="rotate(225) translate(34 0)"><circle cx="0" cy="0" r="8" fill="' + abcObj.navButtonsColor + '"><animate attributeName="opacity" from="1" to="0.1" begin="0.62s" dur="1s" repeatCount="indefinite"></animate><animateTransform attributeName="transform" type="scale" from="1.5" to="1" begin="0.62s" dur="1s" repeatCount="indefinite"></animateTransform></circle></g><g transform="rotate(270) translate(34 0)"><circle cx="0" cy="0" r="8" fill="' + abcObj.navButtonsColor + '"><animate attributeName="opacity" from="1" to="0.1" begin="0.75s" dur="1s" repeatCount="indefinite"></animate><animateTransform attributeName="transform" type="scale" from="1.5" to="1" begin="0.75s" dur="1s" repeatCount="indefinite"></animateTransform></circle></g><g transform="rotate(315) translate(34 0)"><circle cx="0" cy="0" r="8" fill="' + abcObj.navButtonsColor + '"><animate attributeName="opacity" from="1" to="0.1" begin="0.87s" dur="1s" repeatCount="indefinite"></animate><animateTransform attributeName="transform" type="scale" from="1.5" to="1" begin="0.87s" dur="1s" repeatCount="indefinite"></animateTransform></circle></g></g></svg>';
				} else { // G I F - Preloader for old Browsers
					abcObj.loadingAnimation = '<div class="abc-preloader-bg"></div>';
				};
			}
			if (abcObj.noImg === null) { // S V G - 'no-image' for new Browsers
				if (abcObj.ieVer === null) {
					abcObj.noImg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><title>no-image</title><path d="M100,71.9A28,28,0,0,0,75,44V17.5L57.5,0H0V100H75V99.8A28,28,0,0,0,100,71.9ZM56.2,7.5L67.4,18.7H56.2V7.5ZM6.3,93.8V6.2H50V25H68.8V43.9a28.16,28.16,0,0,0-7.7,2,7.28,7.28,0,0,0-4.8-2.2H50l-6.3-6.3H31.3L25,43.8H18.7s-6.3,0-6.3,6.3V68.9c0,6.3,6.3,6.3,6.3,6.3H43.9A28.16,28.16,0,0,0,54.2,94H6.3V93.8Zm31.2-25a9.4,9.4,0,0,1,0-18.8,9.24,9.24,0,0,1,9.3,9.1,33.48,33.48,0,0,0-2.4,6.5A9.06,9.06,0,0,1,37.5,68.8Zm34.4,25A21.9,21.9,0,1,1,93.8,71.9,22,22,0,0,1,71.9,93.8Z" transform="translate(0 0)" fill="' + abcObj.navButtonsColor + '"/><polygon points="59.4 78.1 65.6 84.4 71.9 78.1 78.1 84.4 84.4 78.1 78.1 71.9 84.4 65.6 78.1 59.4 71.9 65.6 65.6 59.4 59.4 65.6 65.6 71.9 59.4 78.1" fill="' + abcObj.navButtonsColor + '"/></svg>';
				} else { // P N G - Image for old Browsers
					abcObj.noImg = '<div class="abc-no-image-bg"></div>';
				};
			};
			abcObj.overlay = ('<div class="abc-gallery-overlay">'
								// div for images
								+ '<div class="abc-div-for-images"></div>'
								//abc-preloader
								+ '<div class="abc-preloader"><div class="abc-preloader-inside">'
									+ abcObj.loadingAnimation + '</div></div>'
								// no-image
								+ '<div class="abc-no-image"><div class="abc-no-img-inside">' 
									+ abcObj.noImg + '</div></div>'
								// abc-nav-btns-gallery
								+ '<div class="abc-nav-btns icons"><div>'
									+ '<div class="abc-prev"></div>'
									+ '<div class="abc-next"></div>'
									+ '<div class="abc-play-pause"></div>'
									+ '<div class="abc-close"></div>'
								+ '</div></div>'
							+ '</div>');

			$('body').append(abcObj.overlay);
			// new propertie values for 'abcObj':
			abcObj.divNav = $('.abc-nav-btns');
			abcObj.prevImg = $('div.abc-prev');
	    	abcObj.nextImg = $('div.abc-next');
	    	abcObj.plPauseBtn = $('div.abc-play-pause');
	    	abcObj.closeG = $('div.abc-close');

	    	abcObj.overlay = $('div.abc-gallery-overlay');
	    	abcObj.divForImgs = $('div.abc-div-for-images');
			abcObj.preloaderHeight = parseInt(($('.abc-preloader').css("height")));
			abcObj.noImgHeight = parseInt(($('.abc-no-image').css("height")));
	    },
	    checkViewPort: function() {
	    	if ( $("meta[name='viewport']").length ) { // if element 'meta' exists
	    		// save the 'content' of 'viewport'... in the next cell this will be overwritten...
            	abcObj.oldViewport = $("meta[name='viewport']").attr('content');
        		$( "meta[name='viewport']" ).attr('content', 'target-densitydpi=device-dpi, '
        										+ 'height=device-height, width=device-width, initial-scale=1.0, '
        										+ 'maximum-scale=1.0, minimum-scale=1.0, user-scalable=no');
        	} else { // new 'viewport' will be inserted...
            	var noscale_Gallery = ('<meta name="viewport" content="target-densitydpi=device-dpi, '
            							+ 'height=device-height, width=device-width, initial-scale=1.0, '
            							+ 'maximum-scale=1.0, minimum-scale=1.0, user-scalable=no"/>');
            	$('head').append(noscale_Gallery);
            	noscale_Gallery = null; // clear variable's value
        	}
	    },
	    checkBrowser: function() {
		    var nv_Array = navigator.userAgent.match(/(?:MSIE |Trident\/.*; rv:)(\d+)/);
		    if (nv_Array) { // !!!!! IE - browsers don't support SVG animation !!!!!
		    	abcObj.ieSvgAnimationCheck = false;
			    if (nv_Array && nv_Array[1] <= 8) {
			    	//document.write(nv_Array[1]);
			    	abcObj.ieVer = nv_Array[1];
			    	abcObj.overlayBgColor = abcObj.overlayBgColorIE;
			    	abcObj.loadNoImgBgColor = abcObj.loadNoImgBgColorIE;
			    }
			}
		},
		galleryInit: function() {
			abcObj.galleryOn = true;
			abcObj.checkBrowser();		
			abcObj.checkViewPort();
			abcObj.createOverlay(); // create 'abc-gallery-overlay'
			abcObj.overlayCSS();
			abcObj.getImagePaths();
			abcObj.showGallery();
			// E V E N T - L I S T E N E R S - S T A R T
			// E V E N T - L I S T E N E R S - S T A R T
			abcObj.plPauseBtn.on( "click", abcObj.playerGallery);
	    	abcObj.prevImg.on( "click", abcObj.prevImage);
	    	abcObj.nextImg.on( "click", abcObj.nextImage);
			abcObj.closeG.on( "click", abcObj.closeGallery);
			$('body').on( "click", abcObj.showHideNavi);
			abcObj.divNav.on("mouseover", function() { // mouseover for navigation - visible
				abcObj.naviFlag = true;
				abcObj.showHideNavi();
			});
			abcObj.divNav.on("mouseleave", function() { // mouseleave for navigation - hidden
				abcObj.naviFlag = false;
				abcObj.showHideNavi();
			});
			if (abcObj.ieVer === null || abcObj.ieVer > 7) {
				if (abcObj.removeMobileMarkUp) {$(document).on( "touchstart", function() {}, false);} // removes markup for buttons in mobile modus
				$('body').bind("touchmove", function(e){
					if (abcObj.galleryOn) {
						e.preventDefault();
						abcObj.showHideNavi();
					} 
				}); // no 'touchmove' - event <--- e.preventDefault();
				$(window).on("resize", abcObj.winOnResize).on("orientationchange", function() {
					if (abcObj.galleryOn) abcObj.winOnResize(); // NOT WORKING IN EI 6-7, see --> abcObj.winOnResize();
				});
			} else { // One of the ways to get the gallery responsive in IE6-7... resize-event is not good working...
				if (abcObj.galleryOn) {
					abcObj.ei6_7ResponseInterval = setInterval (function(){
						abcObj.overlayCSS();
						if (!abcObj.playerFlag) {
							abcObj.showGallery();
						}
					}, abcObj.ie6_7responsiveBreak);
				}
			}
			if (abcObj.ieVer < 8) $('body, html').on('scroll touchmove mousewheel', function(e){
				e.preventDefault();
				e.stopPropagation();
				return false;
			});
			document.onkeydown = function(e){
				e = e || event; //if e doesn't exist (like in IE), replace it with window.event
				if ( e!== null || e!== undefined) {
					switch(e.keyCode) {
						case 37: // left-arrow-key
							if (abcObj.galleryOn) abcObj.prevImage();
							return false;
						case 38: // up-arrow-key
							if (abcObj.galleryOn) abcObj.nextImage();
							return false;
						case 39: // right-arrow-key
							if (abcObj.galleryOn) abcObj.nextImage();
							return false;

						case 40: // down-arrow-key
							if (abcObj.galleryOn) abcObj.prevImage();
							return false;
						case 27: // esc --- NOT WORKING IN EI 6-8
							if (abcObj.galleryOn) abcObj.closeGallery();
							return false;
						case 32: // break-key (play/pause)
							if (abcObj.galleryOn) {
								abcObj.naviFlag = false;
								abcObj.showHideNavi();
								abcObj.playerGallery();
							}
							return false;
					}
				}
			};
			// E V E N T - L I S T E N E R S - E N D
			// E V E N T - L I S T E N E R S - E N D
		}
// -------------------------------------------------------------
	}; // END OF 'abcObj'
// ------------------------------------------------------------- START
	$('.abc-gallery-div a').on( "click", function(event) {
		event.preventDefault();
		// new property value for 'abcObj':
		abcObj.imgObj = this;
		// start of gallery-show
		abcObj.galleryInit();
	});
});