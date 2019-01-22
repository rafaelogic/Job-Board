<template>
  <div>
    <v-alert v-model="alert.isActive" :type="alert.type" transition="scale-transition" dismissible>
      {{ alert.content }}
    </v-alert>
  </div>
</template>

<script>
export default {
    props: ['alert']
}
</script>

