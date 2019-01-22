<template>
    <v-flex xs12>
        <job-lists :color="'blue'" :icon="icon" :title="title" :url="'/api/jobs?page='"></job-lists>
    </v-flex>
</template>

<script>
import JobLists from '../_templates/job/Lists.vue'
import { loader } from '../../mixins'

export default {
    name: "jobs-lists",
    mixins: [loader],
    components: { 
        "job-lists": JobLists 
    },
    data() {
        return {
            title: 'Recent Jobs',
            icon: 'mdi-briefcase-outline',
        }
    },
    mounted() {
        let params = { url: '/api/jobs'}
        this.$store
            .dispatch("FETCH_JOBS", params)
            .then(() => {
                this.loader.hide()
            })
    }
}
</script>
