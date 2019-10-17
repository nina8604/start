window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

let isOpen = false;
let $dropDownToggle = $('.nav-link.dropdown-toggle');
let $dropDownMenu = $('.dropdown-menu');
$dropDownToggle.on('click', function () {
    $dropDownMenu.css('display', (isOpen ? 'none' : 'block'));
    isOpen = !isOpen;
});

function preloadPicture(evt, containerId){
    let file = evt.target.files;
    let pictureFile = file[0];
    let reader = new FileReader();
    // Closure to capture the file information.
    reader.onload = (function(theFile) {
        return function(e) {
            $('#' + containerId).find('img').remove();
            $('#' + containerId).html(['<img class="thumb" src="', e.target.result,
                '" title="', escape(theFile.name), '" />'].join(''));
        };
    })(pictureFile);
    // Read in the image file as a data URL.
    reader.readAsDataURL(pictureFile);
}
