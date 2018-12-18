<template>
  <span>
    <!--<img src="./assets/logo.png">-->
    <header>
      <navbar-vue cor="" url="/" logo="Social">
        <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/login">Login</router-link></li>
        <li><router-link to="/cadastro">Cadastre-se</router-link></li>
      </navbar-vue>
    </header>

    <main>
      <div class="container">

        <div class="row">
          <grid-vue tamanho='4'>

            <slot name="menu-lateral" />

            <card-menu-vue>
              <h5>Fix Template</h5>
            </card-menu-vue>

          </grid-vue>
          <grid-vue tamanho='8'>

            <slot name="conteudo"/>

          </grid-vue>
        </div>
      </div>
    </main>

    <footer>
      <footer-vue cor="green darken-3" logo="Social" descricao="Teste de descrição">
        <li><a class="grey-text text-lighten-3" href="#!">Home</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
      </footer-vue>
    </footer>

  </span>
</template>

<script>

import NavbarVue from '@/components/layouts/NavbarVue'
import FooterVue from '@/components/layouts/FooterVue'
import GridVue from '@/components/layouts/GridVue'
import CardMenuVue from '@/components/layouts/CardMenuVue'

export default {
  name: 'SiteTemplate',
  components:{
    NavbarVue,
    FooterVue,
    GridVue,
    CardMenuVue,
  }
}
</script>

<style>

</style>
