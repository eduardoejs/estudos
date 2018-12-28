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
