jQuery(function ($) {

    this.initComponent = function() {
        var self = this;

        $("#datepicker").datepicker({
            nextText : " ",
            prevText : " "
        });

        $('#dateButton').toggle(
            function() {
                var $ui = $("#ui-datepicker-div");
                if ($ui.is(":visible") && $ui.html() != "") {
                    $('#datepicker').datepicker("hide");
                } else {
                    $('#datepicker').datepicker("show");
                }
            },
            function() {
                var $ui = $("#ui-datepicker-div");
                if ($ui.is(":visible") && $ui.html() != "") {
                    $('#datepicker').datepicker("hide");
                } else {
                    $('#datepicker').datepicker("show");
                }
            }
        );

        $('#game-search').click(function(event) {
            self.searchGames();

            event.stopPropagation();
        });

        this.loadDropDowns();
    };

    this.initSportsDropdown = function(data) {
        $('#allsports')
            .empty()
            .append('<li><a href="#">All Sports</a></li>');
        $.each(data, function(i, item) {
            $('#allsports').append('<li><a href="#" data-uuid="' + item.uuid + '">' + item.name + ' (' + (item.gender == 'MALE' ? 'M' : 'W') + ')</a></li>');
        });

        $('#allsports-selected').attr('data-toggle', 'dropdown');
        $('#allsports a').click(function(event) {
            var $selectedItem = $(event.target);
            var uuid = $selectedItem.attr('data-uuid');
            uuid = uuid ? uuid : null;

            $('#allsports-selected')
                .attr('data-uuid', uuid)
                .text($selectedItem.text())
                .append('<span class="caret"></span>');
            $selectedItem.closest('li.dropdown').removeClass('open');

            event.stopPropagation();
        });
    };

    this.initConferencesDropdown = function(data) {
        var self = this;

        $('#allconferences')
            .empty()
            .append('<li><a href="#">All Conferences</a></li>');
        $.each(data, function(i, item) {
            $('#allconferences').append('<li><a href="#" data-uuid="' + item.uuid + '">' + item.name + '</a></li>');
        });

        $('#allconferences-selected').attr('data-toggle', 'dropdown');
        $('#allconferences li a').click(function(event) {
            var $selectedItem = $(event.target);
            var uuid = $selectedItem.attr('data-uuid');
            uuid = uuid ? uuid : null;

            $('#allconferences-selected')
                .attr('data-uuid', uuid)
                .text($selectedItem.text())
                .append('<span class="caret"></span>');
            $selectedItem.closest('li.dropdown').removeClass('open');

            self.initTeamsDropdown(uuid);
            event.stopPropagation();
        });
    };

    this.initTeamsDropdown = function(conferenceUuid) {
        $('#allteams').empty();

        $('#allteams-selected')
            .attr('data-toggle', null)
            .attr('data-uuid', null)
            .text('All Teams')
            .append('<span class="caret"></span>');
        if (conferenceUuid != null) {
            $.ajax({
                //url: '/wp-json/team/conference/' + conferenceUuid,
                dataType: 'json',
                success: function(response, status, xhr) {
                    $('#allteams')
                        .empty()
                        .append('<li><a href="#">All Teams</a></li>');
                    $.each(response.data, function(i, item) {
                        $('#allteams').append('<li><a href="#" data-uuid="' + item.uuid + '">' + item.name + '</a></li>');
                    });

                    $('#allteams-selected').attr('data-toggle', 'dropdown');
                    $('#allteams li a').click(function(event) {
                        var $selectedItem = $(event.target);
                        var uuid = $selectedItem.attr('data-uuid');
                        uuid = uuid ? uuid : null;

                        $('#allteams-selected')
                            .attr('data-uuid', uuid)
                            .text($selectedItem.text())
                            .append('<span class="caret"></span>');
                        $selectedItem.closest('li.dropdown').removeClass('open');

                        event.stopPropagation();
                    });
                },
                failure: function() {
                    console.log("Couldn't load Sport's data");
                }
            });
        }
    };

    this.loadDropDowns = function() {
        var self = this;

        // Load All Sports
        $.ajax({
            //url: '/wp-json/sport',
            dataType: 'json',
            success: function(response, status, xhr) {
                self.initSportsDropdown(response.data);
            },
            failure: function() {
                console.log("Couldn't load Sport's data");
            }
        });

        // Load All Conferences
        $.ajax({
            //url: '/wp-json/conference',
            dataType: 'json',
            success: function(response, status, xhr) {
                self.initConferencesDropdown(response.data);
            },
            failure: function() {
                console.log("Couldn't load Conference's data");
            }
        });

    };

    this.searchGames = function() {
        var self = this,
            sportUuid = $('#allsports-selected').attr('data-uuid'),
            conferenceUuid = $('#allconferences-selected').attr('data-uuid'),
            teamUuid = $('#allteams-selected').attr('data-uuid'),
            date = $('#datepicker').datepicker('getDate'),
            zip = $('#zip-code').val();

        var homeQueryParameters = [];
        var visitorQueryParameters = [];
        if (sportUuid && sportUuid.length == 36) {
            var sportQuery = {
                field: 'sport.uuid',
                operation: 'EQUALS',
                value: sportUuid
            };
            homeQueryParameters.push(sportQuery);
            visitorQueryParameters.push(sportQuery);
        }
        if (conferenceUuid && conferenceUuid.length == 36) {
            homeQueryParameters.push({
                field: 'home.conference.uuid',
                operation: 'EQUALS',
                value: conferenceUuid
            });
            visitorQueryParameters.push({
                field: 'visitor.conference.uuid',
                operation: 'EQUALS',
                value: conferenceUuid
            });
        }
        if (teamUuid && teamUuid.length == 36) {
            homeQueryParameters.push({
                field: 'home.uuid',
                operation: 'EQUALS',
                value: teamUuid
            });
            visitorQueryParameters.push({
                field: 'visitor.uuid',
                operation: 'EQUALS',
                value: teamUuid
            });
        }
        if (date != null) {
            homeQueryParameters.push({
                field: 'time',
                operation: 'LESSTHAN',
                value: this.addDays(this.dateTruncate(date), 1).getTime()
            });
            homeQueryParameters.push({
                field: 'time',
                operation: 'GREATERTHAN',
                value: this.dateTruncate(date).getTime()
            });
            visitorQueryParameters.push({
                field: 'time',
                operation: 'LESSTHAN',
                value: this.addDays(this.dateTruncate(date), 1).getTime()
            });
            visitorQueryParameters.push({
                field: 'time',
                operation: 'GREATERTHAN',
                value: this.dateTruncate(date).getTime()
            });
        }
        if (zip && zip.length == 5) {
            homeQueryParameters.push({
                field: 'home.zip',
                operation: 'EQUALS',
                value: zip
            });
            visitorQueryParameters.push({
                field: 'visitor.zip',
                operation: 'EQUALS',
                value: zip
            });
        }

        var queryParameters = [homeQueryParameters, visitorQueryParameters];

        // Search Games
        $.ajax({
            url: '/wp-json/game?queryParameters=' + JSON.stringify(queryParameters),
            dataType: 'json',
            success: function(response, status, xhr) {
                self.renderGames(response.data);
            },
            failure: function() {
                console.log("Couldn't load Conference's data");
            }
        });
    };

    this.renderGames = function(data) {
        var currentDatetime = new Date();
        currentDatetime = currentDatetime.getTime();

        $('#games').empty();

        $.each(data, function(i, item) {
            var timeOfDay = new Date();
            timeOfDay.setTime(item.timeOfDay);
            var formattedDate = dateFormat(timeOfDay, 'dddd - mmmm d, yyyy');
            var formattedTime = dateFormat(timeOfDay, 'h:MM TT Z');

            var sportName = (item.sport.gender == 'MALE' ? 'Men\'s' : 'Women\'s') + ' ' + item.sport.name;

            if (item.timeOfDay > currentDatetime) {
                $('#games').append(
                    '<div class="row group-date">' +
                    '    <div class="col-md-12">' +
                    '        <span class="date">' + formattedDate + '</span>' +
                    '    </div>' +
                    '</div>' +
                    '<div class="row item">' +
                    '    <div class="col-md-12 sport">' + sportName + '</div>' +
                    '    <div class="col-md-12 subitem">' +
                    '        <div class="row">' +
                    '            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"><span>' + item.home.name + '</span></div>' +
                    '            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 logo"><img src="http://cdn-png.si.com/sites/default/files/teams/basketball/cbk/logos/vcu_50.png"/></div>' +
                    '            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span class="time">' + formattedTime + '</span><!-- <span class="location">John Paul Jones Arena</span><span class="city">New York, New York</span> --></div>' +
                    '            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 logo"><img src="http://cdn-png.si.com/sites/default/files/teams/basketball/cbk/logos/duke_50.png"/></div>' +
                    '            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"><span>' + item.visitor.name + '</span></div>' +
                    '        </div>' +
                    '    </div>' +
                    '    <div class="col-xs-6 col-sm-6 col-md-6 tv">' + item.gameChannel.name + '</div>' +
                    '    <div class="col-xs-6 col-sm-6 col-md-6 upcoming"><!-- Upcoming Video --></div>' +
                    '</div>'
                );
            } else {
                $('#games').append(
                    '<div class="row group-date">' +
                    '    <div class="col-md-12">' +
                    '        <span class="date">' + formattedDate + '</span>' +
                    '    </div>' +
                    '</div>' +
                    '<div class="row item">' +
                    '    <div class="col-md-12 sport">' + sportName + '</div>' +
                    '    <div class="col-md-12 subitem">' +
                    '        <div class="row">' +
                    '            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"><span>' + item.home.name + '</span></div>' +
                    '            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 logo"><img src="http://cdn-png.si.com/sites/default/files/teams/basketball/cbk/logos/bc_50.png"/></div>' +
                    '            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span class="result">' + item.homeScore + ' - ' + item.visitorsScore + '</span></div>' +
                    '            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 logo"><img src="http://cdn-png.si.com/sites/default/files/teams/basketball/cbk/logos/nd_50.png"/></div>' +
                    '            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"><span>' + item.visitor.name + '</span></div>' +
                    '        </div>' +
                    '    </div>' +
                    '    <div class="col-xs-6 col-sm-6 col-md-6 tv">' + item.period + '</div>' +
                    '    <div class="col-xs-6 col-sm-6 col-md-6 upcoming">Watch Video</div>' +
                    '</div>'
                );
            }
        });
    };

    this.initComponent();

    this.dateTruncate = function(date) {
        return new Date(date.getFullYear(), date.getMonth(), date.getDate())
    };

    this.addDays = function(date, days) {
        var result = new Date(date);
        result.setDate(date.getDate() + days);
        return result;
    }

});