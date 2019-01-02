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
      this.$http.post(this.$urlAPI + 'login', {
            email: this.usuario.email,
            password: this.usuario.password,
          })
      .then(response => {

        //console.log(response)

        if(response.data.status){
          //se existir um token no response.data -> Login com sucesso
          console.log('login com sucesso')
          sessionStorage.setItem('usuario',JSON.stringify(response.data.usuario))
          this.$router.push('/');

        }else if(response.data.status == false && response.data.validacao){
          console.log('login erro de validacao')
          let errors = '';

          //converte para um objeto de valores o que vem do response.data
          for(let error of Object.values(response.data.erros)){
            errors += error + " "
          }
          alert(errors)
        }else{
          //se existir um status false no response.data -> Login não existe, inválido
          console.log('login inválido')
          alert('Login inválido!')
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
