<template>
  <div>
    <!--<img src="./assets/logo.png">-->

    <navbar-vue cor="" url="#" logo="Social"></navbar-vue>

    <router-view/>
  </div>
</template>

<script>

import NavbarVue from '@/components/layouts/NavbarVue'

export default {
  name: 'App',
  components:{
    NavbarVue,
  }
}
</script>

<style>

</style>
