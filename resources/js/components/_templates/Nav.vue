<template>
   <div>
        <v-navigation-drawer fixed clipped v-model="drawer" app>
        <v-list dense v-if="categories.length && cities.length && job_types.length">
            <v-subheader class="mt-1 blue--text text--darken-1">JOB TYPES</v-subheader>
            <v-list-tile v-for="job_type in job_types" :key="job_type.name" :to="`/job-type/${job_type.slug}`">
            <v-list-tile-content>
                <v-list-tile-title>
                    <v-avatar :color="job_type.class+' darken-4'" size="18">
                        <span class="white--text">{{job_type.jobs_count}}</span>
                    </v-avatar>
                    {{job_type.name}}
                </v-list-tile-title>
            </v-list-tile-content>
            </v-list-tile>

            <v-divider></v-divider>

            <v-subheader class="mt-2 blue--text text--darken-1">CATEGORIES</v-subheader>
            <div v-for="category in categories" :key="category.name">
                <v-list-tile :to="`/category/${category.slug}`" v-if="category.jobs_count > 0">
                <v-list-tile-content>
                    <v-list-tile-title>
                        <v-avatar color="blue darken-4" size="18">
                            <span class="white--text">{{category.jobs_count}}</span>
                        </v-avatar>
                        {{ category.name }}
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            </div>

            <v-divider></v-divider>

            <v-subheader class="mt-2 blue--text text--darken-1">CITIES</v-subheader>
            <div  v-for="city in cities" :key="city.name">
                <v-list-tile :to="`/city/${city.slug}`" v-if="city.jobs_count > 0">
                <v-list-tile-content>
                    <v-list-tile-title>
                        <v-avatar color="blue darken-4" size="18">
                            <span class="white--text">{{city.jobs_count}}</span>
                        </v-avatar>
                        {{ city.name }}
                    </v-list-tile-title>
                </v-list-tile-content>
                </v-list-tile>
            </div>

            <v-divider></v-divider>
            
            <v-list-tile class="mt-2" :to="'/jobs'">
            <v-list-tile-action>
                <v-icon color="blue darken-1">mdi-briefcase-outline</v-icon>
            </v-list-tile-action>
            <v-list-tile-title class="grey--text text--darken-1">Browse Jobs</v-list-tile-title>
            </v-list-tile>
            <v-list-tile :to="'/jobs/new'">
            <v-list-tile-action>
                <v-icon color="blue darken-1">add_circle_outline</v-icon>
            </v-list-tile-action>
            <v-list-tile-title class="grey--text text--darken-1">Post A Job</v-list-tile-title>
            </v-list-tile>
        </v-list>
        </v-navigation-drawer>
        
        <v-toolbar color="white" dense fixed clipped-left app>
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <v-img :src="`/imgs/logo.png`" max-width="25"></v-img>
        <v-toolbar-title class="mr-5 align-center">
            <span class="title">Bukidnon Jobs</span>
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items class="hidden-sm-and-down">
            <template>
                <v-btn v-for="item in menuForGuest" :key="item.title" :to="item.path" flat>{{item.title}}</v-btn>
            </template>
            <template  v-if="currentUser">
                <v-btn @click.stop="logout()" flat>LOGOUT</v-btn>
            </template>
        </v-toolbar-items>
        </v-toolbar>
   </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    data(){
        return {
            drawer: true,
            menuForGuest: [
                {title: 'Jobs', path: '/jobs'},
                {title: 'Post a Job', path: '/jobs/new'},
            ],
        }
    },

     mounted() {
      if(!this.categories.length) this.$store.dispatch('FETCH_CATEGORIES')
      if(!this.job_types.length) this.$store.dispatch('FETCH_JOB_TYPES')
      if(!this.cities.length) this.$store.dispatch('FETCH_CITIES')
    },

    methods: {
        logout() {
            this.$store.commit("LOGOUT")
            this.$router.push("/login")
        }
    },
    
    computed: {
        ...mapGetters ({
            categories: 'categories',
            cities: 'cities',
            job_types: 'job_types',
        }),
        currentUser() {
            return this.$store.getters.currentUser
        }
    }
}
</script>
