<template>
  <span>

    <publicar-conteudo-vue idTextarea="textarea1"></publicar-conteudo-vue>

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
</template>

<script>

import CardConteudoVue from '@/components/social/CardConteudoVue'
import CardConteudoDetalheVue from '@/components/social/CardConteudoDetalheVue'
import PublicarConteudoVue from '@/components/social/PublicarConteudoVue'

export default {
  name: 'Home',
  data () {
    return {

    }
  },
  components:{
    CardConteudoVue,
    CardConteudoDetalheVue,
    PublicarConteudoVue
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
