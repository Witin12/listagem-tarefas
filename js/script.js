
$(document).ready(function () {
    $("#colaboradorAutoComplete").autocomplete({
        source: "buscarColaboradores.php",
        minLength: 2,
        select: function (event, ui) {
            $("#colaboradorAutoComplete").val(ui.item.label);
            $("#colaboradorId").val(ui.item.value);
            return false;
        }
    });
});

