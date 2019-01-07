<template>

  <site-template>

    <span slot="menu-lateral">
      <card-menu-vue>
      <div class="row valign-wrapper">
        <grid-vue tamanho='4'>
          <img :src="usuario.imagem" :alt="usuario.name" class="circle responsive-img"> <!-- notice the "circle" class -->
        </grid-vue>
        <grid-vue tamanho='8'>
          <span class="black-text">
            <h5>{{usuario.name}}</h5>
            Add the "circle" class to it to make it appear circular.
          </span>
        </grid-vue>
      </div>
      </card-menu-vue>

      <!--<card-menu-vue>
        <h3>Options</h3>
      </card-menu-vue>
      -->
    </span>

    <span slot="conteudo">
      <publicar-conteudo-vue idTextarea="textarea1" />

      <card-conteudo-vue
        perfil="https://materializecss.com/images/yuna.jpg"
        nome="Maria Silva"
        data="18/12/2018 09:45">

        <card-conteudo-detalhe-vue
          imagem="https://materializecss.com/images/sample-1.jpg"
          titulo="Card Title Test"
          texto="I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.">
        </card-conteudo-detalhe-vue>
      </card-conteudo-vue>
    </span>

  </site-template>

</template>

<script>

import SiteTemplate from '@/templates/SiteTemplate'
import CardConteudoVue from '@/components/social/CardConteudoVue'
import CardConteudoDetalheVue from '@/components/social/CardConteudoDetalheVue'
import PublicarConteudoVue from '@/components/social/PublicarConteudoVue'
import CardMenuVue from '@/components/layouts/CardMenuVue'
import GridVue from '@/components/layouts/GridVue'

export default {
  name: 'Home',
  data () {
    return {
      usuario:false
    }
  },
  created(){
    let usuario = this.$store.getters.getUsuario
    if(usuario){
      this.usuario = this.$store.getters.getUsuario
    }
  },
  components:{
    SiteTemplate,
    CardConteudoVue,
    CardConteudoDetalheVue,
    PublicarConteudoVue,
    CardMenuVue,
    GridVue
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
