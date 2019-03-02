//Classe que representa uma despesa.
class Despesa{
	constructor(ano, mes, dia, tipo, desc, valor){
		this.ano = ano
		this.mes = mes
		this.dia = dia
		this.tipo = tipo
		this.desc = desc
		this.valor = valor
	}
}

//Coleta os valores passados pelo usuário
function pegaValores(){
	let ano = document.getElementById("ano")
	let mes = document.getElementById("mes")
	let dia = document.getElementById("dia")
	let tipo = document.getElementById("tipo")
	let desc = document.getElementById("descricao")
	let valor = document.getElementById("valor")
	if(ano.value === "" || ano.value === undefined || mes.value === "" || mes.value === undefined || dia.value === "" || dia.value === undefined || isNaN(parseInt(dia.value)) || tipo.value === "" || tipo.value === undefined || desc.value === "" || desc.value === undefined || valor.value === "" || valor.value === undefined || isNaN(parseFloat(valor.value))){
		modalChange("Erro no cadastro", "Preencha todos campos corretamente.", false)
		$("#modalAlert").modal('show')
		return
	}
	cadastraDespesa(ano,mes,dia,tipo,desc,valor)	
}


//Cadastra uma nova despesa
function cadastraDespesa(ano,mes,dia,tipo,desc,valor){
	let despesa = new Despesa(ano.value, mes.value, dia.value, tipo.value, desc.value, valor.value)
	gravar(despesa)
	desc.value = dia.value = mes.value = ano.value = valor.value = tipo.value = ""
	modalChange("Sucesso", "Cadastro realizado com sucesso.", true)
	$("#modalAlert").modal('show')
}

//Grava as despesas no local Storage
function gravar(d){
	localStorage.setItem(localStorage.length, JSON.stringify(d))
}

//Comanda o comporamento do alerta de cadastro.
function modalChange(title, corpo, flag){
	document.getElementById("tituloModal").innerHTML = title
	document.getElementById("corpoModal").innerHTML = corpo
	if (flag){
		document.getElementById("fechar").classList.add('btn-success')
	}else{
		document.getElementById("fechar").classList.add('btn-danger')
	}

}

//Transfere todos as despesas validas para um Array
function recuperaDespesas(){
	let listaDespesas = Array()
	for (var i = 0; i < localStorage.length; i++) {
		let despesa = JSON.parse(localStorage.getItem(i))
		if(despesa === null){
			continue
		}

		despesa.id = i
		listaDespesas.push(despesa)
	}

	return listaDespesas
}

//Lista as despesas na página de consulta
function listarDespesas(lista){
	let tabela = document.getElementById("tabela")
	tabela.innerHTML = ''
	for (var i = 0; i < lista.length; i++) {
		let linha = tabela.insertRow()
		linha.insertCell(0).innerHTML = `${lista[i].dia}/${lista[i].mes}/${lista[i].ano}`

		switch(lista[i].tipo){
			case '1': lista[i].tipo = "Alimentação"; break
			case '2': lista[i].tipo = "Educação"; break
			case '3': lista[i].tipo = "Lazer"; break
			case '4': lista[i].tipo = "Saúde"; break
			case '5': lista[i].tipo = "Transporte"; break
		}

		linha.insertCell(1).innerHTML = lista[i].tipo
		linha.insertCell(2).innerHTML = lista[i].desc
		linha.insertCell(3).innerHTML = `R$${parseFloat(lista[i].valor)}`

		let butao = document.createElement("button")
		butao.className = "btn btn-danger"
		butao.innerHTML = '<i class="fas fa-times"></i>'
		butao.id = lista[i].id
		butao.onclick = function(){
			localStorage.removeItem(butao.id)
			listarDespesas(recuperaDespesas())
		}
		linha.insertCell(4).append(butao)
	}
}

//Recupera informações dos campos da página consulta e filtra as despesas com base nessas informações.
function filtra(){
	let ano = document.getElementById("ano")
	let mes = document.getElementById("mes")
	let dia = document.getElementById("dia")
	let tipo = document.getElementById("tipo")
	let desc = document.getElementById("descricao")
	let valor = document.getElementById("valor")
	listarDespesas(filtraDespesas(ano.value,mes.value,dia.value,tipo.value,desc.value,valor.value))
}

//Coloca todas despesas correspondentes aos filtros em um array. ps: daria pra fazer com filter, mas só aprendi depois :)
function filtraDespesas(ano,mes,dia,tipo,desc,valor){
	let listaDespesas = Array()
	for (var i = 0; i < localStorage.length; i++) {
		let despesa = JSON.parse(localStorage.getItem(i))
		if(despesa === null){
			continue
		}
		despesa.verificaSimilaridade = function (a="",b="",c="",d="",e="",f=""){
		if((this.ano === a || a === "") && (this.mes === b || b === "") && (this.dia === c || c === "") && (this.tipo === d || d === "") && (this.desc === e || e === "") && (this.valor === f || f === "")){
			return true
		}
		return false
	}
		despesa.id = i
		if(despesa.verificaSimilaridade(ano,mes,dia,tipo,desc,valor)){
			listaDespesas.push(despesa)
		}
	}
	return listaDespesas
}