import '../scss/styles.scss';
import '../scss/mycss.scss';
import 'bootstrap-icons/font/bootstrap-icons.css';
import * as noUiSlider from 'nouislider';

import 'nouislider/dist/nouislider.css';

var slider = document.getElementById('slider');
if (slider) {
    noUiSlider.create(slider, {
        start: [0, 1000],
        connect: true,
        range: {
            'min': 0,
            'max': 1000
        }
    });
}
// Import all of Bootstrap's JS
// import * as bootstrap from 'bootstrap'
