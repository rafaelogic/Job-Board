<template>
    <v-flex xs12>
        <job-view :job="job"></job-view>
    </v-flex>
</template>

<script>
import { mapGetters } from 'vuex'
import ViewJob from '../_templates/job/View.vue'

export default {
    name: "view-job",
    components: {
        'job-view': ViewJob
    },

    mounted() {
        this.$store.dispatch('FETCH_JOB', this.$route.params.slug)
    },

    computed: {
        ...mapGetters({
            job: 'job'
        })
    },
}
</script>
