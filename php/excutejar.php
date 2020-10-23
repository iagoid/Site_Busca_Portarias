<?php

$palavra = isset($_POST['wrdConsult']) ? $palavra = $_POST['wrdConsult'] : $palavra = '2018';

if ($palavra != null) {
	unset($arrayDados);
	$classificacao = 1;
	$arrayDados = array();
	$shell = exec('java -jar "C:\Users\Igor\Documents\NetBeansProjects\PROJETO_BUSCADOR-PORTARIAS-\Buscador_Portarias\dist\Buscador_Portarias.jar" -query "'.trim($palavra).'"' , $saida);
	$quantidade = count($saida);
	// var_dump($saida);
	
	for ($i=0; $i < $quantidade; $i++) {
		// var_dump($saida[$i]);
		
		$json = json_decode(mb_convert_encoding(utf8_encode($saida[$i]), "UTF-8", "auto"));
		// var_dump($json);
		// var_dump(utf8_encode($saida[1]));
		// echo"<br><br>";
		// exit();
		// die();
		$jsonCount = (is_array($json) ? count($json) : 0);
		if ($jsonCount > 0) {
			foreach ($json as $key => $value) {	
				$arrayDados[$key]['datePort'] = str_replace("\/", "-", $value->datePort) ;
				if ($value->numPort > 0) {
					$arrayDados[$key]['numPort'] = $value->numPort;
				}else{
					$arrayDados[$key]['numPort'] = 00000;
				}
				$arrayDados[$key]['nameDoc'] = $value->nameDoc;

				$arrayDados[$key]['DocRelevante'] = 
					"<select class='relevancia' name='relevancia-$classificacao' id='relevancia-$classificacao' onChange=seeButton()>
							<option value='nao_avaliado'></option>
							<option value='sim'>Sim</option>
							<option value='nao'>Não</option>
					</select>";
				$classificacao++;


				$conteudo = $value->conteudo;
				// $conteudo = str_replace(",  ,", "", $conteudo);
				// $conteudo = str_replace(",   ,", "", $conteudo);
				// $conteudo = str_replace(",    ,", "", $conteudo);
				// $posicao = strripos($conteudo, $palavra);
				// $conteudoSeparado =  substr($conteudo, $posicao, 500);
				$tamanho = strlen($conteudo);
				if ($tamanho > 500){
					$tamanho = 500;
				} 
				$conteudoSeparado =  substr($conteudo, 0, $tamanho-1);
				$arrayDados[$key]['conteudo'] = $conteudoSeparado;
				var_dump($arrayDados);
			}
		}
	}

	$stringarray = json_encode($arrayDados);
	// var_dump($stringarray);
	unlink("".__DIR__."/archives/arquivo.txt");
	$arquivo = fopen("".__DIR__."/archives/arquivo.txt", "w+");
	fwrite($arquivo, $stringarray);
	fclose($arquivo);

	echo "true";

}