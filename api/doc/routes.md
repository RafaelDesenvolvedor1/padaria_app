# Documentação das Rotas da API

Base URL: `/`

O roteamento é feito pelo `index.php`, que interpreta o primeiro segmento da URI como o recurso e o segundo como o `id`.

```
/{recurso}/{id}
```

---

## Clientes

Base path: `/clientes`

| Método | URI | Ação | Controller |
|--------|-----|------|------------|
| `GET` | `/clientes` | Lista todos os clientes | `listClientes()` |
| `GET` | `/clientes/{id}` | Retorna um cliente pelo ID | `searchCliente($id)` |
| `POST` | `/clientes` | Cria um novo cliente | `createCliente()` |
| `PUT` | `/clientes/{id}` | Atualiza um cliente pelo ID | `updateCliente($id)` |
| `DELETE` | `/clientes/{id}` | Remove um cliente pelo ID | `deleteCliente($id)` |

---

## Fornecedores

Base path: `/fornecedores`

| Método | URI | Ação | Controller |
|--------|-----|------|------------|
| `GET` | `/fornecedores` | Lista todos os fornecedores | `getFornecedores()` |
| `GET` | `/fornecedores/{id}` | Retorna um fornecedor pelo ID | `getFornecedorById($id)` |
| `POST` | `/fornecedores` | Cria um novo fornecedor | `postFornecedor($_POST)` |
| `PUT` | `/fornecedores/{id}` | Atualiza um fornecedor pelo ID | `putFornecedor($id, $_POST)` |
| `DELETE` | `/fornecedores/{id}` | Remove um fornecedor pelo ID | `deleteFornecedor($id)` |

---

## Funcionários

Base path: `/funcionarios`

| Método | URI | Ação | Controller |
|--------|-----|------|------------|
| `GET` | `/funcionarios` | Lista todos os funcionários | `getFuncionarios()` |
| `GET` | `/funcionarios/{id}` | Retorna um funcionário pelo ID | `getFuncionarioById($id)` |
| `POST` | `/funcionarios` | Cria um novo funcionário | `postFuncionario($_POST)` |
| `PUT` | `/funcionarios/{id}` | Atualiza um funcionário pelo ID | `putFuncionario($id, $_POST)` |
| `DELETE` | `/funcionarios/{id}` | Remove um funcionário pelo ID | `deleteFuncionario($id)` |

---

## Produtos

Base path: `/produtos`

| Método | URI | Ação | Controller |
|--------|-----|------|------------|
| `GET` | `/produtos` | Lista todos os produtos | `getProdutos()` |
| `GET` | `/produtos/{id}` | Retorna um produto pelo ID | `getProdutoById($id)` |
| `POST` | `/produtos` | Cria um novo produto | `postProduto($_POST)` |
| `PUT` | `/produtos/{id}` | Atualiza um produto pelo ID | `putProduto($id, $_POST)` |
| `DELETE` | `/produtos/{id}` | Remove um produto pelo ID | `deleteProduto($id)` |

---

## Vendas

Base path: `/vendas`

| Método | URI | Ação | Controller |
|--------|-----|------|------------|
| `GET` | `/vendas` | Lista todas as vendas | `listarVendas()` |
| `GET` | `/vendas/{id}` | Retorna uma venda pelo ID | `obterVendaPorId($id)` |
| `POST` | `/vendas` | Cria uma nova venda | `criarVenda($_POST)` |
| `PUT` | `/vendas/{id}` | Atualiza uma venda pelo ID | `atualizarVenda($id, $_POST)` |
| `DELETE` | `/vendas/{id}` | Remove uma venda pelo ID | `excluirVenda($id)` |

---

## Venda Produtos (Itens de Venda)

Base path: `/vendaprodutos`

Recurso de relacionamento entre vendas e produtos. Utiliza query strings `venda_id` e `produto_id` em vez de segmentos de URI, e recebe o corpo da requisição via `php://input`.

| Método | URI / Query | Ação | Controller |
|--------|-------------|------|------------|
| `GET` | `/vendaprodutos` | Lista todos os itens de venda | `listarVendaProdutos()` |
| `GET` | `/vendaprodutos?venda_id={id}` | Lista os produtos de uma venda | `getProdutosByVendaId($venda_id)` |
| `POST` | `/vendaprodutos` | Adiciona um produto a uma venda (body JSON) | `createVendaProduto(body)` |
| `PUT` | `/vendaprodutos?venda_id={id}&produto_id={id}` | Atualiza um item de venda (body JSON) | `updateVendaProduto($venda_id, $produto_id, body)` |
| `DELETE` | `/vendaprodutos?venda_id={id}&produto_id={id}` | Remove um item de venda | `deleteVendaProduto($venda_id, $produto_id)` |

---

## Respostas de Erro

| Código HTTP | Situação |
|-------------|----------|
| `404` | Recurso (segmento de URI) não encontrado |
| `405` | Método HTTP não permitido para a rota acessada |
