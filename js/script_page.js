$(document).ready(function() {
	var btnPesq =  $("#pesquisar");
	var textpesq = $("#textpesquisado");
  var urlDocRequest = "php/excutejar.php";
  var tabela = "";
  var urlDoc  = 'Tabela_Principal/Update_Tabel.php';
    tabela = $("#example").DataTable({
        "processing": true,
        "ajax": urlDoc,
        "language": {
        "emptyTable": "Sem Consulta "
        },
          "columnDefs": [ 
          { "visible": false, "targets": 0 },
          {
                    "targets": -1,
                    "data": null,
                    "defaultContent": '<button type="button" name="btn-view" title="Visualiza Arquivo" class="btn btn-secondary">'+
                    '<i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red"></i></button>'
                }
                ]
      });
  



	btnPesq.on('click',function(){
     	if (this.hash !== "") {
          event.preventDefault();
          // Store hash
          var hash = this.hash;
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 1000, function(){
            window.location.hash = hash;
            $.post(urlDocRequest,{wrdConsult:textpesq.val().trim()},function(result){
              alert(result)
              if (result == "true") {
                  tabela.ajax.url(urlDoc).load();
              }
            })
          });
     	} 
    })

	var input = document.getElementById("textpesquisado");
  input.addEventListener("keyup", function(event) {
	  	if (event.keyCode === 13) {
	   		event.preventDefault();
        var hash = "abresult";
	   		if (hash !== "") {
          		event.preventDefault();
            	window.location.hash = "abresult";
            	// alert(textpesq.val())
				      $.post(urlDocRequest,{wrdConsult:textpesq.val().trim()},function(result){
                if (result == "true") {
                  tabela.ajax.url(urlDoc).load();
                }
            })
     		} 
	  	}
	});

  $('#example tbody').on('click', 'tr button', function () {
        var element = $(this).parent().prev()
        var data = tabela.row(element).data();
        window.open(data[5]);
        // alert( 'You clicked on '+data[0]+'\'s row' );
    } );

  // $( ".relevancia" ).on('change', function() {
  //     alert("aaaaaaaaaaaaaaaaaaa");
  //     $('#form-button').fadeIn(3000);
  // })
})


  function seeButton() {
      $('#form-button').fadeIn(3000);
  }