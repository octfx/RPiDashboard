jQuery(document).ready(function() {
    if (jQuery('body').hasClass('start')){
        getToDos('list');
        getBuyList('list');
        setInterval( function() {
            getToDos('list');
            getBuyList('list');
        }, 600000);

        displaydate();

        setInterval( function() {
            clock();
        },1000);

        weather();
        setInterval( function() {
            checkUpdate();
            weather();
        }, 60000);

        givemelulz(0);
        setInterval( function() {
            givemelulz(jQuery('.neungag_container').attr('data-9gag'));
        }, 9000);

        weatherForecast();
        setInterval( function() {
            weatherForecast();
        }, 1800000);


    }

});

function checkUpdate(){
    jQuery.ajax({
        url:'/update',
        type:'HEAD',
        error: function(){},
        success: function() {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/admin/ajax/updated.ajax.php',
                success: function(e) {
                    if (e.code == 200){
                        location.reload();
                    }
                }
            });
        }
    });
}

function displaydate(){
    var monthNames = [ "Januar", "Februar", "März", "April", "Mai", "Juni", "July", "August", "September", "Oktober", "November", "Dezember" ];
    var dayNames= ["Sonntag","Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag"]
    var newDate = new Date();

    newDate.setDate(newDate.getDate());
    jQuery('#date').html('<span class="day">' + dayNames[newDate.getDay()] + '</span><span class="comma">, </span><span class="day_number">' + newDate.getDate() + '</span><span class="point">.</span><span class="month">' + monthNames[newDate.getMonth()] + '</span> <span class="year">' + newDate.getFullYear() + '</span>');
}

function clock(){
    var date = new Date();
    var seconds = date.getSeconds();
    jQuery("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
    var minutes = date.getMinutes();
    jQuery("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
    var hours = date.getHours();
    if (hours >= 21 || (hours >= 0 && hours < 7)){
        changeStyle('dark');
    }else{
        changeStyle('light');
    }
    if (hours == 0){
        displaydate();
    }
    jQuery("#hours").html(( hours < 10 ? "0" : "" ) + hours);
}

function weatherForecast(){
    jQuery('.weather-temperature').openWeatherForecast({
        lang: 'de',
        city: 'Braunschweig, de',
        units: 'c',
        descriptionTarget: '.weather-description',
        defTemperatureTarget: '.weather-temperature',
        minTemperatureTarget: '.weather-min-temperature',
        maxTemperatureTarget: '.weather-max-temperature',
        iconTarget: '.weather-icon',
        dateTarget: '.weather-date',
        customIcons: '/img/icons/weather/',
        key: 'b37feae0a0013f614c692b5a000c091e'
    });
}

function weather(){
    jQuery('.weather-temperature').openWeather({
        lang: 'de',
        city: 'Braunschweig, de',
        placeTarget: '.weather-place',
        units: 'c',
        descriptionTarget: '.weather-description',
        minTemperatureTarget: '.weather-min-temperature',
        maxTemperatureTarget: '.weather-max-temperature',
        windSpeedTarget: '.weather-wind-speed',
        humidityTarget: '.weather-humidity',
        sunriseTarget: '.weather-sunrise',
        sunsetTarget: '.weather-sunset',
        iconTarget: '.weather-icon',
        customIcons: '/img/icons/weather/',
        key: 'b37feae0a0013f614c692b5a000c091e',
        success: function() {
            jQuery('.weather').show();
        },
        error: function(message) {
            console.log(message);
        }
    });
}

function changeStyle(style){
    if (style == 'dark'){
        if (!jQuery('body').hasClass('dark')){
            jQuery('body').removeClass('light').addClass('dark');
            jQuery('#basecss').attr('href', '/css/bootstrap_dark.min.css');
        }
    }else{
        if (!jQuery('body').hasClass('light')){
            jQuery('body').removeClass('dark').addClass('light');
            jQuery('#basecss').attr('href', '/css/bootstrap.min.css');
        }
    }
}

function getToDos(type){
    if (type != 'table'){
        type = 'list'
    }else{
        type = 'table'
    }

    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        data: {
            type: type
        },
        url: '/admin/ajax/getTodo.ajax.php',
        success: function(e) {
            if (e.code == 0){
                jQuery('#todo div').empty().html(e.data);
            }else{
                alert('Error. Code: ' + e.code);
            }
        }
    })
}

function getBuyList(type){
    if (type != 'table'){
        type = 'list'
    }else{
        type = 'table'
    }

    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        data: {
            type: type
        },
        url: '/admin/ajax/getBuyList.ajax.php',
        success: function(e) {
            if (e.code == 0){
                jQuery('#buy div').empty().html(e.data);
            }else{
                alert('Error. Code: ' + e.code);
            }
        }
    })
}

function givemelulz(id){
    jQuery.ajax({
        type: 'GET',
        url: 'http://infinigag.eu01.aws.af.cm/trending/'+id,
        dataType: 'json',
        success: function(data) {
            for (var i = 0; i < 3; i++) {
                jQuery('.neungag'+i+' div').empty().html('<h6>' + data.data[i].caption + '</h6><img src="' + data.data[i].images['normal'] + '" class="img-responsive" alt="" />');
                jQuery('.neungag_container').attr('data-9gag',data.data[i].id);
            }
        }
    });
}
