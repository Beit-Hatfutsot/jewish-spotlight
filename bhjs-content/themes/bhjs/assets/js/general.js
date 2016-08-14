/*!
 * IE10 viewport hack for Surface/desktop Windows 8 bug
 * Copyright 2014-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */

// See the Getting Started docs for more information:
// http://getbootstrap.com/getting-started/#support-ie10-width

(function () {
	'use strict';

	if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
		var msViewportStyle = document.createElement('style')
		msViewportStyle.appendChild(
			document.createTextNode(
				'@-ms-viewport{width:auto!important}'
			)
		)
		document.querySelector('head').appendChild(msViewportStyle)
	}

})();

var $ = jQuery,
	BhjsGeneral = {

		/**
		 * params
		 */
		params : {

			photos			: $.parseJSON( _BhjsPhotos ),
			active_photos	: 0,
			photos_columns	: 3,
			active_column	: 0,
			timeout			: 400	// general timeout (int)

		},

		/**
		 * init
		 *
		 * @since	1.0
		 * @param	N/A
		 * @return	N/A
		 */
		init : function() {

			// jQuery extentions
			$.fn.setAllToMaxHeight = function() {
				return this.height( Math.max.apply(this, $.map(this, function(e) { return $(e).height() })) );
			}

			// UnitText1 markup
			// TBD

			// Anchors click event
			BhjsGeneral.anchors();

			// Anchors waypoint event
			BhjsGeneral.topMenuWaypoints();

			// Expose first communities and luminaries
			BhjsGeneral.initIndex('community');
			BhjsGeneral.initIndex('luminary');

			// Bind click event to letters index
			$('.letter-index-container li').bind('click', BhjsGeneral.index_letter_click);

			// Bind click event to 'play video external button'
			$('.video-wrapper .video-btn-wrap').bind('click', BhjsGeneral.toggle_video_click);
					
			$('.video-wrapper video').bind("play", BhjsGeneral.toggle_video_click);

			// Init gallery
			BhjsGeneral.lazyLoad(0, 6);

			// Bind click event to gallery 'load more' btn
			$('#data-type-section-photo .load-more').bind('click', function() {
				BhjsGeneral.lazyLoad(BhjsGeneral.params.active_photos, 6);
			});

			// PhotoSwipe
			BhjsGeneral.initPhotoSwipeFromDOM('.gallery');

		},

		/**
		 * anchors
		 *
		 * Bind click event to menu items
		 *
		 * @since	1.0
		 * @param	N/A
		 * @return	N/A
		 */
		anchors : function() {

			$('.anchor').click(function() {
				// vars
				var attr			= $(this).attr('data-href'),
					header_height	= $('header').height();

				// Scroll to content
				if ( typeof attr !== typeof undefined && attr !== false && $('a[name="' + attr + '"]').length ) {
					$('html, body').animate({scrollTop: $('a[name="' + attr + '"]').offset().top - header_height }, BhjsGeneral.params.timeout);
				}
			});

		},

		/**
		 * topMenuWaypoints
		 *
		 * Bind waypoint event to menu items
		 *
		 * @since	1.0
		 * @param	N/A
		 * @return	N/A
		 */
		topMenuWaypoints : function() {

			// vars
			var menu = $('#header-bottom ul.navbar-nav');

			$('.menu-item-section').waypoint(function(direction) {
				// vars
				var activeSection	= $(this),
					sectionName		= '';

				if (direction == 'up') {
					sectionName = activeSection[0]['element']['previousElementSibling']['previousElementSibling']['name'];
				}
				else {
					sectionName = activeSection[0]['element']['name'];
				}

				// Update top menu items
				menu.children('li').removeClass('active');
				menu.find('a[data-href="' + sectionName + '"]').parent().addClass('active');
			}, {
				offset: '184px'
			});

		},

		/**
		 * initIndex
		 *
		 * Initiate letters index
		 *
		 * @since	1.0
		 * @param	type (string) list type - community/luminary
		 * @return	N/A
		 */
		initIndex : function(type) {

			var items = $('#data-type-section-' + type).find('.item-preview'),
				letters_list = $('#data-type-section-' + type).find('.letter-index-container');

			// Disable all letter buttons
			letters_list.find('li').addClass('disabled');

			// Loop through all items and enable relevant letter buttons
			items.each(function() {
				var letter = $(this).attr('data-letter');

				// Enable letter
				letters_list.find("li[data-letter='" + letter + "']").removeClass('disabled');
			});

			// Expose first enabled letter items
			letters_list.find('li').each(function() {
				if ( !$(this).hasClass('disabled') ) {
					BhjsGeneral.setIndex(type, $(this).attr('data-letter'));
					return false;
				}
			});

		},

		/**
		 * setIndex
		 *
		 * Expose list items by starting with a specific letter
		 *
		 * @since	1.0
		 * @param	type (string) list type - community/luminary
		 * @param	letter (string)
		 * @return	N/A
		 */
		setIndex : function(type, letter) {

			var items = $('#data-type-section-' + type).find('.item-preview'),
				letters_list = $('#data-type-section-' + type).find('.letter-index-container');

			// Hide all items
			items.each(function() {
				$(this).parent().addClass('hidden');
			});

			// Deactivate all letters
			letters_list.find('li').removeClass('active');

			// Activate current letter
			letters_list.find("li[data-letter='" + letter + "']").addClass('active');

			// Loop through all items and expose relavant items
			items.each(function() {
				if ($(this).attr('data-letter') == letter) {
					$(this).parent().removeClass('hidden');
				}
			});

		},

		/**
		 * index_letter_click
		 *
		 * Toggle letter
		 *
		 * @since		1.0
		 * @param		event (object)
		 * @return		N/A
		 */
		index_letter_click : function(event) {

			var current = event.currentTarget;

			if ($(current).hasClass('disabled')) {
				return;
			}

			var active = $(current).hasClass('active') ? true : false,
				list_id = $(current).parent().attr('id');

			// toggle active
			if (active) {
				//$(current).removeClass('active');
				return;
			}
			else {
				//$(current).addClass('active');
				BhjsGeneral.setIndex(list_id, $(current).attr('data-letter'));
			}
			// refresh items
			//BhjsGeneral.refresh_items(list_id);

		},

		/**
		 * toggle_video_click
		 *
		 * toggle play/pause video
		 *
		 * @since		1.0
		 * @param		event (object)
		 * @return		N/A
		 */
		toggle_video_click : function(event) {

			var trigger = event.currentTarget;
			//internal play button
			if ( $(trigger).is('.video-wrapper video') ) {
				if (!trigger.paused) {
					//stop other videos
					$('#data-type-section-video').find('video').each(function() {
						if (this != trigger) {
							this.pause();
						}
					});
				}
				external_button = $(trigger).parent().children()[0];
				$(external_button).addClass('hidden');
			}
			// if trigger is an external button
			else {
				video = $(trigger).parent().children()[1];
				video.play();
				$(trigger).addClass('hidden');
			}

		},

		/**
		 * refresh_items
		 *
		 * Refresh items grid according to filter values
		 * Not in use at the moment
		 *
		 * @since		1.0
		 * @param		srting list_id
		 * @return		N/A
		 */
		refresh_items : function(list_id) {

			// collect filters values
			var letters = [],
				items = $('#data-type-section-' + list_id).find('.item-preview'),
				empty_result = true,
				notification = $('#data-type-section-' + list_id).find('.notification');

			$('.letter-index-container#' + list_id).find('li').each(function() {
				if ( $(this).hasClass('active') ) {
					letters.push( $(this).html() );
				}
			});

			// check whether letters is empty -> show all items
			if ( letters.length == 0 ) {
				items.each(function() { $(this).parent().removeClass('hidden') });

				if ( items.length ) {
					empty_result = false;
				}
			}
			else {
				// hide items from grid
				/*var items_disp = [];*/
				items.each(function() {
					var letter = $(this).attr('data-letter');
					
					if ( $.inArray(letter, letters) == -1 ) {
						$(this).parent().addClass('hidden');
					}
					else {
						$(this).parent().removeClass('hidden');
						empty_result = false;
					}
				});
			}

			if ( empty_result ) {
				notification.show();
			} else {
				notification.hide();
			}

		},

		/**
		 * initPhotoSwipeFromDOM
		 *
		 * PhotoSwipe init
		 *
		 * @since	1.0
		 * @param	gallerySelector (string)
		 * @return	N/A
		 */
		initPhotoSwipeFromDOM : function(gallerySelector) {

			// parse slide data (url, title, size ...) from DOM elements
			// (children of gallerySelector)
			var parseThumbnailElements = function(el) {
				var galleryCols = el.children('.gallery-col'),
					items = [];

				$(galleryCols).each(function() {
					var galleryColItems = $(this).children('.gallery-item');

					$(galleryColItems).each(function() {
						var index = $(this).attr('data-index'),
							link = $(this).children('a'),
							caption = $(this).children('figcaption'),
							img = link.children('img');

						// create slide object
						var item = {
							src: link.attr('href'),
							w: img[0].naturalWidth,
							h: img[0].naturalHeight,
							msrc: img.attr('src')
						};

						if (caption) {
							item.title = caption.html();
						}

						item.el = $(this)[0]; // save link to element for getThumbBoundsFn

						items[index] = item;
					});
				});

				return items;
			};

			// triggers when user clicks on thumbnail
			var onThumbnailsClick = function(e) {
				e = e || window.event;
				e.preventDefault ? e.preventDefault() : e.returnValue = false;

				var eTarget = e.target || e.srcElement;

				// find root element of slide
				var clickedListItem = $(eTarget).parent().parent();

				if(!clickedListItem) {
					return;
				}

				// find index of clicked item
				var clickedGallery = clickedListItem.parent().parent(),
					index = clickedListItem.attr('data-index');

				if(clickedGallery && index >= 0) {
					// open PhotoSwipe if valid index found
					openPhotoSwipe( index, clickedGallery );
				}

				return false;
			};

			var openPhotoSwipe = function(index, galleryElement) {
				var pswpElement = document.querySelectorAll('.pswp')[0],
					gallery,
					options,
					items;

				items = parseThumbnailElements(galleryElement);

				// define options (if needed)
				options = {

					// define gallery index (for URL)
					galleryUID: galleryElement.attr('data-pswp-uid'),

					getThumbBoundsFn: function(index) {
						// See Options -> getThumbBoundsFn section of documentation for more info
						var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
						pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
						rect = thumbnail.getBoundingClientRect(); 

						return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
					},

					index: parseInt(index, 10)

				};

				// exit if index not found
				if( isNaN(options.index) ) {
					return;
				}

				// Pass data to PhotoSwipe and initialize it
				gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
				gallery.init();
			};

			// loop through all gallery elements and bind events
			var galleryElements = document.querySelectorAll( gallerySelector );

			for(var i = 0, l = galleryElements.length; i < l; i++) {
				galleryElements[i].setAttribute('data-pswp-uid', i+1);
				galleryElements[i].onclick = onThumbnailsClick;
			}

		},

		/**
		 * lazyLoad
		 *
		 * Load Images
		 *
		 * @since	1.0
		 * @param	offset (int)
		 * @param	amount (int)
		 * @return	N/A
		 */
		lazyLoad : function (offset, amount) {

			var index, j;

			for (index=offset, j=0 ; j<amount && BhjsGeneral.params.photos.length>index ; index++, j++) {
				// expose photo
				var photoItem =
					'<figure class="gallery-item" data-index="' + index + '" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">' +
						'<a href="' + BhjsGeneral.params.photos[index]['photo'] + '" itemprop="contentUrl">' +
							'<img src="' + BhjsGeneral.params.photos[index]['photo'] + '" itemprop="thumbnail" alt="' + BhjsGeneral.params.photos[index]['title'] + '" />' +
						'</a>' +
						'<figcaption itemprop="caption description">' + BhjsGeneral.params.photos[index]['title'] + '</figcaption>' +
					'</figure>';

				$(photoItem).appendTo( $('.gallery .col' + BhjsGeneral.params.active_column%BhjsGeneral.params.photos_columns) );

				// Update active column
				BhjsGeneral.params.active_column = BhjsGeneral.params.active_column%BhjsGeneral.params.photos_columns + 1;
			}

			if ( index == BhjsGeneral.params.photos.length ) {
				// hide more btn
				$('#data-type-section-photo .load-more').addClass('disabled');
			} else {
				// expose more btn
				$('#data-type-section-photo .load-more').removeClass('disabled');
			}

			// Update active photos
			BhjsGeneral.params.active_photos += j;

		},

		/**
		 * loaded
		 *
		 * Called by $(window).load event
		 *
		 * @since	1.0
		 * @param	N/A
		 * @return	N/A
		 */
		loaded : function() {

			// BhjsGeneral.alignments();

		},

		/**
		 * alignments
		 *
		 * Align components after window resize event
		 *
		 * @since	1.0
		 * @param	N/A
		 * @return	N/A
		 */
		alignments : function() {}

	};

// make it safe to use console.log always
(function(a){function b(){}for(var c="assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,markTimeline,profile,profileEnd,time,timeEnd,trace,warn".split(","),d;!!(d=c.pop());){a[d]=a[d]||b;}})
(function(){try{console.log();return window.console;}catch(a){return (window.console={});}}());

$(BhjsGeneral.init);
$(window).load(BhjsGeneral.loaded);