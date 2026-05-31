import 'package:dio/dio.dart';
import '../models/VendaProdutoModel.dart';


class DashboardService {
  final Dio _dio = Dio();
  final String _baseUrl = 'http://localhost:8000';

  // Método privado que você criou para centralizar a lógica
  Future<int> _fetchCount(String endpoint) async {
    try {
      final response = await _dio.get('$_baseUrl$endpoint');
      if (response.statusCode == 200) {
        final List list = response.data;
        return list.length;
      }
      return 0;
    } catch (e) {
      print('Erro ao buscar $endpoint: $e');
      return 0;
    }
  }

  // Métodos públicos que a tela vai acessar
  Future<int> getProdutosCount() async {
    return await _fetchCount('/produtos'); // Rota de produtos
  }

  Future<int> getClientesCount() async {
    return await _fetchCount('/clientes'); // Rota de clientes
  }

  Future<int> getVendasCount() async {
    return await _fetchCount('/vendas'); // Rota de vendas
  }

  Future<int> getFuncionariosCount() async {
    return await _fetchCount('/funcionarios'); // Rota de funcionários
  }

  // Busca a lista de produtos vendidos para o feed do painel
Future<List<VendaProdutoModel>> getVendaProdutos() async {
  try {
    final response = await _dio.get('$_baseUrl/vendaprodutos'); //
    
    if (response.statusCode == 200) {
      final List rawList = response.data;
      
      // Converte a lista dinâmica do JSON em uma lista da nossa Model
      return rawList
          .map((item) => VendaProdutoModel.fromJson(item))
          .toList();
    }
    
    return []; // Retorna uma lista vazia se o status não for 200
  } catch (e) {
    print('Erro ao buscar venda produtos: $e');
    return []; // Retorna uma lista vazia em caso de erro na requisição
  }
}
}