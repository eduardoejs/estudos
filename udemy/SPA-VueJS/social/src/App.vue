<template>
  <span>
    <!--<img src="./assets/logo.png">-->
    <header>
      <navbar-vue cor="" url="#" logo="Social"></navbar-vue>
    </header>

    <main>
      <div class="container">
        <router-view/>
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

export default {
  name: 'App',
  components:{
    NavbarVue,
    FooterVue,
  }
}
</script>

<style>

</style>
