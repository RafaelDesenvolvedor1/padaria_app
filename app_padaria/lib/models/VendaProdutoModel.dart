class VendaProdutoModel {
  final int idVenda;
  final int idProduto;
  final String produtoNome;

  VendaProdutoModel({
    required this.idVenda,
    required this.idProduto,
    required this.produtoNome,
  });

  // Fábrica que transforma o JSON da API em um Objeto Dart
  factory VendaProdutoModel.fromJson(Map<String, dynamic> json) {
    return VendaProdutoModel(
      idVenda: json['id_venda'],
      idProduto: json['id_produto'],
      produtoNome: json['produto_nome'],
    );
  }
}