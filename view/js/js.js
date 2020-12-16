//Carrega as variáveis globais
const tableProduto = document.querySelector("#bodyProdutos");
const tableRealizar = document.querySelector("#bodyRealizar");
const tableComercalizar= document.querySelector("#bodyComercializar");
const msg = document.querySelector("#mensagem");
const xhr = new XMLHttpRequest();
const urlComercalizar = "http://localhost/avaliacao/src/controll/routes/route.Comercializar.php";
const urlProdutos = "http://localhost/avaliacao/src/controll/routes/route.Produtos.php";
const urlRealizar = "http://localhost/avaliacao/src/controll/routes/route.Realizada.php";
let contTel = 0;
let tels = [];

function listar() {
   
	fetch(urlProdutos)
		.then(function (resp) {
			//Obtem a resposta da URL no formato JSON
			if (!resp.ok)
				throw new Error("Erro ao executar requisição: " + resp.status);
			return resp.json();
		})
		.then(function (data) {
			//Se obteve a resposta explora os dados recebidos
			data.forEach((val) => {
				let row = document.createElement("tr");
				row.innerHTML = `<tr><td>${val.id_produto}</td>`;
				row.innerHTML += `<td>${val.nome}</td>`;
				row.innerHTML += `<td>${val.descricao}</td>`;
				row.innerHTML += `<td>${val.marca}</td>`;
				row.innerHTML += `<td style="padding:3px"><button  id="buttonMenu" onclick='delProduto(this)'>Del</button></td></tr>`;
				tableProduto.appendChild(row);
			});
		}) //Se obteve erro no processo exibe no console do navegador
		.catch(function (error) {
			console.error(error.message);
		});
    
}

function listar2() {

	fetch(urlComercalizar)
		.then(function (resp) {
            //Obtem a resposta da URL no formato JSON
			if (!resp.ok)
                throw new Error("Erro ao executar requisição: " + resp.status);
                
			return resp.json();
		})
		.then(function (data) {
            console.log(data);
			//Se obteve a resposta explora os dados recebidos
			data.forEach((val) => {
				let row = document.createElement("tr");
				row.innerHTML = `<tr><td>${val.id_com}</td>`;
				row.innerHTML += `<td>${val.local}</td>`;
				row.innerHTML += `<td>${val.responsavel}</td>`;
				row.innerHTML += `<td>${val.tipo}</td>`;
				row.innerHTML += `<td style="padding:3px"><button  id="buttonMenu" onclick='delComercializar(this)'>Del</button></td></tr>`;
				tableComercalizar.appendChild(row);
			});
		}) //Se obteve erro no processo exibe no console do navegador
		.catch(function (error) {
			console.error(error.message);
		});
    
}

function listar3() {
        fetch(urlRealizar)
            .then(function (resp) {
                //Obtem a resposta da URL no formato JSON
                if (!resp.ok)
                    throw new Error("Erro ao executar requisição: " + resp.status);
                return resp.json();
            })
            .then(function (data) {
                //Se obteve a resposta explora os dados recebidos
                data.forEach((val) => {
                    let row = document.createElement("tr");
                    row.innerHTML = `<tr><td>${val.id_produto}</td>`;
                    row.innerHTML = `<tr><td>${val.id_com}</td>`;
                    row.innerHTML += `<td>${val.quantidade}</td>`;
                    row.innerHTML += `<td>${val.preco}</td>`;
					row.innerHTML += `<td style="padding:3px"><button  id="buttonMenu" onclick='delRealizar(this)'>Del</button"></td></tr>`;
                    tableRealizar.appendChild(row);
                });
            }) //Se obteve erro no processo exibe no console do navegador
            .catch(function (error) {
                console.error(error.message);
            });
}

function sair() {
    window.location.href = "../";
}

function adicionar() {
    let url = "http://localhost/avaliacao/src/controll/routes/route.Produtos.php";
    let nomeP = document.querySelector("#nome");
	let descr = document.querySelector("#descricao");
	let mar = document.querySelector("#marca");
    if (nomeP.value != "" && descr.value != ""  && mar.value != "") {
        let dados = new FormData();
        dados.append("nome", nomeP.value);
		dados.append("descricao", descr.value);
		dados.append("marca", mar.value);
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                   alert= resp.erro;
                } else {
                 alert = "produto criada com sucesso.";
                }
                setTimeout(() => { window.location.reload(); }, 3000);
            }
        });
        xhr.open("POST", url);
        xhr.send(dados);
    } else {
		alert = "Favor preencha.";
		alert ="Mensagens do sistema";
    }
}

