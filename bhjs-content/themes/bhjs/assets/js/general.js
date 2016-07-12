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

			timeout		: 400	// general timeout (int)

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

			// Bind click event to letters index
			$('.letter-index-container li').bind('click', BhjsGeneral.index_letter_click);

			// Photo data type
			setTimeout(BhjsGeneral.photoGallery, BhjsGeneral.params.timeout);

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
		 * index_letter_click
		 *
		 * Toggle letter
		 *
		 * @since		1.0
		 * @param		event (object)
		 * @return		N/A
		 */
		index_letter_click : function(event) {

			var current = event.currentTarget,
				active = $(current).hasClass('active') ? true : false,
				list_id = $(current).parent().attr('id');

			// toggle active
			if (active) {
				$(current).removeClass('active');
			}
			else {
				$(current).addClass('active');
			}

			// refresh items
			BhjsGeneral.refresh_items(list_id);

		},
		/**
		 * refresh_items
		 *
		 * Refresh items grid according to filter values
		 *
		 * @since		1.0
		 * @param		srting list_id
		 * @return		N/A
		 */
		refresh_items : function(list_id) {
			// collect filters values
			var letters = [];

			$('.letter-index-container#' + list_id).find('li').each(function() {
				if ( $(this).hasClass('active') ) {
					letters.push( $(this).html() );
				}
			});

			// check whether letters is empty -> show all items
			if ( letters.length == 0 ) {
				$('#data-type-section-' + list_id).find('.item-preview').removeClass('hidden');
			}
			else {
				// hide items from grid
				$('#data-type-section-' + list_id).find('.item-preview').each(function() {
					var letter = $(this).attr('data-letter');

					if ( $.inArray(letter, letters) == -1 ) {
						$(this).addClass('hidden');
					}
					else {
						$(this).removeClass('hidden');
					}
				});
			}

		},

		/**
		 * photoGallery
		 *
		 * Arrange gallery photos grid
		 *
		 * @since	1.0
		 * @param	N/A
		 * @return	N/A
		 */
		photoGallery : function() {

			var gallery			= $('.gallery'),
				index			= 0,
				width			= 1140,
				columns			= 4,
				left			= 0,
				top				= 0,
				galleryHeight	= 0;

			if (gallery.length) {
				var photos = gallery.children('.gallery-item');

				if (photos.length) {
					photos.each(function() {
						// Update left/top values
						left	= (index*width/columns)%width;
						top		= (index>=columns) ? photos.eq(index-4).position().top + photos.eq(index-4).find('img').outerHeight() : 0;

						// Set photo left/top values
						$(this).css({'left': left + 'px', 'top': top + 'px'});

						// Expose photo
						$(this).show();

						// Update gallery height
						currHeight = $(this).position().top + $(this).find('img').outerHeight();
						galleryHeight = currHeight > galleryHeight ? currHeight : galleryHeight;

						// Update index
						index++;
					});
				}

				// Set gallery height
				gallery.height(galleryHeight);
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
				var thumbElements = el.childNodes,
					numNodes = thumbElements.length,
					items = [],
					figureEl,
					linkEl,
					imgEl,
					item;

				for(var i = 0; i < numNodes; i++) {

					figureEl = thumbElements[i]; // <figure> element

					// include only element nodes 
					if(figureEl.nodeType !== 1) {
						continue;
					}

					linkEl = figureEl.children[0]; // <a> element
					imgEl = linkEl.children[0]; // <img> element

					// create slide object
					item = {
						src: linkEl.getAttribute('href'),
						w: imgEl.naturalWidth,
						h: imgEl.naturalHeight
					};

					if(figureEl.children.length > 1) {
						// <figcaption> content
						item.title = figureEl.children[1].innerHTML; 
					}

					if(linkEl.children.length > 0) {
						// <img> thumbnail element, retrieving thumbnail url
						item.msrc = linkEl.children[0].getAttribute('src');
					} 

					item.el = figureEl; // save link to element for getThumbBoundsFn
					items.push(item);
				}

				return items;
			};

			// find nearest parent element
			var closest = function closest(el, fn) {
				return el && ( fn(el) ? el : closest(el.parentNode, fn) );
			};

			// triggers when user clicks on thumbnail
			var onThumbnailsClick = function(e) {
				e = e || window.event;
				e.preventDefault ? e.preventDefault() : e.returnValue = false;

				var eTarget = e.target || e.srcElement;

				// find root element of slide
				var clickedListItem = closest(eTarget, function(el) {
					return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
				});

				if(!clickedListItem) {
					return;
				}

				// find index of clicked item by looping through all child nodes
				// alternatively, you may define index via data- attribute
				var clickedGallery = clickedListItem.parentNode,
					childNodes = clickedListItem.parentNode.childNodes,
					numChildNodes = childNodes.length,
					nodeIndex = 0,
					index;

				for (var i = 0; i < numChildNodes; i++) {
					if(childNodes[i].nodeType !== 1) { 
						continue;
					}

					if(childNodes[i] === clickedListItem) {
						index = nodeIndex;
						break;
					}
					nodeIndex++;
				}

				if(index >= 0) {
					// open PhotoSwipe if valid index found
					openPhotoSwipe( index, clickedGallery );
				}
				return false;
			};

			// parse picture index and gallery index from URL (#&pid=1&gid=2)
			var photoswipeParseHash = function() {
				var hash = window.location.hash.substring(1),
				params = {};

				if(hash.length < 5) {
					return params;
				}

				var vars = hash.split('&');
				for (var i = 0; i < vars.length; i++) {
					if(!vars[i]) {
						continue;
					}
					var pair = vars[i].split('=');  
					if(pair.length < 2) {
						continue;
					}
					params[pair[0]] = pair[1];
				}

				if(params.gid) {
					params.gid = parseInt(params.gid, 10);
				}

				return params;
			};

			var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
				var pswpElement = document.querySelectorAll('.pswp')[0],
					gallery,
					options,
					items;

				items = parseThumbnailElements(galleryElement);

				// define options (if needed)
				options = {

					// define gallery index (for URL)
					galleryUID: galleryElement.getAttribute('data-pswp-uid'),

					getThumbBoundsFn: function(index) {
						// See Options -> getThumbBoundsFn section of documentation for more info
						var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
							pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
							rect = thumbnail.getBoundingClientRect(); 

						return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
					}

				};

				// PhotoSwipe opened from URL
				if(fromURL) {
					if(options.galleryPIDs) {
						// parse real index when custom PIDs are used 
						// http://photoswipe.com/documentation/faq.html#custom-pid-in-url
						for(var j = 0; j < items.length; j++) {
							if(items[j].pid == index) {
								options.index = j;
								break;
							}
						}
					} else {
						// in URL indexes start from 1
						options.index = parseInt(index, 10) - 1;
					}
				} else {
					options.index = parseInt(index, 10);
				}

				// exit if index not found
				if( isNaN(options.index) ) {
					return;
				}

				if(disableAnimation) {
					options.showAnimationDuration = 0;
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

			// Parse URL and open gallery if it contains #&pid=3&gid=1
			var hashData = photoswipeParseHash();
			if(hashData.pid && hashData.gid) {
				openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
			}

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