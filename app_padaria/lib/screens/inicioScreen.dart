import 'package:flutter/material.dart';
import '../services/dashboard_service.dart';
import '../models/VendaProdutoModel.dart';

class InicioScreen extends StatefulWidget {
  const InicioScreen({super.key});

  @override
  State<InicioScreen> createState() => _InicioScreenState();
}

class _InicioScreenState extends State<InicioScreen> {
  final DashboardService _dashboardService = DashboardService();

  // Variáveis de contagem
  int _produtosCount = 0;
  int _clientesCount = 0;
  int _vendasCount = 0;
  int _funcionariosCount = 0;

  // Lista para o feed inferior
  List<VendaProdutoModel> _vendaProdutos = [];
  
  bool _isLoading = true;

  @override
  void initState() {
    super.initState();
    _carregarDadosDashboard();
  }

  Future<void> _carregarDadosDashboard() async {
    try {
      // Busca todos os dados em paralelo na API PHP
      final resultados = await Future.wait([
        _dashboardService.getProdutosCount(),
        _dashboardService.getClientesCount(),
        _dashboardService.getVendasCount(),
        _dashboardService.getFuncionariosCount(),
        _dashboardService.getVendaProdutos(),
      ]);

      setState(() {
        // Efetuando o cast correto dos tipos para o Dart
        _produtosCount = resultados[0] as int;
        _clientesCount = resultados[1] as int;
        _vendasCount = resultados[2] as int;
        _funcionariosCount = resultados[3] as int;
        _vendaProdutos = resultados[4] as List<VendaProdutoModel>;
        _isLoading = false;
      });
    } catch (e) {
      setState(() {
        _isLoading = false;
      });
      print('Erro ao carregar dados do painel: $e');
    }
  }

  // Componente visual dos cartões do Grid
  Widget _buildCard(String label, int valor, IconData icone) {
    return Card(
      color: Theme.of(context).colorScheme.surface,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(12.0),
      ),
      child: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text(
                  label,
                  style: const TextStyle(
                    color: Colors.grey,
                    fontSize: 15,
                    fontWeight: FontWeight.w500,
                  ),
                ),
                Icon(
                  icone,
                  color: Theme.of(context).primaryColor,
                ),
              ],
            ),
            Text(
              '$valor',
              style: const TextStyle(
                fontSize: 26,
                fontWeight: FontWeight.bold,
                color: Colors.white,
              ),
            ),
          ],
        ),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    if (_isLoading) {
      return const Scaffold(
        body: Center(
          child: CircularProgressIndicator(),
        ),
      );
    }

    return Scaffold(
      appBar: AppBar(
        title: Image.asset(
          '../../assets/Padaria_Logo.png',
          height: 40,
        ),
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // 1. Grade de Cards Superiores
            GridView.count(
              shrinkWrap: true,
              physics: const NeverScrollableScrollPhysics(),
              crossAxisCount: 2,
              crossAxisSpacing: 16,
              mainAxisSpacing: 16,
              children: [
                _buildCard('Vendas', _vendasCount, Icons.shopping_cart_outlined), //
                _buildCard('Produtos', _produtosCount, Icons.bakery_dining_outlined), //
                _buildCard('Clientes', _clientesCount, Icons.people_outline), //
                _buildCard('Funcionários', _funcionariosCount, Icons.badge_outlined), //
              ],
            ),
            
            const SizedBox(height: 28),
            
            // 2. Título da Seção Inferior
            const Text(
              'Produtos Vendidos',
              style: TextStyle(
                fontSize: 18,
                fontWeight: FontWeight.bold,
                color: Colors.white,
              ),
            ),
            
            const SizedBox(height: 12),
            
            // 3. Lista Dinâmica de Produtos Vendidos
            _vendaProdutos.isEmpty
                ? const Padding(
                    padding: EdgeInsets.symmetric(vertical: 20.0),
                    child: Text('Nenhum produto vendido registrado.', style: TextStyle(color: Colors.grey)),
                  )
                : ListView.builder(
                    shrinkWrap: true,
                    physics: const NeverScrollableScrollPhysics(),
                    itemCount: _vendaProdutos.length,
                    itemBuilder: (context, index) {
                      final item = _vendaProdutos[index];
                      return Card(
                        color: Theme.of(context).colorScheme.surface,
                        margin: const EdgeInsets.only(bottom: 8.0),
                        child: ListTile(
                          leading: CircleAvatar(
                            backgroundColor: Theme.of(context).primaryColor.withOpacity(0.2),
                            child: Icon(Icons.bakery_dining, color: Theme.of(context).primaryColor),
                          ),
                          title: Text(
                            item.produtoNome,
                            style: const TextStyle(fontWeight: FontWeight.bold),
                          ),
                          subtitle: Text('ID da Venda: #${item.idVenda}'),
                          trailing: const Icon(Icons.arrow_forward_ios, size: 16, color: Colors.grey),
                        ),
                      );
                    },
                  ),
          ],
        ),
      ),
    );
  }
}