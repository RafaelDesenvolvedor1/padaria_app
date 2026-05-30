import 'package:flutter/material.dart';
import 'package:dio/dio.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: Scaffold(
        appBar: AppBar(title: const Text('Facul App - Flutter & Docker')),
        body: const ApiTestWidget(),
      ),
    );
  }
}

class ApiTestWidget extends StatefulWidget {
  const ApiTestWidget({super.key});

  @override
  State<ApiTestWidget> createState() => _ApiTestWidgetState();
}

class _ApiTestWidgetState extends State<ApiTestWidget> {
  String _response = 'Carregando dados da API PHP...';

  @override
  void initState() {
    super.initState();
    _fetchData();
  }

  Future<void> _fetchData() async {
    final dio = Dio();
    try {
      final response = await dio.get('http://localhost:8000');
      setState(() {
        _response = response.data['mensagem'] ?? 'Chave não encontrada';
      });
    } catch (e) {
      setState(() {
        _response = 'Erro ao conectar na API: \$e';
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Center(
      child: Padding(
        padding: const EdgeInsets.all(20.0),
        child: Text(
          _response,
          style: const TextStyle(fontSize: 18),
          textAlign: TextAlign.center,
        ),
      ),
    );
  }
}
