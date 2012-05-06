;(function( $, undefined ) {
	
	if (!Array.min) { Array.min = function( array ){return Math.min.apply( Math, array )} }
	if (!Array.max) { Array.max = function( array ){return Math.max.apply( Math, array )} }
	var me, settings = {
		days				: 10,
		startDay			: new Date(),
		rooms				: []
	};
	
	function render() {
		var html = [];
		html.push(
		'<table id="hms_main">',
			'<tr><td rowspan="2">&nbsp;</td><td style="">', renderDays(), '</td><td rowspan="2" style="padding: 0;"><div id="vscrollbarPlaceholder" style="width: 17px;"></div></td></tr>',
			'<tr><td>criteria</td></tr>',
			'<tr><td style="padding: 0; overflow: hidden;">', renderRooms(), '</td><td style="padding: 0; overflow: hidden;" rowspan="2" colspan="2">', renderPrices(), '</td></tr>',
			'<tr><td><div id="hscrollbarPlaceholder" style="height: 17px;"></div></td></tr>',
		'</table>');
		
		
//		'<table id="hms_main" style="overflow: hidden; height: 100%;">',
//			'<tr>',
//				'<td style="padding: 0;" rowspan="2">&nbsp;</td>',
//				'<td style="padding: 0; overflow: hidden; height: 3em;">',
//					renderDays(),
//				'</td>',
//				'<td style="padding: 0; width: 17px;" rowspan="2">&nbsp;</td>',
//			'</tr>',
//			'<tr><td style="height: 4em;">criteria</td></tr>',
//			'<tr>',
//				'<td>',
//					renderRooms(),
//				'</td>',
//				'<td style="" colspan="2" rowspan="2">',
//					renderPrices(),
//				'</td>',
//			'</tr>',
//			'<tr><td style="padding: 0; height: 17px;">&nbsp;</td></tr>',
//		'</table>');

		return html.join('');
	}
	
	function renderDays() {
		var html = ['<div id="days" style="overflow: hidden; width: 100%; height: 100%;"><div class="row">'];
		for (var i = 0; i < settings.days; i++) {
			var nd = settings.startDay.addDays(i);
			html.push('<div class="cell"><div><span style="white-space: nowrap; clear: both;">' + nd.format('mm-dd') + '</span></div><div><span>' + nd.format('ddd') + '</span></div></div>');
		}
		html.push('</div></div>');
		return html.join('');
	}
	
	function renderRooms() {
		var html = ['<div id="rooms" style="overflow: hidden; width: 100%; height: 100%;">']
		for (var i in settings.rooms) {
			html.push('<div>' + settings.rooms[i].name + '</div>');
		}
		html.push('</div>');
		return html.join('');
	}
	
	function renderPrices() {
		var html = ['<div id="prices" style="overflow: scroll; width: 100%; height: 100%;">'];
		for (var i in settings.rooms) {
			var room = settings.rooms[i];
			html.push('<div class="row">');
			for (var m in room.prices) {
				html.push('<div class="cell"><span style="white-space: nowrap;">￥ ' + room.prices[m] + '</span></div>');
			}
			html.push('</div>')
		}
		html.push('</div>');
		
		return html.join('');
	}
	
	function mock() {
		var rooms = []
		for (var i = 0; i < 8; i++) {
			var room = {
				id: i,
				name: 'ROOM_' + Math.round(Math.random() * 20000),
				events: [],
				prices: []
			};
			
			for (var m = 0; m < settings.days; m++) {
				room.prices.push(Math.round(Math.random() * 200));
				//room.prices.push(m);
			}
			
			rooms.push(room);
		}
		return rooms;
	}
	
	function onResize() {
	
		if (me === undefined) {
			return;
		}
		
		var scrollBarWidth = $('#prices').prop('offsetWidth') - $('#prices').prop('clientWidth');
		console.log('scrollBarWidth: ' + scrollBarWidth);
		
		$('#rooms').height(me.height() - $('#hms_main td:first').prop('offsetHeight') - scrollBarWidth);
		
		$('#days').width(me.width() - $('#hms_main td:first').prop('offsetWidth') - scrollBarWidth);
		$('#prices').width(me.width() - $('#hms_main td:first').prop('offsetWidth')).height(me.height() - $('#hms_main td:first').prop('offsetHeight'));

		var maxSpanWidth = Array.max($('#days .cell span, #prices .cell span').map(function() {
			return $(this).width();
		}).get());
		
		// try to apply the minimum cell width
		$('#prices .cell, #days .cell').width( maxSpanWidth );
		
		// get the max offsetwidth
		var maxOffsetWidth = 0, maxWidth = 0;
		$('#days .cell').each(function(i, item) {
			maxOffsetWidth = Math.max(maxOffsetWidth, $(item).prop('offsetWidth'));
			maxWidth = Math.max(maxWidth, $(item).width());
		});
			
		console.log('sumOffsetWidth: ' + maxOffsetWidth);
		
		if ($('#prices').width() - scrollBarWidth > maxOffsetWidth * settings.days) { // if there's extra space
			$('#prices .cell, #days .cell').width( ($('#prices').width() - scrollBarWidth) / settings.days - maxOffsetWidth + maxWidth );
			$('#prices div.row, #days div.row').width($('#prices').width() - scrollBarWidth);
			$('#days').width(me.width() - $('#hms_main td:first').prop('offsetWidth') - scrollBarWidth);
		} else {
			// just use the minimum cell width, and change row width
			$('#prices div.row, #days div.row').width( maxOffsetWidth * settings.days );
		}
		
	}
	
	var methods = {
		init : function( options ) {
			me = this;
			
			// Create some defaults, extending them with any options that were provided
			settings = $.extend( settings, options );
			
			settings.rooms = mock();			
			
			this.html( render() );
			
			$(window).resize(onResize);
			
			$('#prices').scroll(function(e) {
				$('#days').scrollLeft($(this).scrollLeft());
				$('#rooms').scrollTop($(this).scrollTop());
			});
			
			onResize();
			return this;
		}	
	};

	$.fn.tooltip = function( method ) {
		if ( methods[method] ) {
			return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			$.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
		}
		
	};

})( jQuery );