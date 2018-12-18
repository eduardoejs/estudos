<template>
  <login-template>

    <span slot="menu-lateral">
      <img src="http://www.springersource.com/wp-content/uploads/2018/02/9736582674_9e0db85da5_o-2.jpg" alt="social" class="responsive-img">
    </span>

    <span slot="conteudo">
      <h2>Login</h2>

      <input type="email" placeholder="E-Mail" value="">
      <input type="password" placeholder="Senha" value="">
      <button type="button" class="btn">Entrar</button>
    </span>

  </login-template>
</template>

<script>

import LoginTemplate from '@/templates/LoginTemplate'


export default {
  name: 'Login',
  data () {
    return {

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
