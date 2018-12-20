<template>
  <site-template>

    <span slot="menu-lateral">
      <card-menu-vue>
        <img src="http://www.springersource.com/wp-content/uploads/2018/02/9736582674_9e0db85da5_o-2.jpg" alt="social" class="responsive-img">
        </card-menu-vue>
    </span>

    <span slot="conteudo">

      <h2>Perfil do usuário</h2>
      <input type="text" placeholder="Nome" v-model="name">
      <input type="email" placeholder="E-Mail" v-model="email">
      <div class="file-field input-field">
        <div class="btn">
          <span>Imagem</span>
          <input type="file">
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
import axios from 'axios';

export default {
  name: 'Perfil',
  data () {
    return {
      usuario:false,
      name:'',
      email:'',
      password:'',
      password_confirmation:''
    }
  },
  created(){
    let usuario = sessionStorage.getItem('usuario')
    if(usuario){
      this.usuario = JSON.parse(usuario)
      this.name = this.usuario.name
      this.email = this.usuario.email
    }
  },
  components:{
    SiteTemplate,
    CardMenuVue
  },
  methods:{
    perfil(){
      console.log('perfil method');
      axios.put('http://127.0.0.1:8000/api/perfil', {
            name: this.usuario.name,
            email: this.usuario.email,
            password: this.usuario.password,
            password_confirmation: this.usuario.password_confirmation,
          }, {"headers":{"authorization":"Bearer "+this.usuario.token}})
      .then(response => {

        //console.log(response)

        //se existir um token no response.data -> Login com sucesso
        console.log(response.data)

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
