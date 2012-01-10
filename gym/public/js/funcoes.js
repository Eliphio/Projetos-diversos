function exclui(url, id){
	if (confirm("Deseja realmente excluir este cadastro?")) {
		window.location.href=(url+"?id="+id);
	}
}