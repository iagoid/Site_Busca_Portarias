$(document).ready(function () {

    // Close Modal
    $(".fa-times").on('click', function () {
        $(".my-modal").hide(500);
        $(".modal-erro").hide(500);
        return false;
    });


    // Help Modal
    $(".btn-help").on('click', function () {
        $(".modal-help").fadeIn(500);
    })

    // Fechar um por vez
    $(".my-modal").on('click', function () {
        $(this).hide(500);
        $(this).prev().fadeIn(500);
    })

    // Modal error
    $(".modal-erro").on('click', function () {
        $(".modal-erro").hide(500);
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
        "lengthMenu": [
            [10],
            [10]
        ],
        "processing": true,
        "ajax": urlDoc,
        "paging": false,
        "info": false,

        "language": {
            "emptyTable": "Nenhum Resultado se encaixa com a consulta",
            "search": "Filtrar:",
        },
        "columnDefs": [{
                "visible": false,
                "targets": 0
            },
            {
                "targets": -1,
                "data": null,
                "defaultContent": '<button type="button" name="btn-view" title="Visualiza Arquivo" class="btn btn-secondary btn-pdf">' +
                    '<i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red"></i></button>'
            }
        ]
    });



    // Buscas
    $(document).keypress(function (e) {
        if (e.which == 13) btnPesq.click();
    });


    btnPesq.on('click', function () {

        var pesquisa = $("#textpesquisado").val();

        if (pesquisa == "") {
            $(".modal-erro").fadeIn(500);
        } else {
            $(".ababusca").css("opacity", "0.2");
            $("header").css("opacity", "0.2");
            $(".my-modal").css("opacity", "0.2").hide(800);
            $(".modal-erro").css("opacity", "0.2").hide(800);
            $(".loader").fadeIn(1000);

            event.preventDefault();
            $.post(urlDocRequest, {
                wrdConsult: textpesq.val().trim()
            }, function (result) {
                $("form#formulario-busca").submit();
            })
        }
    })



    // Enviar formulario visualizados
    $('#example tbody').on('click', 'tr button', function (e) {
        e.preventDefault()

        var element = $(this).parent().prev()
        var data = tabela.row(element).data();
        window.open(data[5]);

        var score = data[0];
        var url = data[5];

        $.ajax({
            url: "php/save_form.php",
            type: "POST",
            data: {
                score: score,
                url: url
            },
            dataType: "html"

        }).done(function (resposta) {
            console.log(resposta);

        }).fail(function (jqXHR, textStatus) {
            console.log("Request failed: " + textStatus);

        }).always(function () {
            alert("got response as " + responsedata);


        });
    });

})