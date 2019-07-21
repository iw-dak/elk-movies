/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
$("[data-toggle=popover]").popover({ trigger: "hover", delay: { "show": 500, "hide": 100 }, html: true }).addClass('my-super-popover');
require('./movies.js');
