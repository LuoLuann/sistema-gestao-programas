
import './bootstrap';

import $ from 'jquery';
import 'jquery-mask-plugin';

import './jQuery-mask';

import 'jquery-ui/ui/widgets/autocomplete';
import 'jquery-ui-dist/jquery-ui';


import Alpine from 'alpinejs';

window.$ = window.jQuery = $;
window.$ = window.jQuery = require('jquery');
require('./bootstrap');

window.Alpine = Alpine;

Alpine.start();
