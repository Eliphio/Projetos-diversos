<?php

class routines {
	// Listar estados brasileiros
	function listaEstados() {
		$estado['AC'] = 'ACRE';
		$estado['AL'] = 'ALAGOAS';
		$estado['AM'] = 'AMAZONAS';
		$estado['AP'] = 'AMAPA';
		$estado['BA'] = 'BAHIA';
		$estado['CE'] = 'CEARA';
		$estado['DF'] = 'DISTRITO FEDERAL';
		$estado['ES'] = 'ESPIRITO SANTO';
		$estado['GO'] = 'GOIAS';
		$estado['MA'] = 'MARANHAO';
		$estado['MG'] = 'MINAS GERAIS';
		$estado['MS'] = 'MATO GROSSO DO SUL';
		$estado['MT'] = 'MATO GROSSO';
		$estado['RJ'] = 'RIO DE JANEIRO';
		$estado['PR'] = 'PARANA';
		$estado['PR'] = 'PARAIBA';
		$estado['RS'] = 'RIO GRANDE DO SUL';
		$estado['RN'] = 'RIO GRANDE DO NORTE';
		$estado['PA'] = 'PARA';
		$estado['PE'] = 'PERNAMBUCO';
		$estado['PI'] = 'PIAUI';
		$estado['PB'] = 'PARAIBA';
		$estado['RD'] = 'RONDONIA';
		$estado['RR'] = 'RORAIMA';
		$estado['SC'] = 'SANTA CATARINA';
		$estado['SE'] = 'SERGIPE';
		$estado['SP'] = 'SAO PAULO';
		return $estado;
	}
	
	function dataDB($data)
	{
		$temp = explode ('/',$data);
		$dia = $temp[0];
		$mes = $temp[1];
		
		return $temp[2] . "-" . $mes . "-" .$dia; 
	}

	//===================================================================================
	// Formata a senha de acordo com a regra presente em banco de dados
	//===================================================================================
	function inverteSenha ($string)
	{
		$stringnova = '';
		for ($i = 0; $i < strlen($string); $i++)
		{
			$ascii_code = ord($string[$i]);
			$ascii_code += 10;
			$stringnova .= chr($ascii_code);
		}
		if (strlen($string)<10)
		{
			for ($i = 0; $i < (10-strlen($string)); $i++)
			{
				$stringnova .= "*";
			}
		}
		return $stringnova;
	}

	function desinverteSenha($string)
	{
		$stringnova = null;
		for ($i = 0; $i < strlen($string); $i++) { $ascii_code = ord($string[$i]); $ascii_code -= 10; $stringnova .= chr($ascii_code); }
		return $stringnova;
	}

	function dataForm($data)
	{
		$temp = explode ('-',$data);
		$dia = $temp[2];
		$mes = $temp[1];
			
		return $dia . "/" . $mes . "/" .$temp[0]; 
	}

//===================================================================================
// Função para transformar strings em Maiúscula ou Minúscula com acentos
//===================================================================================
// $palavra = a string propriamente dita
// $tp = tipo da conversão: 1 para maiúsculas e 0 para minúsculas
function MaiusculasMinusculas($term, $tp)
{
    if ($tp == "1") $palavra = strtr(strtoupper($term),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
    elseif ($tp == "0") $palavra = strtr(strtolower($term),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß","àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ");
    return $palavra;
}

function trataTag($texto)
{
	$trocarIsso = array('<br />',);
	$porIsso = array(' ',);
	$titletext = str_replace($trocarIsso, $porIsso, $texto);
	return $titletext;
}

function mudacaminho($texto)
{
	$trocarIsso = array('C:/xampp/htdocs/gestaoarquivo',);
	$porIsso = array('/',);
	$titletext = str_replace($trocarIsso, $porIsso, $texto);
	return $titletext;
}

//===================================================================================
// Compara duas datas no formato dd/mm/aaaa
//===================================================================================
function comparaDatas($data_um, $data_dois)
{
	/* As datas serão recebidas no formato dd/mm/aaaa, e comparadas
	* Caso a primeira delas seja maior, a funcao retorna 1
	* Caso a primeira delas seja menor, a funcao retorna -1
	* Caso as datas sejam iguais, a funcao retorna 0
	*/
	
	//$data_um = mktime(0,0,0, substr($data_um, 3, 2), substr($data_um, 0, 2),substr($data_um, 6, 4));
	//$data_dois = mktime(0,0,0, substr($data_dois, 3, 2), substr($data_dois, 0, 2),substr($data_dois, 6, 4));
	if ($data_um < $data_dois)
		return 1;
	else if ($data_um > $data_dois)
		return 2;
	else if ($data_um = $data_dois)
		return 0;
}

//===================================================================================
// Compara duas horas
//===================================================================================
function comparaHoras($hora_um, $hora_dois)
{
	/* As datas serão recebidas no formato dd/mm/aaaa, e comparadas
	* Caso a primeira delas seja maior, a funcao retorna 1
	* Caso a primeira delas seja menor, a funcao retorna -1
	* Caso as datas sejam iguais, a funcao retorna 0
	*/
	
	if ($hora_um < $hora_dois)
		return 1;
	else if ($hora_um > $hora_dois)
		return 2;
	else if ($hora_um = $hora_dois)
		return 0;
}

function calcDifDatas($data_um, $data_dois)
{
	 // Usa a função criada e pega o timestamp das duas datas:  
	$time_inicial = strtotime($data_um);  
	$time_final = strtotime($data_dois);  
	
	// Calcula a diferença de segundos entre as duas datas:  
	$diferenca = $time_final - $time_inicial;  
	// Calcula a diferença de dias  
	$dias = (int)floor( $diferenca / (60 * 60 * 24)); 
	return $dias;	
}
function SomarData($data, $dias, $meses, $ano)
{
  	//passe a data no formato dd/mm/yyyy
   	$data = explode("/", $data);
   	$newData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses,	$data[0] + $dias, $data[2] + $ano) );
   	return dataDB($newData);
}
function DiminuirData($data, $dias, $meses, $ano)
{
  	//passe a data no formato dd/mm/yyyy
   	$data = explode("/", $data);
   	$newData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses,	$data[0] - $dias, $data[2] + $ano) );
   	return dataDB($newData);
}

