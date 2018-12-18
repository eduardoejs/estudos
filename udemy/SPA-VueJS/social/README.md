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
  iii) configurar banco de dados ...
     - editar .env
  iv) php artisan migrate
  v) php artisan passport: install
  vi) colocar no model User:
    use Laravel\Passport\HasApiTokens;
    use HasApiToken, Notifiable; // Threats
  vii) alterar o config/auth
    'api' => [
      'driver' => 'passport',
      'provider' => 'users',
    ],
