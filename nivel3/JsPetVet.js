//Funcao adiciona uma nova linha na tabela
function adicionaLinha(idTabela) {

    var tabela = document.getElementById(idTabela);
    var numeroLinhas = tabela.rows.length;
    var linha = tabela.insertRow(numeroLinhas);

    var celula1 = linha.insertCell(0);
    var celula2 = linha.insertCell(1);   
    var celula3 = linha.insertCell(2); 
    var celula4 = linha.insertCell(3); 
    var celula5 = linha.insertCell(4); 
    var celula6 = linha.insertCell(5); 
    var celula7 = linha.insertCell(6); 
    var celula8 = linha.insertCell(7); 
    var celula9 = linha.insertCell(8); 
    var celula10 = linha.insertCell(9); 
    var celula11 = linha.insertCell(10);
    var celula12 = linha.insertCell(11);

    celula1.innerHTML = document.getElementById('Cod.Animal').value; 
    celula2.innerHTML = document.getElementById('nome').value;
    celula3.innerHTML = document.getElementById('Cod.Legado').value;
    celula4.innerHTML = document.getElementById('Nascimento').value;
    celula5.innerHTML = document.getElementById('sexo').value;
    celula6.innerHTML = document.getElementById('especie').value;
    celula7.innerHTML = document.getElementById('raça').value;
    celula8.innerHTML = document.getElementById('desc.raça').value;
    celula9.innerHTML = document.getElementById('peso').value;
    celula10.innerHTML = document.getElementById('obito').value;
    celula11.innerHTML = "<button id='btn_excluir' onclick='removeLinha(this)'>Excluir</button>";
    celula12.innerHTML = "<button id='btn_editar' onclick='editar'>Editar</button>";

    limparCampos();
}

function limparCampos(){

document.getElementById('Cod.Animal').value = "";
document.getElementById('nome').value = "";
document.getElementById('Cod.Legado').value = "";
document.getElementById('Nascimento').value = "";
document.getElementById('sexo').value = "";
document.getElementById('especie').value = "";
document.getElementById('raça').value = "";
document.getElementById('desc.raça').value = "";
document.getElementById('peso').value = "";
document.getElementById('obito').value = "";
document.getElementById('Cod.Animal').focus();

}

// funcao remove uma linha da tabela
function removeLinha(linha) {

var i = linha.parentNode.parentNode.rowIndex;
document.getElementById('tbl').deleteRow(i);

}      

function editar{



}