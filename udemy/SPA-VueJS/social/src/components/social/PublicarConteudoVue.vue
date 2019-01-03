<template>
<div class="row">
  <grid-vue class="input-field" tamanho="12">
    <input type="text" v-model="conteudo.titulo">
    <textarea v-if="conteudo.titulo" placeholder="Conteúdo" :id="idTextarea" v-model="conteudo.texto" class="materialize-textarea"></textarea>
    <input v-if="conteudo.titulo && conteudo.texto" placeholder="Link" type="text" v-model="conteudo.link">
    <input v-if="conteudo.titulo && conteudo.texto" placeholder="URL da Imagem" type="text" v-model="conteudo.imagem">
    <label :for="idTextarea">O que está acontecendo?</label>
  </grid-vue>
  <p v-if="conteudo.titulo && conteudo.texto">
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
      conteudo:{titulo:'', texto:'', link:'', imagem:''}
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
