<?php 

class Mensagem{
	
	private $de;
	private $para;
	private $assunto = "";
	private $msg;

	function __construct($de, $para, $assunto, $msg){
		if(empty($para) || is_null($para) || empty($msg) || is_null($msg) || empty($de) || is_null($de)){
			throw new Error("Erro no preenchimento dos dados.");
		}

		$this->de = $de;
		$this->para = $para;
		$this->assunto = $assunto;
		$this->msg = $msg;
	}

	function __get($atributo){
		return $this->$atributo;
	}
}

?>