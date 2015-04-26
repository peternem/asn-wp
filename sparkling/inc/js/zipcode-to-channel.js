function documentReady(fn) {
    if (document.readyState != 'loading') {
        fn();
    } else {
        document.addEventListener('DOMContentLoaded', fn);
    }
}

function zipCodeToChannel () {

    function zipCodeToChannelButtonOnClick(event) {
        //console.log("zipCodeToChannelButtonOnClick called with event: ", event);
        var zipcode = document.getElementById('zipcode-to-channel-input').value;
        //console.log("zipCodeToChannelButtonOnClick: zipcode: ", zipcode);
        var channel = zipCodeToChannelMap[zipcode];
        if (!channel) {
            showPanel('zipcode-to-channel-error');
        } else {
            var channelElement = document.getElementById('zipcode-to-channel-channel');
            channelElement.innerHTML = channel;
            showPanel('zipcode-to-channel-success');
        }
        event.preventDefault();
    }
    function showPanel(elementId) {
        var elements = document.getElementsByClassName('zipcode-to-channel-panel');

        for (var i = 0; i < elements.length; i++) {
            var element = elements[i];
            if (element.classList) {
                element.classList.add('hide');
            } else { 
                element.className += ' ' + 'hide';
            }
        }

        var element = document.getElementById(elementId)
        if (element.classList) {
            element.classList.remove('hide');
        } else {
            element.className = element.className.replace(new RegExp('(^|\\b)' + 'hide' + '(\\b|$)', 'gi'), ' ');
        }
    }

    documentReady( function () {
        var element = document.getElementById('zipcode-to-channel-button');
        element.addEventListener('click', zipCodeToChannelButtonOnClick);
    });

    var zipCodeToChannelMap = {
    }
} 
zipCodeToChannel();