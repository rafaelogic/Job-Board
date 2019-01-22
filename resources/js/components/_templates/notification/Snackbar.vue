<template>
    <v-snackbar v-model="snackbar.isActive" color="info" :multi-line="mode === 'multi-line'" :vertical="mode === 'vertical'">
      <v-icon medium dark>mdi-information-outline</v-icon> {{ snackbar.content }}
      <v-btn info flat @click="snackbar.isActive = false">Close</v-btn>
    </v-snackbar>
</template>

<script>
export default {
    props: ['snackbar'],
    data() {
        return {
            mode: ''
        }
    }
}
</script>
