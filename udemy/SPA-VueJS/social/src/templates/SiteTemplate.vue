<template>
  <span>
    <!--<img src="./assets/logo.png">-->
    <header>
      <navbar-vue cor="" url="/" logo="Social">
        <li v-if="!usuario"><router-link to="/login">Login</router-link></li>
        <li v-if="!usuario"><router-link to="/cadastro">Cadastre-se</router-link></li>
        <li v-if="usuario"><router-link to="/perfil">{{usuario.name}}</router-link></li>
        <li v-if="usuario"><a v-on:click="logout()">Logout</a></li>
      </navbar-vue>
    </header>

    <main>
      <div class="container">

        <div class="row">
          <grid-vue tamanho='4'>

            <slot name="menu-lateral" />

            <card-menu-vue>
              <slot name="amigos" />
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
  data(){
    return {
      usuario: false
    }
  },
  components:{
    NavbarVue,
    FooterVue,
    GridVue,
    CardMenuVue,
  },
  created(){
    //console.log('created()')
    let usuario = this.$store.getters.getUsuario
    if(usuario){
      this.usuario = this.$store.getters.getUsuario
    }else{
      this.$router.push('/login')
    }
  },
  methods:{
    logout(){
      this.$store.commit('setUsuario',null)
      sessionStorage.clear();
      this.usuario = false;
      this.$router.push('/login')
    }
  }
}
</script>

<style>

</style>
