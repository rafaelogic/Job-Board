<template>
<v-flex xs12 id="jobs-main">
    <nav-bar></nav-bar>

    <v-content>
      <v-container>
        <router-view></router-view>
      </v-container>
    </v-content>
</v-flex>
</template>

<script>
    import Nav from '../_templates/Nav.vue'

    export default {
        name: 'jobs',
        components: {
            'nav-bar': Nav
        },
    }
</script>
<style>
#jobs-main {
    overflow: hidden !important;
}
</style>
