<template>
  <login-template>

    <span slot="menu-lateral">
      <img src="http://www.springersource.com/wp-content/uploads/2018/02/9736582674_9e0db85da5_o-2.jpg" alt="social" class="responsive-img">
    </span>

    <span slot="conteudo">

      <span v-if="!cadastro">
        <h2>Login</h2>
        <input type="email" placeholder="E-Mail" value="">
        <input type="password" placeholder="Senha" value="">
        <button class="btn">Entrar</button>
        <button class="btn blue" v-on:click="cadastro = !cadastro">Cadastre-se</button>
      </span>

      <span v-if="cadastro">
        <h2>Cadastro</h2>
        <input type="text" placeholder="Nome" value="">
        <input type="email" placeholder="E-Mail" value="">
        <input type="password" placeholder="Senha" value="">
        <input type="password" placeholder="Confirme sua senha" value="">
        <button class="btn">Enviar</button>
        <button class="btn blue" v-on:click="cadastro = !cadastro">Já tenho conta</button>
      </span>

    </span>

  </login-template>
</template>

<script>

import LoginTemplate from '@/templates/LoginTemplate'


export default {
  name: 'Login',
  data () {
    return {
      cadastro: false
    }
  },
  components:{
    LoginTemplate
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
