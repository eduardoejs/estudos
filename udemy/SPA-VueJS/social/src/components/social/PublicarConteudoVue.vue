<template>
<div class="row">
  <grid-vue class="input-field" tamanho="12">
    <textarea :id="idTextarea" v-model="conteudo" class="materialize-textarea"></textarea>
    <label :for="idTextarea">O que está acontecendo?</label>
  </grid-vue>
  <p v-if="conteudo">
    <!-- Um componente herda uma div -->
    <grid-vue class="btn waves-effect waves-light" tamanho="2 offset-s10">Publicar</grid-vue>
  </p>
</div>
</template>

<script>
import GridVue from '@/components/layouts/GridVue'

export default {
  name: 'PublicarConteudoVue',
  props: ['idTextarea'],
  data () {
    return {
      conteudo:''
    }
  },
  components:{
    GridVue
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
