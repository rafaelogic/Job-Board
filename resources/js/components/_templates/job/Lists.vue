<template>
<div v-if="jobs.length" app>
    <v-layout row wrap ref="jobsLayout">
        <v-flex xs12 class="mb-2">
            <h1 class="display-1 text-center">
                <v-icon :color="color" size="42">{{icon}}</v-icon> {{title}}
            </h1>
            <hr>
        </v-flex>
        <v-flex xs12>
            <v-card>
                <v-flex xs12 v-for="job in jobs" :key="job.id">
                    <v-card class="mb-2" :to="`/${job.slug}`" hover flat>
                        <v-card-title class="title font-weight-light blue--text">{{job.title}}</v-card-title>
                        <v-card-text class="font-weight-light mt-0 pt-0">at <strong>{{job.company.name}}</strong> in <strong>{{job.location}}</strong> </v-card-text>
                        <v-card-text class="font-weight-light mt-0 pt-0 text-truncate" v-html="job.qualifications"></v-card-text>
                        <div :class="job.job_type.class">
                            <v-chip :color="job.job_type.class" text-color="white">
                                <span class="mr-4"><v-avatar :class="job.job_type.class + ' darken-4'">{{job.job_type.name.charAt(0)}}</v-avatar>{{job.job_type.name}}</span>
                                <v-avatar :class="job.job_type.class + ' darken-4'"><v-icon>mdi-calendar</v-icon></v-avatar>{{job.created_at}}
                            </v-chip>
                        </div>
                    </v-card>
                </v-flex>
            </v-card>

            <div class="text-xs-center">
                <v-pagination v-model="current" :length="paginationLength" :total-visible="5" @input="changePage(url)" circle></v-pagination>
            </div>
        </v-flex>
    </v-layout>
</div>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'
import { pagination } from '../../../mixins'

export default {
    props: ['color', 'icon', 'title', 'url'],
    mixins: [pagination],
    computed: {
        ...mapGetters({
            jobs: "jobs",
            paginationLength: "paginationLength"
        })
    },
}
</script>
