// JavaScript Document
function validaForm(form){
	var erro=0;
    var legenda;
    var obrigatorio;          
    for (i=0;i<form.length;i++){
    	obrigatorio = form[i].lang;
        if (obrigatorio==1){
        	if (form[i].value == ""){
            	var nome = form[i].name;
                mudarCorCampo(form[i], 'red');
                erro++;
			}
        }
     }
     if(erro>=1){
     	alert("Existe(m) " + erro + " campo(s) obrigatório(s) vazio(s)! ")
        return false;
     } else
        return true;
}

function mudarCorCampo(elemento, cor){
	elemento.style.backgroundColor=cor;
}

//Mascara
//CEP  onkeypress="formatar_mascara(this, '#####-###')" 
//CPF  onkeypress="formatar_mascara(this, '###.###.###-##')" 
//CNPJ onkeypress="formatar_mascara(this, '##.###.###/####-##')" />
function formatar_mascara(src, mascara) {
	var campo = src.value.length;
	var saida = mascara.substring(0,1);
	var texto = mascara.substring(campo);
	if(texto.substring(0,1) != saida) {
		src.value += texto.substring(0,1);
	}
}
//Upper Case
function upperCase(x){
	var y=document.getElementById(x).value;
	document.getElementById(x).value=y.toUpperCase();
} 