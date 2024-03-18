import "./bootstrap";

import jQuery from "jquery";
window.$ = jQuery;

$(function () {
    $("input.decimal").on("change", function () {
        $(this).val($(this).val().replace(",", "."));
    });
});
