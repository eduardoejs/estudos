<template>
  <login-template>

    <span slot="menu-lateral">
      <img src="http://www.springersource.com/wp-content/uploads/2018/02/9736582674_9e0db85da5_o-2.jpg" alt="social" class="responsive-img">
    </span>

    <span slot="conteudo">

      <h2>Login</h2>
      <input type="email" placeholder="E-Mail" v-model="usuario.email">
      <input type="password" placeholder="Senha" v-model="usuario.password">
      <button class="btn" v-on:click="login()">Entrar</button>
      <router-link to="/cadastro" class="btn blue">Cadastre-se</router-link>

    </span>

  </login-template>
</template>

<script>

import LoginTemplate from '@/templates/LoginTemplate'
import axios from 'axios';

export default {
  name: 'Login',
  data () {
    return {
      usuario:{email:'', password:''}
    }
  },
  components:{
    LoginTemplate
  },
  methods:{
    login(){
      console.log('login method');
      axios.post('http://127.0.0.1:8000/api/login', {
            email: this.usuario.email,
            password: this.usuario.password,
          })
      .then(response => {

        console.log(response)

        if(response.data.token){
          //se existir um token no response.data -> Login com sucesso
          console.log('login com sucesso')

        }else if(response.data.status == false){
          //se existir um status false no response.data -> Login não existe, inválido
          console.log('login inválido')

        }else{
          //erros de validacao
          console.log('login erro de validacao')

        }
      })
      .catch(e => {
        //this.errors.push(e)
        console.log(e)
      })

    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
