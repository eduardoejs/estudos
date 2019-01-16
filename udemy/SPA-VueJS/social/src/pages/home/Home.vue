<template>

  <site-template>

    <span slot="menu-lateral">
      <card-menu-vue>
      <div class="row valign-wrapper">
        <grid-vue tamanho='4'>
          <router-link :to="'/pagina/' + usuario.id +'/' + $slug(usuario.name, {lower: true})">
            <img :src="usuario.imagem" :alt="usuario.name" class="circle responsive-img"> <!-- notice the "circle" class -->
          </router-link>
        </grid-vue>
        <grid-vue tamanho='8'>
          <span class="black-text">
            <router-link :to="'/pagina/' + usuario.id +'/' + $slug(usuario.name, {lower: true})">
              <h5>{{usuario.name}}</h5>
            </router-link>
          </span>
        </grid-vue>
      </div>
      </card-menu-vue>

      <!--<card-menu-vue>
        <h3>Options</h3>
      </card-menu-vue>
      -->
    </span>

    <span slot="amigos">
      <h3>Seguindo</h3>
      <router-link v-for="item in amigos" :key="item.id" :to="'/pagina/' + item.id +'/' + $slug(item.name, {lower: true})">
        <li>{{item.name}}</li>
      </router-link>
      <li v-if="!amigos.length">Nenhum usuário</li>
    </span>

    <span slot="seguidores">
      <h3>Seguidores</h3>
      <router-link v-for="item in seguidores" :key="item.id" :to="'/pagina/' + item.id +'/' + $slug(item.name, {lower: true})">
        <li>{{item.name}}</li>
      </router-link>
      <li v-if="!seguidores.length">Nenhum usuário</li>
    </span>

    <span slot="conteudo">
      <publicar-conteudo-vue idTextarea="textarea1" />

      <card-conteudo-vue v-for="item in listaConteudos" :key="item.id"
        :id="item.id"
        :totalcurtidas="item.total_curtidas"
        :comentarios="item.comentarios"
        :curtiuconteudo="item.curtiu_conteudo"
        :perfil="item.user.imagem"
        :userid="item.user.id"
        :nome="item.user.name"
        :data="item.data">

        <card-conteudo-detalhe-vue
          :imagem="item.imagem"
          :titulo="item.titulo"
          :texto="item.texto"
          :link="item.link" >
        </card-conteudo-detalhe-vue>
      </card-conteudo-vue>

      <!--<button v-if="urlProximaPagina" @click="carregaPaginacao()" class="btn blue">Mais ...</button>-->

      <div v-scroll="handleScroll">

      </div>

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
      usuario:{imagem:'', name:''},
      urlProximaPagina:null,
      pararScroll:false,
      amigos:[],
      seguidores:[]
    }
  },
  created(){
    let usuario = this.$store.getters.getUsuario
    if(usuario){
      this.usuario = this.$store.getters.getUsuario
      this.$http.get(this.$urlAPI + 'conteudo/listar', {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
      .then(response => {
        //console.log(response)
        if(response.data.status){
          this.$store.commit('setConteudoLinhaTempo',response.data.conteudos.data)
          this.urlProximaPagina = response.data.conteudos.next_page_url

          /////////
          this.$http.get(this.$urlAPI + 'usuario/lista/amigos', {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
            .then(response => {
              //console.log(response)
              if(response.data.status){
                //console.log(response)
                this.amigos = response.data.amigos
                this.seguidores = response.data.seguidores
              } else {
                alert(reponse.data.erro)
              }
            })
            .catch(e => {
              //this.errors.push(e)
              console.log(e)
              alert('Tente novamente mais tarde!')
            })
          /////////

        }
      })
      .catch(e => {
        //this.errors.push(e)
        console.log(e)
        alert('Tente novamente mais tarde!')
      })
    }
  },
  components:{
    SiteTemplate,
    CardConteudoVue,
    CardConteudoDetalheVue,
    PublicarConteudoVue,
    CardMenuVue,
    GridVue
  },
  methods:{
    carregaPaginacao(){

      if(!this.urlProximaPagina){
        return;
      }

      this.$http.get(this.urlProximaPagina, {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
      .then(response => {
        //console.log(response)
        if(response.data.status && this.$route.name == "Home"){
          this.$store.commit('setPaginacaoConteudoLinhaTempo',response.data.conteudos.data)
          this.urlProximaPagina = response.data.conteudos.next_page_url
          this.pararScroll = false
        }
      })
      .catch(e => {
        //this.errors.push(e)
        console.log(e)
        alert('Tente novamente mais tarde!')
      })
    },
    handleScroll() {
      //console.log(window.scrollY)
      //console.log(document.body.clientHeight)

      if(this.pararScroll){
        return;
      }

      if(window.scrollY >= document.body.clientHeight - 1129){
        this.pararScroll = true
        this.carregaPaginacao()
      }
    }
  },
  computed:{
    listaConteudos(){
      return this.$store.getters.getConteudoLinhaTempo
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
