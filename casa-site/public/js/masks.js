$(document).ready(function() {
		$(".cpf").inputmask("999.999.999-99");
    $(".cnpj").inputmask("99.999.999/9999-99", {reverse: true});
    $(".telefone").inputmask("(99) 99999-9999");
    $(".cep").inputmask("99999-999");
    $(".dinheiro").maskMoney({
        prefix: "",
        decimal: ",",
        thousands: "."
    });
});
