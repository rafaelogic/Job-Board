<template>
    <v-flex xs12>
        <notifier :alert="alert"></notifier>
        <job-lists :color="color" :icon="icon" :title="title" :url="url"></job-lists>
    </v-flex>
</template>

<script>
import JobLists from '../_templates/job/Lists.vue'
import {loader, pagination} from '../../mixins'
import Alert from '../_templates/notification/Alert.vue'

export default {
    name: "jobs-list",
    mixins: [loader, pagination],
    components: { 
        "job-lists": JobLists, 
        "notifier": Alert 
    },
    data() {
        return {
            title: '',
            color: 'blue',
            icon: 'mdi-briefcase-search-outline',
            params: {},
            url: '',
            type: '',
            alert: {
              isActive: false,
              type: 'error',
              content: 'Unable to connect to the server. Please try again.'
            },
        }
    },
    mounted() {
        let slug = this.$route.params.slug
        let rx = /(?<=\/)[\w-]+(?=\/)/g
        this.type = this.$route.fullPath.match(rx)

        this.url = `/api/${this.type}/${slug}/jobs?page=`
        this.params = { url: `/api/${this.type}/${slug}/jobs`}
        
        this.fetch()
    },

    methods: {
        fetch(){
            this.$store
                .dispatch("FETCH_JOBS_RESULT", this.params)
                .then(res => {
                    if(this.type == 'category') {
                        this.title = `Jobs under ${res.data.category.name}`
                    }else if(this.type == 'city'){
                        this.title = `Jobs in ${res.data.city.name}`
                    }else if(this.type == 'job-type'){
                        this.title = `${res.data.jobType.name} Jobs`
                        this.color = res.data.jobType.class
                    }
                    this.$store.commit('JOBS', res.data.collection.jobs)
                    this.$store.commit('PAGINATION_LENGTH', res.data.collection.pagination.last_page)
                    this.loader.hide()
                })
                .catch(err => {
                    console.log(err)
                    this.alert.isActive = true
                })
        },
    },

    watch: {
        $route(to, from) {
            this.fetch()
        }
    }
}
</script>
