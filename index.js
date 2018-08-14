$(document).ready(function() {
    $(".navbar-burger").click(function() {
        $(".navbar-burger").toggleClass("is-active");
        $(".navbar-menu").toggleClass("is-active");

    });
    $("#botao-aluno").click(function() {
        $(".modal").toggleClass("is-active");
    });
    $(".modal-close").click(function() {
        $(".modal").removeClass("is-active");
    });
});