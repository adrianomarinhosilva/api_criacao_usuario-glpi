Ferramenta de Criação de Usuários para GLPI
Visão Geral do Projeto
A aplicação é uma interface web para criação automatizada de usuários no sistema GLPI, oferecendo um processo simplificado e seguro de registro de novos colaboradores.
Características Principais
Funcionalidades

Criação Completa de Usuário

Registro de informações pessoais
Vinculação de email
Configuração de telefone
Atribuição de perfil de acesso


Integração com API do GLPI

Comunicação via REST API
Autenticação com tokens de segurança
Tratamento de erros e logs



Processo de Criação de Usuário
Etapas de Registro

Preenchimento de formulário web
Validação de dados de entrada
Criação do usuário via API
Vinculação de informações complementares
Atribuição de perfil de acesso

Recursos de Segurança

Autenticação via tokens
Validação de campos obrigatórios
Registro de logs de operações
Tratamento de exceções
Proteção contra erros de API

Componentes Técnicos
Interface Web

Formulário responsivo
Validações de campo
Feedback de sucesso/erro
Design limpo e intuitivo

Backend

PHP como linguagem principal
Requisições via cURL
Tratamento de respostas JSON
Logs de operações

Configurações Essenciais

Definição de URL da API
Configuração de tokens de autenticação
Perfil padrão de usuário
Entidade de vinculação

Fluxo de Operação

Usuário preenche formulário
Sistema valida dados
Envia requisição para API do GLPI
Cria usuário base
Adiciona email
Configura telefone
Atribui perfil de acesso
Registra log da operação

Benefícios

Automatização de criação de usuários
Redução de trabalho manual
Padronização de processos
Integração direta com GLPI
Registro detalhado de operações

Tecnologias Utilizadas

Linguagem: PHP
Frontend: HTML5, Bootstrap
Backend: API REST
Autenticação: Tokens
Gerenciamento: cURL

Possíveis Melhorias

Validações mais robustas
Integração com sistemas de RH
Suporte a múltiplos perfis
Interface de administração
Configurações personalizáveis

Considerações Finais
A ferramenta oferece uma solução eficiente e segura para criação automatizada de usuários no ambiente GLPI, simplificando processos administrativos e garantindo consistência no registro de novos colaboradores.
