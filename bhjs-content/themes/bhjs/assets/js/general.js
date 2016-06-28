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

			// Anchors click event
			BhjsGeneral.anchors();

			// Anchors waypoint event
			BhjsGeneral.topMenuWaypoints();

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