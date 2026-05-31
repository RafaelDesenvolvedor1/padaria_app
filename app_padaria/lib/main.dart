import 'package:flutter/material.dart';
import './screens/MainScreen.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Padaria App',
      debugShowCheckedModeBanner: false,
      
      // Configuração do Tema Escuro baseado no protótipo
      theme: ThemeData.dark().copyWith(
        scaffoldBackgroundColor: const Color(0xFF121212), // Fundo do app
        primaryColor: const Color(0xFFFF9800), // Laranja de destaque
        colorScheme: const ColorScheme.dark(
          primary: Color(0xFFFF9800),
          surface: Color(0xFF1E1E1E), // Cor dos cards
        ),
        appBarTheme: const AppBarTheme(
          backgroundColor: Color(0xFF1E1E1E),
          elevation: 0,
        ),
      ),
      
      // Define a tela com a Navbar como a inicial
      home: const MainScreen(),
    );
  }
}