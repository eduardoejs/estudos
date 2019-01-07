<template>
<div class="row">
  <grid-vue class="input-field" tamanho="12">
    <input type="text" v-model="conteudo.titulo">
    <textarea v-if="conteudo.titulo" placeholder="Conteúdo" :id="idTextarea" v-model="conteudo.texto" class="materialize-textarea"></textarea>
    <input v-if="conteudo.titulo && conteudo.texto" placeholder="Link" type="text" v-model="conteudo.link">
    <input v-if="conteudo.titulo && conteudo.texto" placeholder="URL da Imagem" type="text" v-model="conteudo.imagem">
    <label :for="idTextarea">O que está acontecendo?</label>
  </grid-vue>
  <p v-if="conteudo.titulo && conteudo.texto" class="right-align">
    <!-- Um componente herda uma div -->
    <button v-on:click="adicionaConteudo()" class="btn waves-effect waves-light">Publicar</button>
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
  },
  methods:{
    adicionaConteudo(){
      console.log(this.conteudo)
      this.$http.post(this.$urlAPI + 'conteudo/adicionar', this.conteudo /*se ocorrer erro: titulo: this.conteudo.titulo, ...*/,
      {"headers": {"authorization":"Bearer " + this.$store.getters.getToken}}).then(response => {
        if(response.data.status){
          console.log(response.data.conteudos)
          this.conteudo = {titulo:'', texto:'', link:'', imagem:''}
          this.$store.commit('setConteudoLinhaTempo',response.data.conteudos.data)
        }
      }).catch(e => {
        console.log(e)
        alert('Erro! Tente novamente mais tarde!')
      })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
