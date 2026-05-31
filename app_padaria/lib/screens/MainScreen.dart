import 'package:flutter/material.dart';
import 'inicioScreen.dart'; 

class MainScreen extends StatefulWidget {
  const MainScreen({super.key});

  @override
  State<MainScreen> createState() => _MainScreenState();
}

class _MainScreenState extends State<MainScreen> {
  int _currentIndex = 0;

  // Lista de telas correspondentes a cada aba
  final List<Widget> _screens = [
    const InicioScreen(),
    const Center(child: Text('Tela de Vendas')), 
    const Center(child: Text('Tela de Produtos')), 
    const Center(child: Text('Menu Mais')), 
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      // Exibe a tela ativa baseada no índice atual
      body: _screens[_currentIndex],
      
      bottomNavigationBar: BottomNavigationBar(
        currentIndex: _currentIndex,
        onTap: (index) {
          setState(() {
            _currentIndex = index; // Atualiza a aba ativa
          });
        },
        type: BottomNavigationBarType.fixed, // Mantém os ícones firmes
        backgroundColor: const Color(0xFF1E1E1E), // Fundo escuro do protótipo
        selectedItemColor: const Color(0xFFFF9800), // Laranja do protótipo
        unselectedItemColor: Colors.grey,
        items: const [
          BottomNavigationBarItem(
            icon: Icon(Icons.home_filled),
            label: 'Início',
          ),
          BottomNavigationBarItem(
            icon: Icon(Icons.shopping_cart_outlined),
            label: 'Vendas',
          ),
          BottomNavigationBarItem(
            icon: Icon(Icons.bakery_dining_outlined),
            label: 'Produtos',
          ),
          BottomNavigationBarItem(
            icon: Icon(Icons.menu),
            label: 'Mais',
          ),
        ],
      ),
    );
  }
}