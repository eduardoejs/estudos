<template>
  <site-template>

    <span slot="menu-lateral">
      <card-menu-vue>
        <img :src="usuario.imagem" :alt="usuario.name" class="responsive-img">
        </card-menu-vue>
    </span>

    <span slot="conteudo">

      <h2>Perfil do usuário</h2>
      <input type="text" placeholder="Nome" v-model="name">
      <input type="email" placeholder="E-Mail" v-model="email">
      <div class="file-field input-field">
        <div class="btn">
          <span>Imagem</span>
          <input type="file" v-on:change="salvaImagem">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
      </div>
      <input type="password" placeholder="Senha" v-model="password">
      <input type="password" placeholder="Confirme sua senha" v-model="password_confirmation">
      <button class="btn" v-on:click="perfil()">Atualizar</button>

    </span>

  </site-template>
</template>

<script>

import SiteTemplate from '@/templates/SiteTemplate'
import CardMenuVue from '@/components/layouts/CardMenuVue'

export default {
  name: 'Perfil',
  data () {
    return {
      usuario:false,
      name:'',
      email:'',
      password:'',
      password_confirmation:'',
      imagem:''
    }
  },
  created(){
    let usuario = this.$store.getters.getUsuario
    if(usuario){
      this.usuario = this.$store.getters.getUsuario
      this.name = this.usuario.name
      this.email = this.usuario.email
    }
  },
  components:{
    SiteTemplate,
    CardMenuVue
  },
  methods:{
    salvaImagem(e){
      let arquivo = e.target.files || e.dataTransfer.files;
      if(!arquivo.length){
        return;
      }

      let reader = new FileReader();
      reader.onloadend = (e) => {
        this.imagem = e.target.result;
      };

      reader.readAsDataURL(arquivo[0]);

      //console.log(this.imagem)
    },
    perfil(){
      //console.log('perfil method');
        this.$http.put(this.$urlAPI + 'perfil', {
            name: this.name,
            email: this.email,
            imagem: this.imagem,
            password: this.password,
            password_confirmation: this.password_confirmation,
          }, {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
      .then(response => {

        //console.log(response)

        if(response.data.status){
          //se existir um token no response.data -> Login com sucesso
          console.log(response.data)
          this.usuario = response.data.usuario
          this.$store.commit('setUsuario',response.data.usuario)
          sessionStorage.setItem('usuario',JSON.stringify(this.usuario))
          alert('Perfil atualizado!')

        }else if(response.data.status == false && response.data.validacao){
          //erros de validacao
          //console.log('erro de validacao')
          let errors = '';

          //converte para um objeto de valores o que vem do response.data
          for(let error of Object.values(response.data.erros)){
            errors += error + " "
          }
          alert(errors)
        }
      })
      .catch(e => {
        //this.errors.push(e)
        console.log(e)
        alert('Tente novamente mais tarde!')
      })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
