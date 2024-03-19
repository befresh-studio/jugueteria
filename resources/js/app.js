import "./bootstrap";

import jQuery from "jquery";
window.$ = jQuery;

$(function () {
    $("input.decimal").on("change", function () {
        $(this).val(Number($(this).val().replace(",", ".")).toFixed(2));
    });
});
