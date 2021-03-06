# social

> A Vue.js project

## Build Setup

``` bash
# install dependencies
npm install

# serve with hot reload at localhost:8080
npm run dev

# build for production with minification
npm run build

# build for production and view the bundle analyzer report
npm run build --report
```

For a detailed explanation on how things work, check out the [guide](http://vuejs-templates.github.io/webpack/) and [docs for vue-loader](http://vuejs.github.io/vue-loader).

#Atualizar /Vendor do webservice
composer update -> dentro da pasta webservice

#Aulas
 Aula 3: Criar projeto com vue cli
 vue init webpack social

 Aula 5: Diretorio do projeto - como é renderizado os componentes Vue - primeiro componente - Home
 Aula 6: Exemplo com script externo - Diretorio Static
 Aula 7: Codigo de produção - Diretorio dist
 npm run buid

 Aula 8: Configurando Materialize
 Aula 9: Configurando AdminLTE - Não configurei, pois é parecido com o Materialize
 Aula 10: Componente NavBar
 Aula 11: Componente Footer
 Aula 12: Sistema de Grid - Componente
 Aula 13: Componente Menu Lateral
 Aula 14 e 15: Componente Conteudo - CardConteudoVue
 Aula 16: Componente Detalhe Conteudo
 Aula 17 e 18: Componente para Publicar Conteudo
 Aula 19: Sistema de Templates
 Aula 20: Organizando com Slots
 Aula 21: Organizando Navbar e links de navegação
 Aula 22: URLs amigáveis no Vue JS
    https://router.vuejs.org/guide/essentials/history-mode.html#example-server-configurations

    .htaccess na pasta dist
    <IfModule mod_rewrite.c>
      RewriteEngine On
      RewriteBase /
      RewriteRule ^index\.html$ - [L]
      RewriteCond %{REQUEST_FILENAME} !-f
      RewriteCond %{REQUEST_FILENAME} !-d
      RewriteRule . /index.html [L]
    </IfModule>

 Aula 23: Formularios de Login e Cadastro de usuarios
 Aula 24: URL amigavel para Formularios de Login e Cadastro de usuarios
 Aula 25: Instalando o Laravel - API
  i) instalar laravel:
     - composer create-project --prefer-dist laravel/laravel webservice "5.6.*"
  ii) composer require laravel/passport
  iii) configurar banco de dados ... (database.sqlite)
     - editar .env
  iv) php artisan migrate
  v) php artisan passport:install
  vi) colocar no model User:
    use Laravel\Passport\HasApiTokens;
    use HasApiTokens, Notifiable; // Threats
  vii) alterar o config/auth
    'api' => [
      'driver' => 'passport',
      'provider' => 'users',
    ],

  Aula 26: Configurando Autenticacao Via Token
  Aula 27: Usando Postman
    - criar rotas de login e cadastro
  Aula 28: Criando Cadastro API
  Aula 29: Retornando o token no cadastro
  Aula 30: Validacao do cadastro API
  Aula 31: Traduzindo erro de Validacao do cadastro API
  Aula 32: Metodo Login API
  Aula 33: HTTP com Axios no VueJs
    - npm install axios --save (https://alligator.io/vuejs/rest-api-axios/) - dentro do diretorio social
    - import axios from 'axios';
    - axios.post(`http://jsonplaceholder.typicode.com/posts`, {
            body: this.postBody
          })
          .then(response => {})
          .catch(e => {
            this.errors.push(e)
          })
    -- no momento de testar localmente, será mostrado um erro. Instale um plugin no navegador para habilitar Croos- Origin (Allow-Control-Allow-Origin extension)
  Aula 34: Retornando Login
  Aula 35: Exibindo os erros no Login
  Aula 36: Preparando sistema login - Parte I
  Aula 37: Preparando sistema login - Parte II
  Aula 38: Implementando o Cadastro
  Aula 39: Tela de Perfil parte I
  Aula 40: Tela de Perfil parte II
  Aula 41: Tela de Perfil parte III
  Aula 42: Atualizando dados do perfil
  Aula 43: Adicionando atributo imagem no perfil
    php artisan make:migration add_imagem_table_users --table=users
  Aula 44: Preparando o campo imagem no Vue Js
  Aula 45: Enviando imagem para o servidor
  Aula 46: Deletando imagens antigas
  Aula 47: Validação de imagem Base64
  Aula 47: Validação de imagem Base64
  Aula 48: Dados do usuario na Tela Principal
  Aula 49: Imagem padrão e criando um Controller
  Aula 50: Passando a logica para Controller
  Aula 51: Configurando o CORS no Laravel
  Aula 52: Modelando o banco de dados
  Aula 53: Definindo as migracoes
  Aula 54: Definindo os relacionamentos
  Aula 55: Modelo de como Adicionar Conteudos
  Aula 56: Modelo de como Adicionar Amigos
  Aula 57: Modelo de como Adicionar Curtidas e Comentários
  Aula 58: Definindo instância para Axios e URL da API
  Aula 59: Padronizando os retornos da API
  Aula 60: Formulario para Publicar Conteudo
  Aula 61: Adicionar Conteudo Parte I
  Aula 62: Adicionar Conteudo Parte II
  Aula 63: Introdução ao Vuex
    npm install vuex --save
  Aula 64: Centralizando o Sistema de Login
  Aula 65: Otimizando o acesso aos dados do usuario
  Aula 66: Listando os conteudos
  Aula 67: Corrigindo erro no cadastro de perfil
  Aula 68: Publicando Conteudo
  Aula 69: Listando Conteudo com Vuex
  Aula 70: Validação e Lógica para Exibir Conteudos
  Aula 71: Iniciando o sistema de curtir
  Aula 72: Curtindo o conteudo
  Aula 73: Finalizando o sistema de curtir
  Aula 74: Iniciando a lógica de comentarios
  Aula 75: Quantidade de comentarios do conteudo
  Aula 76: Exibindo comentarios
  Aula 77: Nome e Imagem do Usuário no comentario
  Aula 78: Formatando Data e Hora de Conteudos e Comentarios
  Aula 79: Cadastro de Comentarios
  Aula 80: Paginação com Vuejs e Laravel
  Aula 81: Rolagem Infinita
  Aula 82: Corrigindo erro na Publicação de Conteudo
  Aula 83: Dica com o tinker (*)
  Aula 84: Criando Rota para Página de Usuario
  Aula 85: Criando Rota para Página de Usuario
  Aula 86: Exibindo a imagem do dono da página
  Aula 87: Links para páginas
  Aula 88: Aplicando um Slug na URL
    npm install slug --save

  **Erro ao executar npm run dev "cannot destructure property compile of 'undefined' or 'null'" -
    npm install --save-dev webpack-dev-server@2.9.7

  Aula 89: Corrigindo erros e Botao Seguir
  Aula 90: Metodo Seguir
  Aula 91: Requisição para Seguir Amigo
  Aula 92: Esconder o Botao Seguir
  Aula 93: Lista de Amigos
  Aula 94: Listando Amigos na Home
  Aula 95: Listando Amigos na Pagina
  Aula 96: Finalizando Sistema de Amigos
  Aula 97: Testando a Aplicacao
  Aula 98: Lista de Seguidores
  Aula 99: Lista de Seguidores
  Aula 100: Consideracoes finais
      Criar uma página para:
    - Listar todos os conteudos dos usuarios para poder segui-los
    - Trazer os conteudos mais curtidos ou comentados
    - Buscar por usuarios/conteudos
