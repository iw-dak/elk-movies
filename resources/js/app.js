
require('./bootstrap');
$("[data-toggle=popover]").popover({ trigger: "hover", delay: { "show": 500, "hide": 100 }, html: true }).addClass('my-super-popover');
require('./movies.js');
