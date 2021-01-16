$(document).ready(function () {

    // Access Terms
    var input_check = $("#access_terms")
    var btn_access = $('#btn-access')

    input_check.on('click', function () {
        if ($("#access_terms").is(":checked") == true) {
            btn_access.prop("disabled", false);
            btn_access.html('Participar do experimento');
        }

        else {
            $('#btn-access').prop("disabled", true);
            btn_access.html('Aceite os termos para continuar');
        }
    })



    // Close Modal
    var modal = $(".my-modal");
    var cont_modal = 0;

    $('html, body').animate({ scrollTop: 0 });

    // Fecha tudo
    $(".close_portarias").on('click', function () {
        $("thead").animate({ "opacity": "1" });
        $("td:nth-child(5)").animate({ "opacity": "1" });
        $("td:nth-child(4)").animate({ "opacity": "1" });
        $("#form-button").animate({ "opacity": "1" });
        $("td").animate({ "opacity": "1" });
        $("html").sleep(1000).css({ "overflow": "scroll" });
    });


    $(".fa-times").on('click', function () {
        $(".modal-popup").hide(500);
        return false;
    });

    // Fechar um por vez
    modal.on('click', function () {
        $(this).hide(500);
        $(this).prev().fadeIn(500);


        if ($('.modal-items').css('display') != 'none') {
            $("thead").animate({ "opacity": "1" });
        }

        if ($('.modal-pdf').css('display') != 'none') {
            $("td:nth-child(5)").animate({ "opacity": "1" });
        }

        if ($('.modal-relevancia').css('display') != 'none') {
            $("td:nth-child(4)").animate({ "opacity": "1" });
        }

        if ($('.modal-button').css('display') != 'none') {
            $('html, body').animate({ scrollTop: 2000 }, 1500);
            $("#form-button").animate({ "opacity": "1" });
        }

        cont_modal++;
        if (modal.length == cont_modal) {
            $('html, body').animate({ scrollTop: 0 }, 1000);

            $("td").animate({ "opacity": "1" });
            $("html").sleep(2000).css({ "overflow": "scroll" });
        }

    })



    // Search
    var btnPesq = $("#pesquisar");
    var textpesq = $("#textpesquisado");
    var urlDocRequest = "php/excutejar.php";
    var tabela = "";
    var urlDoc = 'Tabela_Principal/Update_Tabel.php';
    tabela = $("#example").DataTable({
        "dom": 'Pfrtip',
        "searchPanes": {
            "controls": false
        },
        "lengthMenu": [[10], [10]],
        "processing": true,
        "ajax": urlDoc,
        "paging": false,
        "info": false,

        "language": {
            "emptyTable": "Sem Consulta "
        },
        "columnDefs": [
            { "visible": false, "targets": 0 },
            {
                "targets": -1,
                "data": null,
                "defaultContent": '<button type="button" name="btn-view" title="Visualiza Arquivo" class="btn btn-secondary">' +
                    '<i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red"></i></button>'
            }
        ]
    });



    // Buscas
     $(document).keypress(function(e) {
        if(e.which == 13) btnPesq.click();
    });
     

    btnPesq.on('click', function () {
        $(".ababusca").css("opacity", "0.2");
        $("header").css("opacity", "0.2");
        $(".modal-popup ").hide(500);
        $(".loader").fadeIn(500);

        if (this.hash !== "") {
            event.preventDefault();
            // Store hash
            var hash = this.hash;

            $('html, body').animate({
                // scrollTop: $(hash).offset().top
            }, 1000, function () {
                window.location.hash = hash;

                $.post(urlDocRequest, { wrdConsult: textpesq.val().trim() }, function (result) {
                    // alert(result)
                    $("form#formulario-busca").submit();
                })
            });
        }
    })


    // Pegar links da tabela
    $('#example tbody').on('click', 'tr button', function () {
        var element = $(this).parent().prev()
        var data = tabela.row(element).data();
        window.open(data[5]);
        // alert( 'You clicked on '+data[0]+'\'s row' );
    });


    // Enviar formulário das portarias
    $("#formulario").submit(function (e) {
        var score = []
        var urls = []
        var relevantes = []
        e.preventDefault()

        var NumberElements = $(`tr button`).parent().prev()

        for (let i = 0; i < NumberElements.length && i <= 10; i++) {
            var element = $(`tr button:eq(${i})`).parent().prev()
            var data = tabela.row(element).data();
            relevancia = $(`#relevancia-${data[0]}`).val()

            relevantes.push(relevancia)
            urls.push(data[5])
            score.push(data[0])
        }

        console.log(score, urls, relevantes)
        console.log()

        $.ajax({
            url: "php/forms2.php",
            type: "POST",
            data: { score: score, urls: urls, relevantes: relevantes },
            dataType: "html"

        }).done(function (resposta) {
            // console.log(resposta);

        }).fail(function (jqXHR, textStatus) {
            console.log("Request failed: " + textStatus);

        }).always(function () {
            console.log("completou");
            window.location.replace("http://localhost/site/explicacao");

        });
    })

})