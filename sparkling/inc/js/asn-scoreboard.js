jQuery(document).ready(function() {
	jQuery.ajax({
  		//url: 'http://americansports.wpengine.com//wp-content/themes/sparkling/stats/stats-test-scores.xml',
  		//url: 'http://localhost:8888/wp-content/themes/sparkling/stats/stats-test-scores.xml',
    	//url: 'http://api.stats.com/v1/stats/basketball/cbk/box/?linescore=true&box=true&date=2015-02-18&top25PollId=1&accept=xml&api_key=6mayz5bd3hm3saredxnrafhk&sig=826341cbf3ac9e6261efac3dca5235499f273d9aeb3c2f5dfeced974c494439d',
    	type: 'GET',
    	crossDomain: true,
    	dataType: 'xml',
    	error: function (xhr, status, error) {
        	try {
            	//console.log('Error! The STATS XML File could not be processed correctly');
        	}
        	catch (e) {
            	//console.log(xhr.statusText);
        	}
        	return true;
    	},
    	success: parseXml
  	});
  	
  	
  	// Scroll Buttons
  	var scrolled=0;
  	var scrollDiv = "#jsonp-results";
  	var scrollDistance = 90;
	
	jQuery("#downClick").on("click" ,function(event){
		
		var xyz = jQuery(".result-list li").length;
		//var xyz = jQuery(".result-list li").index() == 9;
		console.log(xyz); 
		event.stopPropagation();
		scrolled = scrolled + scrollDistance;
		
		jQuery(scrollDiv).stop().animate({ scrollTop: scrolled });
	});
	jQuery("#upClick").on("click" ,function(event){
		event.stopPropagation();
		scrolled = scrolled - scrollDistance;

		jQuery(scrollDiv).stop().animate({ scrollTop: scrolled});
	});
	
});


function parseXml(xml){
	jQuery(xml).find('sport').each(function(){
			html = '';
  			
  			var displayName = jQuery(this).find('displayName').text();
			  	
			jQuery(this).find('event').each(function(){
			  	
		  		html += '<li class="result-row">';
		  		
		  		var resultDate = '';
		  		
		  		jQuery(this).find('startDate date:nth-child(1)').each(function(){
					var month = jQuery(this).find('month').text();
					var date = jQuery(this).find('date').text();
					var year = jQuery(this).find('year').text();
					resultDate = month + '/' + date + '/' + year;		
				});
				
				html += '<div class="event-wrapper">';
				
				var eventId = jQuery(this).find('eventId').text();
				
				//html += '<div class="display-name event-id"><span class="resultDate">Event: ' + eventId + ' - ' + '</span><span class="resultDate">' + resultDate + '</span><span class="resultDate">' + displayName +'</span></div>';
				html += '<div class="event-label"><span class="result-date">' + resultDate + '</span><span class="display-name">' + displayName +'</span></div>';
					
				jQuery(this).find('eventStatus').each(function(){
					var eventStatusName = jQuery(this).find('name').text();
					//html += '<div class="event-status"><span class="final">Event-Status: ' + eventStatusName +'</span></div>';		
					html += '<div class="event-status"><span class="final">' + eventStatusName +'</span></div>';
				});

				html += '</div>';	
					
				jQuery(this).find('team').each(function(){
					var teamId = jQuery(this).find('teamId').text();
					var location = jQuery(this).find('location').text();
					var nickname = jQuery(this).find('nickname').text();
					var finalScore = jQuery(this).children('team score').text();
					var isWinner = "";
					
					html += '<div class="team-wrapper">';

					jQuery(this).find('isWinner').each(function(){
						
						isWinner = jQuery(this).text();
						if (isWinner=='true') {
							//html += '<div class="team"><span class="winner">Team: ' + teamId + ' - ' + location + ' ' + nickname + '</span>'+'</div>';
							html += '<div class="team"><span class="winner">' + location + ' ' + nickname + '</span>'+'</div>';
						} else if (isWinner=='false') {
							//html += '<div class="team"><span class="looser">Team: ' + teamId + ' - ' + location + ' ' + nickname + '</span>'+'</div>';
							html += '<div class="team"><span class="looser">' + location + ' ' + nickname + '</span>'+'</div>';
						} else {
							//html += '<div class="team">Team: ' + teamId + ' - ' + location + ' ' + nickname + '</div>';
							html += '<div class="team">' + location + ' ' + nickname + '</div>';
						}
						
						if (isWinner=='true') {
							//html += '<div class="score"><span class="winner"> ' + finalScore + ' ' + isWinner + '</span>'+'</div>';
							html += '<div class="score"><span class="winner"> ' + finalScore + '</span>'+'</div>';
						} else if (isWinner=='false') {
							//html += '<div class="score"><span class="looser"> ' + finalScore + ' ' + isWinner + '</span>'+'</div>';
							html += '<div class="score"><span class="looser"> ' + finalScore + '</span>'+'</div>';
						} else {
							//html += '<div class="score"><span class="active-game"> ' + finalScore + ' ' + isWinner + '</span>'+'</div>';
							html += '<div class="score"><span class="active-game"> ' + finalScore + '</span>'+'</div>';
						}
					
					});
					
					html += '</div>';		
				});
			});
		jQuery('#jsonp-results ul').append( jQuery(html));
  	});
}
