<template>
  <site-template>

    <span slot="menu-lateral">
      <img src="http://www.springersource.com/wp-content/uploads/2018/02/9736582674_9e0db85da5_o-2.jpg" alt="social" class="responsive-img">
    </span>

    <span slot="conteudo">

      <h2>Perfil do usuário</h2>
      <input type="text" placeholder="Nome" v-model="usuario.name">
      <input type="email" placeholder="E-Mail" v-model="usuario.email">
      <input type="password" placeholder="Senha" v-model="usuario.password">
      <input type="password" placeholder="Confirme sua senha" v-model="usuario.password_confirmation">
      <button class="btn" v-on:click="cadastrar()">Enviar</button>
      <router-link to="/login" class="btn blue">Já tenho conta</router-link>

    </span>

  </site-template>
</template>

<script>

import SiteTemplate from '@/templates/SiteTemplate'
import axios from 'axios';

export default {
  name: 'Perfil',
  data () {
    return {
      usuario:{email:'', password:'', name:'', password_confirmation:''}
    }
  },
  components:{
    SiteTemplate
  },
  methods:{
    cadastrar(){
      console.log('cadastro method');
      axios.post('http://127.0.0.1:8000/api/cadastro', {
            name: this.usuario.name,
            email: this.usuario.email,
            password: this.usuario.password,
            password_confirmation: this.usuario.password_confirmation,
          })
      .then(response => {

        //console.log(response)

        if(response.data.token){
          //se existir um token no response.data -> Login com sucesso
          console.log('cadastro com sucesso')
          sessionStorage.setItem('usuario',JSON.stringify(response.data))
          this.$router.push('/');

        }else if(response.data.status == false){
          //se existir um status false no response.data -> cadastro inválido
          console.log('cadastro inválido')
          alert('Erro ao cadastrar!')

        }else{
          //erros de validacao
          console.log('cadastro erro de validacao')
          let errors = '';

          //converte para um objeto de valores o que vem do response.data
          for(let error of Object.values(response.data)){
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
