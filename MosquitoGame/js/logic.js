function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min
}

function sleep (time) {
  return new Promise((resolve) => setTimeout(resolve, time))
}
let vidas = 3
let nivel = 1800
let i = 20
let dificuldade = window.location.search
dificuldade.replace('?', '')
if(dificuldade === 'normal'){
	nivel = 1800
}else if(dificuldade === 'hard'){
	nivel = 1500
}else{
	nivel = 1000
}

function mosquitoSumm(){
	let mosca = document.createElement('img')
	let tamanho = getRandomInt(40, 90)
	mosca.width = tamanho
	mosca.src = './img/mosca.png'
	mosca.style.top = getRandomInt(0, 508) + 'px'
	mosca.style.left = getRandomInt(0, 640) + 'px'
	mosca.id = 'mosc'
	mosca.style.position = 'absolute'
	mosca.onclick = mataMosca
	document.body.appendChild(mosca)
	if (nivel < 500){nivel = 500}
	sleep(nivel).then(() => {
		document.getElementById("mosc").remove()
		document.getElementById('coracao' + vidas).src = './img/coracao_vazio.png'
		vidas--
		if(vidas === 0){
			window.location.href = './final.html'
		}
	})
}

let intervalo = setInterval(mosquitoSumm, 2000)

function Tempo(){
	if((i) > 0){
		document.getElementById('tempo').innerHTML = i
		i--
		setTimeout('Tempo()', 1000)
	}else{
		window.location.href = './vitoria.html'
	}
}

Tempo()

function mataMosca(){
	document.getElementById("mosc").remove()
	nivel -= 100
}
