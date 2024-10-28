// Passa os dados do cliente para o Modal, e atualiza o link para exclusão

$("#delete-modal").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("customer");
    var nome = button.data("nome");

    // Pegando o nome e fazendo verificação de caracteres, e se for maior que 5 ele exibira somente o primeiro index[nome] = 0;
    // Exemplo nome = "Leonardo Emanuel Marques", ["Leonardo", "Emanuel", "Marques"]. nome[0] = Leonardo;
    const alias = nome.length > 5 ? nome.split(" ")[0] : nome;

    var modal = $(this);
    modal.find(".modal-title").text("Excluir Cliente: " + alias);
    modal.find(".modal-body").text("Deseja realmente excluir o cliente" + id);
    modal.find("#confirm").attr("href", "delete.php?id=" + id);
});

// Cria um listener pro evento "show.bs.modal"
$("#delete-user-modal").on("show.bs.modal", function (event) {
    // busca o botão relacionado a esse evento
    var button = $(event.relatedTarget);
    // Recupera o id pelo valor passado no data-usuario
    var id = button.data("usuario");
    var nome = button.data("nome");

    // Cria variavel do modal
    var modal = $(this);
    // Busca elementos dentro do modal e altera o texto
    modal.find(".modal-title").text("Excluir Usuário: " + nome);
    modal.find(".modal-body").text("Deseja realmente excluir o usuário " + id);
    modal.find("#confirm").attr("href", "delete.php?id=" + id);
});

// Cria um listener pro evento "show.bs.modal"
$("#delete-enfe-modal").on("show.bs.modal", function (event) {
    // busca o botão relacionado a esse evento
    var button = $(event.relatedTarget);
    // Recupera o id pelo valor passado no data-usuario
    var id = button.data("enfermeiro");
    var prefixo = button.data("prefixo");

    // Cria variavel do modal
    var modal = $(this);
    // Busca elementos dentro do modal e altera o texto
    modal.find(".modal-title").text("Excluir enfermeiro");
    modal.find(".modal-body").html("<b>Deseja realmente excluir o enfermeiro: </b> " + prefixo);
    modal.find("#confirm").attr("href", "delete.php?id=" + id);
});
