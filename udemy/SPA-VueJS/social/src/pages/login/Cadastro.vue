<template>
  <login-template>

    <span slot="menu-lateral">
      <img src="http://www.springersource.com/wp-content/uploads/2018/02/9736582674_9e0db85da5_o-2.jpg" alt="social" class="responsive-img">
    </span>

    <span slot="conteudo">

      <h2>Cadastro</h2>
      <input type="text" placeholder="Nome" value="">
      <input type="email" placeholder="E-Mail" value="">
      <input type="password" placeholder="Senha" value="">
      <input type="password" placeholder="Confirme sua senha" value="">
      <button class="btn">Enviar</button>
      <router-link to="/login" class="btn blue">Já tenho conta</router-link>

    </span>

  </login-template>
</template>

<script>

import LoginTemplate from '@/templates/LoginTemplate'


export default {
  name: 'Cadastro',
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
