/*   
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 1.7.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin-v1.7/admin/
*/

var handleCalendarDemo = function () {
	"use strict";
	var buttonSetting = {left: 'today prev,next ', center: 'title', right: 'month,agendaWeek,agendaDay'};
	var date = new Date();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	var calendar = $('#calendar').fullCalendar({
		header: buttonSetting,
		selectable: true,
		selectHelper: true,
		droppable: true,
		drop: function(date, allDay) { // this function is called when something is dropped
		
			// retrieve the dropped element's stored Event Object
			var originalEventObject = $(this).data('eventObject');
			
			// we need to copy it, so that multiple events don't have a reference to the same object
			var copiedEventObject = $.extend({}, originalEventObject);
			
			// assign it the date that was reported
			copiedEventObject.start = date;
			copiedEventObject.allDay = allDay;
			
			// render the event on the calendar
			// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
			$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			
			// is the "remove after drop" checkbox checked?
			if ($('#drop-remove').is(':checked')) {
				// if so, remove the element from the "Draggable Events" list
				$(this).remove();
			}
			
		},
		select: function(start, end, allDay) {
			var title = prompt('Event Title:');
			if (title) {
				calendar.fullCalendar('renderEvent',
					{
						title: title,
						start: start,
						end: end,
						allDay: allDay
					},
					true // make the event "stick"
				);
			}
			calendar.fullCalendar('unselect');
		},
		eventRender: function(event, element, calEvent) {
				var mediaObject = (event.media) ? event.media : '';
				var description = (event.description) ? event.description : '';
            element.find(".fc-event-title").after($("<span class=\"fc-event-icons\"></span>").html(mediaObject));
            element.find(".fc-event-title").append('<small>'+ description +'</small>');
        },
		editable: true,
		events: [
		
			{
				title: 'Articulación Institucional',
				start: new Date(y,5 , 11,),
				end: new Date(y, 5 , 11),
				allDay: false,
				className: 'bg-blue',
				media: '<i class="fa fa-users"></i>',
				description: '- MAG <br> -MIPRO <br>, -DGAC.'
			},
			{
				title: 'Articulación Institucional',
				start: new Date(y,5 , 12,),
				end: new Date(y, 5 , 13),
				allDay: false,
				className: 'bg-blue',
				media: '<i class="fa fa-users"></i>',
				description: '- MTOP <br> -SRI <br>, -MDT.'
			},
			{
				title: 'Articulación Institucional',
				start: new Date(y,5 , 13,),
				end: new Date(y, 5 , 13),
				allDay: false,
				className: 'bg-blue',
				media: '<i class="fa fa-users"></i>',
				description: '- PROECUADOR <br> -MEER <br>, -SENAE.'
			},
			{
				title: 'Articulación Institucional',
				start: new Date(y,5 , 14,),
				end: new Date(y, 5 , 14),
				allDay: false,
				className: 'bg-blue',
				media: '<i class="fa fa-users"></i>',
				description: '- INEN <br> -MINTUR <br>, -MAP.'
			},
			{
				title: 'Articulación Institucional',
				start: new Date(y,5 , 15,),
				end: new Date(y, 5 , 15),
				allDay: false,
				className: 'bg-blue',
				media: '<i class="fa fa-users"></i>',
				description: '- BANECUADOR <br> -AGROCALIDAD <br>, -SERCOP.'
			},

			{
				title: 'Articulación Institucional',
				start: new Date(y,5 , 18,),
				end: new Date(y, 5 , 18),
				allDay: false,
				className: 'bg-blue',
				media: '<i class="fa fa-users"></i>',
				description: '- MIENTE <br> -INMOBILIAR <br>, -ARCSA.'
			},
			{
				title: 'Articulación Institucional',
				start: new Date(y,5 , 19,),
				end: new Date(y, 5 , 19),
				allDay: false,
				className: 'bg-blue',
				media: '<i class="fa fa-users"></i>',
				description: '- IEPS <br> -MEF <br>, -CFN.'
			},
			{
				title: 'Articulación Institucional',
				start: new Date(y,5 , 20,),
				end: new Date(y, 5 , 20),
				allDay: false,
				className: 'bg-blue',
				media: '<i class="fa fa-users"></i>',
				description: '- MCEI'
			},
			

			
		]
	});
	
	/* initialize the external events
	-----------------------------------------------------------------*/
	$('#external-events .external-event').each(function() {
		var eventObject = {
			title: $.trim($(this).attr('data-title')),
			className: $(this).attr('data-bg'),
			media: $(this).attr('data-media'),
			description: $(this).attr('data-desc')
		};
		
		$(this).data('eventObject', eventObject);
		
		$(this).draggable({
			zIndex: 999,
			revert: true,
			revertDuration: 0
		});
	});
};


var Calendar = function () {
	"use strict";
    return {
        //main function
        init: function () {
            handleCalendarDemo();
        }
    };
}();