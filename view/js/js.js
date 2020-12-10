//Carrega as variáveis globais
const descr = document.querySelector("#Decrição"); //Entrada
const quant = document.querySelector("#Quantidade"); //Entrada
const pç = document.querySelector("#Preço"); //Entrada
const somaF = document.querySelector("#somaTotal"); //Saída
const nomeP = document.querySelector("#nome");//entrada
const mar = document.querySelector("#marca");//entrada
const valor = document.querySelector("#valor"); //Saída
const corpoTabela = document.querySelector("#tableBody"); //Saída
const add = document.querySelector("#adicionar"); //Processamento

function produto_insert_db(data)
{
		//Se obteve a resposta explora os dados recebidos
		data.forEach((val) => {
			let armazenar = document.createElement("input");
			armazenar.value = val.armazenar;
			descr.value = val.descr;
			mar.value = val.mar;
			nomeP.appendChild(armazenar);
		})//Se obteve erro no processo exibe no console do navegador
	.catch(function (error) {
		console.error(error.message);
	});
}

function listar(_id)
{
	//Variáveis que guardam os dados do produto que a pessoa quer comprar
	var id_prod_com = document.getElementById('id_prod_com');
    id_prod_com.value = _id;
    
    db.transaction(function(tx) {
        tx.executeSql('SELECT * FROM produto WHERE id=?', [_id], function (tx, resultado) {
            var rows = resultado.rows[0];

            //Atribui o valor das variáveis no campo pra que o usuário não se preocupe em digitar o ID do produto e o Valor individual do produto
            id_prod_com.value = rows.id;
            nome_compra.value = rows.nome;
            valor_unit_compra.value = rows.preco;
            qtd_compra.value = '';
        });
    });

	$("#listar").hide();
	$("#comprar").show();
}

function compra(tx,results)
{
	$("#compra_listagem").empty();
	var len = results.rows.length;

	//Variavel pra armazenar o valor total da compra
	var valorCalculado = 0;

	for(var i = 0; i <len;i++)
	{
	$("#compra_listagem").append("<tr class='compra_item_lista'>"+
		"<td><h3>" + results.rows.item(i).id + "</h3></td>"+
        "<td><h3>" + results.rows.item(i).nomeP + "</h3></td>"+
        "<td><h3>" + results.rows.item(i).mar + "</h3></td>"+
		"<td><h3>" + results.rows.item(i).descr + "</h3></td>"+
		"<td><h3>" + results.rows.item(i).quant + "</h3></td>"+
		"<td class='valor-calculado'><h3>" + results.rows.item(i).valor_total + "</h3></td>"
		+ "</tr>");
	}

	//Função que atribui o valor da compra individual na compra total
    $( ".valor-calculado" ).each(function() {
      	valorCalculado += parseFloat($( this ).text());
    });

	//Mostrando o valor total da compra no campo embaixo da listagem de carrinho
	var totalcampo = document.getElementById('total');
	totalcampo.value = parseFloat(valorCalculado).toFixed(2);
}
function produto_delete_db(tx)
{
	var produto_id_delete = $("#produto_id_delete").val();
	tx.executeSql("DELETE FROM produto WHERE id = " + produto_id_delete);
	listar_view();
}
function compra_insert_db(tx)
{
	var qtd_estoque = 0;

	var valor_total = (pç * quant);

	tx.executeSql('SELECT * FROM produto WHERE id = '+ id_prod_com + '', [], function(tx,results) 
	{
		for (var i = 0; i < results.rows.length; i++)
		{
			qtd_estoque = results.rows.item(i).qtd_estoque;
		}
		if (qtd_estoque < quant) 
		{
			navigator.notification.beep(1);

			//Emite uma mensagem caso a compra exceda o estoque disponível
			return alert('Estoque insuficiente para compra'); 
		}
		else
		{
			//Emite mensagem caso a compra seja sucedida
			alert("Compra bem sucedida!") 
		}

		//Insert na tabela de compras e update na tabela de produto pra diminuir o valor do estoque
		tx.executeSql('INSERT INTO compra (id_prod, qtd_compra, valor_total) VALUES ("' + id_prod_com + '", "' + quant + '", "' + valor_total + '")');
		tx.executeSql('UPDATE produto SET estoque = (estoque - "' + quant + '") WHERE id = "' + id_prod_com + '"');

	}, null);

	//Atualiza o carrinho
	compra_view();
	produto_view();

	//Volta pra tela que lista os produtos
	tela_comprar_mostrar_tela_padrao();
}