function adicionar2() {
    let url = "http://localhost/avaliacao/src/controll/routes/route.Comercializar.php";
    let lo = document.querySelector("#local");
	let res = document.querySelector("#responsavel");
	let ti = document.querySelector("#tipo");
    if (lo.value != "" && res.value != ""  && ti.value != "") {
        let dados = new FormData();
        dados.append("local", lo.value);
		dados.append("responsavel", res.value);
		dados.append("tipo", ti.value);
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                   alert= resp.erro;
                } else {
                 alert = "responsavel criada com sucesso.";
                }
                setTimeout(() => { window.location.reload(); }, 3000);
            }
        });
        xhr.open("POST", url);
        xhr.send(dados);
    } else {
		alert = "Favor preencha.";
		alert ="Mensagens do sistema";
    }
}

function adicionar3() {
    let url = "http://localhost/avaliacao/src/controll/routes/route.Realizar.php";
    let idp = document.querySelector("#id_porduto");
	let idc = document.querySelector("#id_com");
    let q = document.querySelector("#quantidade");
    let p = document.querySelector("#preco");

    if (idp.value != "" && idc.value != ""  && q.value != ""  && p.value != "") {
        let dados = new FormData();
        dados.append("id_produto", idp.value);
		dados.append("id_com", idc.value);
        dados.append("quantidade", q.value);
        dados.append("preco", p.value);
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                   alert= resp.erro;
                } else {
                 alert = "venda criada com sucesso.";
                }
                setTimeout(() => { window.location.reload(); }, 3000);
            }
        });
        xhr.open("POST", url);
        xhr.send(dados);
    } else {
		alert = "Favor preencha.";
		alert ="Mensagens do sistema";
    }
}

function delProduto(p) {
    let url = "http://localhost/avaliacao/src/controll/routes/route.Produtos.php";
    let id = p.parentNode.parentNode.cells[0].innerText;
    let dados = "id_produto=" + id;
    if (window.confirm("Confirma Exclusão do id " + id + "?")) {
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                    msg.innerHTML = resp.erro;
                } else {
                    msg.innerHTML = "Pessoa excluída com sucesso.";
                }
                setTimeout(() => { window.location.reload(); }, 3000);
            }
        });
        xhr.open("DELETE", url);
        xhr.send(dados);
    }
}

function delComercializar(c) {
    let url = "http://localhost/avaliacao/src/controll/routes/route.Comercializar.php";
    let id = c.parentNode.parentNode.cells[0].innerText;
    let dados = "id_com=" + id;
    if (window.confirm("Confirma Exclusão do id " + id + "?")) {
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                    msg.innerHTML = resp.erro;
                } else {
                    msg.innerHTML = "Pessoa excluída com sucesso.";
                }
                setTimeout(() => { window.location.reload(); }, 3000);
            }
        });
        xhr.open("DELETE", url);
        xhr.send(dados);
    }
}

function delRealizar(r) {
    let url = "http://localhost/avaliacao/src/controll/routes/route.Realizar.php";
    let id = r.parentNode.parentNode.cells[0].innerText;
    let dados = "id_produto=" + id;
    if (window.confirm("Confirma Exclusão do id " + id + "?")) {
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                    msg.innerHTML = resp.erro;
                } else {
                    msg.innerHTML = "Pessoa excluída com sucesso.";
                }
                setTimeout(() => { window.location.reload(); }, 3000);
            }
        });
        xhr.open("DELETE", url);
        xhr.send(dados);
    }
}

function calcular1(){    
	var x=document.getElementById("quantidade1").value; 
	var a=document.getElementById("preco1").value;    
    var total1=x*a;    
    document.getElementById("total1").innerHTML="R$"+total1+",00";
}

function calcular2(){    
    var x=document.getElementById("quantidade2").value; 
	var a=document.getElementById("preco2").value;    
    var total2=x*a;    
    document.getElementById("total2").innerHTML="R$"+total2+",00";
}

function calcular3(){    
    var x=document.getElementById("quantidade3").value; 
	var a=document.getElementById("preco3").value;    
    var total3=x*a;    
    document.getElementById("total3").innerHTML="R$"+total3+",00";
}