// funcao para eliminar os zeros 000000 do numero do desenho
function RetiraZeros($valor)
{
  	$v = (double)$valor;
	$novovalor = $v + 0;
   	return $novovalor;
}

//======================================================================================
// 									FUNCAO VALIDA CFP
//======================================================================================
//Calcula CPF

function CalculaGCG($CampoNumero)
{
	$valida = $CampoNumero;
	if (strlen($valida)<= 11)
	{	
		$RecebeCPF=$CampoNumero;
		//Retirar todos os caracteres que nao sejam 0-9
		$s='';
		for ($x=1; $x<=strlen($RecebeCPF); $x=$x+1)
		{
			$ch=substr($RecebeCPF,$x-1,1);
			if (ord($ch)>=48 && ord($ch)<=57)
			{
				$s=$s.$ch;
			}
		}
	
		$RecebeCPF=$s;
		if (strlen($RecebeCPF)!=11)
		{
			return 'obrigatório o CPF com 11 dígitos';
		}
		else
		if ($RecebeCPF=='00000000000')
		{
			$then;
			return 'CPF Inválido';
		}
		else
		{
			$Numero[1]=intval(substr($RecebeCPF,1-1,1));
			$Numero[2]=intval(substr($RecebeCPF,2-1,1));
			$Numero[3]=intval(substr($RecebeCPF,3-1,1));
			$Numero[4]=intval(substr($RecebeCPF,4-1,1));
			$Numero[5]=intval(substr($RecebeCPF,5-1,1));
			$Numero[6]=intval(substr($RecebeCPF,6-1,1));
			$Numero[7]=intval(substr($RecebeCPF,7-1,1));
			$Numero[8]=intval(substr($RecebeCPF,8-1,1));
			$Numero[9]=intval(substr($RecebeCPF,9-1,1));
			$Numero[10]=intval(substr($RecebeCPF,10-1,1));
			$Numero[11]=intval(substr($RecebeCPF,11-1,1));
			
			$soma=10*$Numero[1]+9*$Numero[2]+8*$Numero[3]+7*$Numero[4]+6*$Numero[5]+5*
			$Numero[6]+4*$Numero[7]+3*$Numero[8]+2*$Numero[9];
			$soma=$soma-(11*(intval($soma/11)));
			
			if ($soma==0 || $soma==1)
			{
				$resultado1=0;
			}
			else
			{
				$resultado1=11-$soma;
			}
			
			if ($resultado1==$Numero[10])
			{
				$soma=$Numero[1]*11+$Numero[2]*10+$Numero[3]*9+$Numero[4]*8+$Numero[5]*7+$Numero[6]*6+$Numero[7]*5+
				$Numero[8]*4+$Numero[9]*3+$Numero[10]*2;
				$soma=$soma-(11*(intval($soma/11)));
			
				if ($soma==0 || $soma==1)
				{
					$resultado2=0;
				}
				else
				{
					$resultado2=11-$soma;
				}
				if ($resultado2==$Numero[11])
				{
					return 'CPF Válido';
				}
				else
				{
					return 'CPF Inválido';
				}
			}
			else
			{
				return 'CPF Inválido';
			}
		}
	}// Fim do Calcula CPF
	else
	{
		// Inicio Calcula CNPJ
		$RecebeCNPJ=$s;
		if (strlen($RecebeCNPJ)!=14)
		{
			return 'É obrigatório o CNPJ com 14 dígitos';
		}
		else
		{
			if ($RecebeCNPJ==”00000000000000″)
			{
				$then;
				echo 'CNPJ Inválido';
			}
			else
			{
				$Numero[1]=intval(substr($RecebeCNPJ,1-1,1));
				$Numero[2]=intval(substr($RecebeCNPJ,2-1,1));
				$Numero[3]=intval(substr($RecebeCNPJ,3-1,1));
				$Numero[4]=intval(substr($RecebeCNPJ,4-1,1));
				$Numero[5]=intval(substr($RecebeCNPJ,5-1,1));
				$Numero[6]=intval(substr($RecebeCNPJ,6-1,1));
				$Numero[7]=intval(substr($RecebeCNPJ,7-1,1));
				$Numero[8]=intval(substr($RecebeCNPJ,8-1,1));
				$Numero[9]=intval(substr($RecebeCNPJ,9-1,1));
				$Numero[10]=intval(substr($RecebeCNPJ,10-1,1));
				$Numero[11]=intval(substr($RecebeCNPJ,11-1,1));
				$Numero[12]=intval(substr($RecebeCNPJ,12-1,1));
				$Numero[13]=intval(substr($RecebeCNPJ,13-1,1));
				$Numero[14]=intval(substr($RecebeCNPJ,14-1,1));
	
				$soma=$Numero[1]*5+$Numero[2]*4+$Numero[3]*3+$Numero[4]*2+$Numero[5]*9+$Numero[6]*8+$Numero[7]*7+
				$Numero[8]*6+$Numero[9]*5+$Numero[10]*4+$Numero[11]*3+$Numero[12]*2;
	
				$soma=$soma-(11*(intval($soma/11)));
				
				if ($soma==0 || $soma==1)
				{
					$resultado1=0;
				}
				else
				{
					$resultado1=11-$soma;
				}
				if ($resultado1==$Numero[13])
				{
					$soma=$Numero[1]*6+$Numero[2]*5+$Numero[3]*4+$Numero[4]*3+$Numero[5]*2+$Numero[6]*9+
					$Numero[7]*8+$Numero[8]*7+$Numero[9]*6+$Numero[10]*5+$Numero[11]*4+$Numero[12]*3+$Numero[13]*2;
					$soma=$soma-(11*(intval($soma/11)));
					if ($soma==0 || $soma==1)
					{
						$resultado2=0;
					}
					else
					{
						$resultado2=11-$soma;
					}
					if ($resultado2==$Numero[14])
					{
						echo 'CNPJ válido';
					}
					else
					{
						echo 'CNPJ inválido';
					}
				}
				else
				{
					echo 'CNPJ inválido';
				}
			}
		}
	}
}

