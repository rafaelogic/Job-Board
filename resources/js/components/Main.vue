<template>
  <v-app id="main"> 
      <router-view :key="$route.name + ($route.params.slug || '')"></router-view>
  </v-app>
</template>

<script>
export default {
    name: "main-app"
}
</script>