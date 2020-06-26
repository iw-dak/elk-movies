/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

let nav = document.getElementsByClassName('navbar-item');

document.getElementsByClassName('navbar-item').onclick = function (e) {
  console.log(e);
  alert('dfvdfb');
}
