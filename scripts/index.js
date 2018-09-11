$(document).ready(function() {
    $(".navbar-burger").click(function() {
        $(".navbar-burger").toggleClass("is-active");
        $(".navbar-menu").toggleClass("is-active");

    });

    $("#botao-aluno").click(function() {
        $("#modal-aluno").toggleClass("is-active");
    });
    $("#close-modal-aluno").click(function() {
        $("#modal-aluno").removeClass("is-active");
    });

    $("#botao-professor").click(function() {
        $("#modal-professor").toggleClass("is-active");
    });
    $("#close-modal-professor").click(function() {
        $("#modal-professor").removeClass("is-active");
    });
});