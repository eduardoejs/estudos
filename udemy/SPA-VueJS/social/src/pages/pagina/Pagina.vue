<template>

  <site-template>

    <span slot="menu-lateral">
      <card-menu-vue>
      <div class="row valign-wrapper">
        <grid-vue tamanho='4'>
          <router-link :to="'/pagina/' + donoPagina.id +'/' + $slug(donoPagina.name, {lower: true})">
            <img :src="donoPagina.imagem" :alt="donoPagina.name" class="circle responsive-img"> <!-- notice the "circle" class -->
          </router-link>
        </grid-vue>
        <grid-vue tamanho='8'>
          <span class="black-text">
            <router-link :to="'/pagina/' + donoPagina.id +'/' + $slug(donoPagina.name, {lower: true})">
              <h5>{{donoPagina.name}}</h5>
            </router-link>
            <button v-if="exibeBTNSeguir" @click="amigo(donoPagina.id)" class="btn">{{textoBTN}}</button>
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
  name: 'Pagina',
  data () {
    return {
      usuario:false,
      urlProximaPagina:null,
      pararScroll:false,
      donoPagina:{imagem:'',name:''},
      exibeBTNSeguir:false,
      amigos:[],
      amigosLogado:[],
      textoBTN:'Seguir'
    }
  },
  created(){
    this.atualizaPagina()
  },
  components:{
    SiteTemplate,
    CardConteudoVue,
    CardConteudoDetalheVue,
    PublicarConteudoVue,
    CardMenuVue,
    GridVue
  },
  watch:{
    '$route':'atualizaPagina'
  },
  methods:{
    atualizaPagina(){
      let usuario = this.$store.getters.getUsuario
      if(usuario){
        this.usuario = this.$store.getters.getUsuario
        this.$http.get(this.$urlAPI + 'conteudo/pagina/listar/' + this.$route.params.id, {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
        .then(response => {
          //console.log(response)
          if(response.data.status && this.$route.name == "Pagina"){
            this.$store.commit('setConteudoLinhaTempo',response.data.conteudos.data)
            this.urlProximaPagina = response.data.conteudos.next_page_url
            this.donoPagina = response.data.dono
            if(this.donoPagina.id != this.usuario.id){
              this.exibeBTNSeguir = true
            }else{
              this.exibeBTNSeguir = false
            }

            /////////
            this.$http.get(this.$urlAPI + 'usuario/lista/amigos/pagina/' + this.donoPagina.id, {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
              .then(response => {
                //console.log(response)
                if(response.data.status){
                  //console.log(response)
                  this.amigos = response.data.amigos
                  this.amigosLogado = response.data.amigosLogado
                  this.isAmigo()
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

    isAmigo(){
      for(let amigo of this.amigosLogado){
        if(amigo.id == this.donoPagina.id){
          this.textoBTN = 'Deixar de seguir'
          return
        }
      }
      this.textoBTN = 'Seguir'
    },

    amigo(id){
      console.log('id: ' + id)
      this.$http.post(this.$urlAPI+'usuario/amigo',{id: id},
      {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
      .then(response => {
        if(response.data.status){
          //console.log(response)
          this.amigosLogado = response.data.amigos
          this.isAmigo()
        }else{
          alert(response.data.erro)
        }
      })
      .catch(e => {
        //this.errors.push(e)
        console.log(e)
        alert('Tente novamente mais tarde!')
      })
    },

    carregaPaginacao(){

      if(!this.urlProximaPagina){
        return;
      }
      this.$http.get(this.urlProximaPagina, {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
      .then(response => {
        //console.log(response)
        if(response.data.status){
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