//Fim do Calcula CNPJ

	







// Funcao para criar tabelas
function createTables() {
	global $db;
	$db_name = 'gym_development'; // Zend_Registry::get('dbName');
	$schema = $db->listTables();
	if (!in_array('users', $schema)) {
		// usuários
		$db->getConnection()->query(
			"CREATE TABLE IF NOT EXISTS `".$db_name."`.`users` (
			  `id` INT(10) NOT NULL AUTO_INCREMENT, 
			  `name` varchar(255) NOT NULL COMMENT 'Nome do funcionário',
			  `email` varchar(255) NOT NULL COMMENT 'Email do funcionario',
			  `password` varchar(255) NOT NULL COMMENT 'Senha do funcionário ',
			  `type` varchar(3) NOT NULL COMMENT 'tipo de funcionario',
			  `id_business` int(10) unsigned NOT NULL COMMENT 'empresa onde o funcionario trabalha',
			  `created_at` date COMMENT 'Data de criação do cadastro',
			  `updated_at` date COMMENT 'Data de atualização do cadastro',
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;"
		);
	}
	if (!in_array('TB_CLIENTES', $schema)) {
		// Cliente/Fornecedor/Outros
		$db->getConnection()->query(
			"
			CREATE TABLE IF NOT EXISTS `".$db_name."`.`TB_CLIENTES` (
			 `ID_CLI` int(10) unsigned NOT NULL AUTO_INCREMENT,			 
			 `DTCAD_CLI` date COMMENT 'Data de cadastro',			 
			 `TIPO_CLI` varchar(1) NOT NULL COMMENT 'C= CLIENTE - F= FORNECEDOR - A= AMBOS',
			 `PFPJ_CLI` varchar(1) NOT NULL COMMENT ' F = FISICA  - J = JURIDICA',
			 `NOME_CLI` varchar(255) NOT NULL,
			 `CGC_CLI` varchar(255) NOT NULL,
			 `SEXO_CLI` varchar(1) NOT NULL COMMENT 'M = MASCULINO - F FEMININO',
			 `INSC_CLI` varchar(255) NOT NULL COMMENT 'INSCRICAO ESTADUAL',
			 `DTNAS_CLI` date NOT NULL COMMENT 'DATA DE NASCIMENTO',
			 `TELRES_CLI` varchar(255) NOT NULL COMMENT 'Telefone Residencial ',
			 `TELCEL_CLI` varchar(255) NOT NULL COMMENT 'Telefone Celular ',
			 `TELCOM_CLI` varchar(255) NOT NULL COMMENT 'Telefone Comercial',
			 `RESP_CLI` varchar(255) NOT NULL COMMENT 'EM CASO DE PJ E O NOME DO RESPOSAVEL DA EMPRESA',
			 `ALIAS_CLI` varchar(255) NOT NULL COMMENT 'APELIDO DO CLIENTE PF',
			 `EMAIL_CLI` varchar(1255) NOT NULL,
			 `SENHA_CLI` varchar(255) NOT NULL,
			 `MD_CLI` varchar(1) NOT NULL COMMENT 'DESEJA RECEBER MALA DIRETA DA EMPRESA',
			 `CEP_CLI` varchar(255) NOT NULL,
			 `IDED_CLI` varchar(255) COMMENT 'Ex: Residencial, Comercial, Casa dos Pais, casa de praia, Casa da namorada, etc',
			 `END_CLI` varchar(255) NOT NULL,
			 `NUM_CLI` varchar(10) NOT NULL,
			 `COMP_CLI` varchar(255),
			 `INF_CLI` text COMMENT 'Informações de referência ',
			 `BAI_CLI` varchar(255) NOT NULL,
			 `CID_CLI` varchar(255) NOT NULL,
			 `EST_CLI` varchar(2) NOT NULL,
			 `PAIS_CLI` varchar(255) NOT NULL,
			 PRIMARY KEY (`ID_CLI`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;"
		);
	}
	if (!in_array('companies', $schema)) {
		$db->getConnection()->query(
		"CREATE TABLE IF NOT EXISTS `".$db_name."`.`companies` (
			 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			 `corporate_name` varchar(200) NOT NULL COMMENT 'RAZAO SOCIAL DA EMPRESA',
			 `fancy_name` varchar(200) NOT NULL COMMENT 'NOME FANTASIA',
			 `cgc` varchar(18) NOT NULL COMMENT 'CNPJ OU CPF DA EMPRESA',
			 `state_registration` varchar(45) NOT NULL COMMENT 'INSCRICAO ESTADUAL',
			 `street` varchar(200) NOT NULL COMMENT 'ENDERECO',
			 `number` varchar(10) NOT NULL COMMENT 'NUMERO DO ESTABELECIMENTO',
			 `complement` varchar(145) NOT NULL COMMENT 'COMPLEMENTO',
			 `neighborhood` varchar(145) NOT NULL COMMENT 'BAIRRO',
			 `zip_code` varchar(10) NOT NULL COMMENT 'CEP DA EMPRESA',
			 `city` varchar(145) NOT NULL COMMENT 'CIDADE',
			 `state` varchar(2) NOT NULL COMMENT 'ESTADO',
			 `phone` varchar(45) NOT NULL COMMENT 'TELEFONE',
			 `fax` varchar(45) NOT NULL COMMENT 'NUMERO DE FAX',
			 `email` varchar(200) NOT NULL COMMENT 'EMAIL',
			 `contact` varchar(145) NOT NULL COMMENT 'CONTATO DA EMPRESA',
			 PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
		");
	}
	if (!in_array('TB_GRUPOS', $schema)) {
		$db->getConnection()->query(
		"CREATE TABLE IF NOT EXISTS `".$db_name."`.`TB_GRUPOS` (
			 `ID_GRU` int(10) unsigned NOT NULL AUTO_INCREMENT,
			 `DESC_GRU` varchar(200) NOT NULL COMMENT 'NOME DO GRUPO',
			 PRIMARY KEY (`ID_GRU`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
		");
	}
	if (!in_array('TB_SUBGRUPOS', $schema)) {
		$db->getConnection()->query(
		"CREATE TABLE IF NOT EXISTS `".$db_name."`.`TB_SUBGRUPOS` (
			`ID_SGRU` INT NOT NULL AUTO_INCREMENT ,
			`DESC_SGRU` VARCHAR( 200 ) NOT NULL ,
			`ID_GRU` INT NOT NULL ,
			PRIMARY KEY ( `ID_SGRU` ),
			FOREIGN KEY(ID_GRU) REFERENCES TB_GRUPOS(ID_GRU)
			) ENGINE = MYISAM;
		");
	}
	
	if (!in_array('TB_UNIDADES', $schema)) {
		$db->getConnection()->query(
		"CREATE TABLE IF NOT EXISTS `".$db_name."`.`TB_UNIDADES` (
			 `ID_UND` int(10) unsigned NOT NULL AUTO_INCREMENT,			 
			 `DESC_UND` varchar(200) NOT NULL COMMENT 'DESCRICAO DA UNIDADE',
			 PRIMARY KEY (`ID_UND`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		");
	}
	
	if (!in_array('TB_PRODUTOS', $schema)) {
		$db->getConnection()->query(
		"CREATE TABLE IF NOT EXISTS `".$db_name."`.`TB_PRODUTOS` (
			 `ID_PROD` int(10) unsigned NOT NULL AUTO_INCREMENT,
			 `NOME_PROD` varchar(200) NOT NULL COMMENT 'NOME DO SUBGRUPO',
			 `SUB_PROD` int(10) unsigned NOT NULL COMMENT 'SUBGRUPO DO PRODUTO',
			 `TAM_PROD` varchar(3) NOT NULL COMMENT 'TAMANHO DO PRODUTO',
			 `COR_PROD` varchar(4) NOT NULL COMMENT 'COR DO PRODUTO',
			 `CODBAR_PROD` varchar(255) NOT NULL COMMENT 'CODIGO DE BARRA',
			 `CLI_PROD` int(10) NOT NULL COMMENT 'FORNECEDOR DO PRODUTO',
			 `UND_PROD` int(2) NOT NULL COMMENT 'UNIDADE DO PRODUTO',
			 `QNT_PROD` double NOT NULL COMMENT 'QUANTIDADE DO PRODUTO',
			 `MIN_PROD` double NOT NULL COMMENT 'ESTOQUE MINIMO DO PRODUTO',
			 `MAX_PROD` double NOT NULL COMMENT 'ESTOQUE MAXIMO DO PRODUTO',
			 `CUST_PROD` double NOT NULL COMMENT 'CUSTO DO PRODUTO',
			 `CUSTMED_PROD` double NOT NULL COMMENT 'CUSTO MEDIO DO PRODUTO',
			 `MARG_PROD` double NOT NULL COMMENT 'MARGEM DE VENDA DO PRODUTO',
			 `VEND_PROD` double NOT NULL COMMENT 'PRECO DE VENDA DO PRODUTO',
			 `ICMS_PROD` double NOT NULL COMMENT 'ICMS DO PRODUTO',
			 `SIT_PROD` varchar(1) NOT NULL COMMENT 'SITUACAO DO PRODUTO ATIVO S OU N',
			 `PRO_PROD` double NOT NULL COMMENT 'PROMOCAO DO PRODUTO',
			 `DESC_PROD` double NOT NULL COMMENT 'DESCONTO DO PRODUTO',
			 PRIMARY KEY (`ID_PROD`),
			 FOREIGN KEY(SUB_PROD) REFERENCES TB_SUBGRUPOS(ID_SGRU), 
			 FOREIGN KEY(CLI_PROD) REFERENCES TB_CLIENTES(ID_CLI), 
			 FOREIGN KEY(UND_PROD) REFERENCES TB_UNIDADES(ID_UND) 
			) ENGINE=MyISAM DEFAULT CHARSET=latin1;
		");
	}
}
}
?>