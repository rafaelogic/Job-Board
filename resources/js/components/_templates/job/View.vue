<template>
    <v-card v-if="job && job.category && job.city && job.company && job.job_type">
        <v-card-title class="display-1 blue--text"><span class="text-xs-center">{{job.title}}</span></v-card-title>
        <v-card-text>at <strong>{{job.company.name}}</strong> in <strong>{{job.location}}</strong></v-card-text>

        <v-divider></v-divider>

        <v-container grid-list-md fluid>
            <v-layout row wrap>
                <v-flex xs12 md8>
                    <v-card flat>
                    <v-layout class="mt-2 mb-2" row wrap fill-height v-if="checkForEmptyField(job.company.about)">
                        <h2 class="blue--text headline">About Company</h2>
                        <v-spacer></v-spacer>
                        <p v-html="job.company.about"></p>
                    </v-layout>

                        <v-spacer></v-spacer>
                        <v-layout class="mt-2" row wrap fill-height v-if="checkForEmptyField(job.description)">
                            <h2 class="blue--text headline">Job Description</h2>
                            <p v-html="job.description"></p>
                        </v-layout>

                        <v-spacer></v-spacer>
                        <v-layout class="mt-2" row wrap fill-height v-if="checkForEmptyField(job.qualifications)">
                            <h2 class="blue--text headline">Job Qualifications</h2>
                            <p v-html="job.qualifications"></p>
                        </v-layout>

                        <v-spacer></v-spacer>

                        <v-layout row wrap fill-height v-if="checkForEmptyField(job.responsibilities)">
                            <h2 class="blue--text headline">Job Responsibilities</h2>
                            <p v-html="job.responsibilities"></p>
                        </v-layout>
                    </v-card>
                </v-flex>
                 <v-flex xs12 md4>
                    <v-card flat hover>
                    <h3 :class="job.job_type.class">
                        <v-chip color="transparent" text-color="white">
                            <v-avatar :class="job.job_type.class+' darken-4'">{{job.job_type.name.charAt(0)}}</v-avatar>{{job.job_type.name}}
                        </v-chip>
                        </h3>
                        <h3 class="orange">
                        <v-chip color="transparent" text-color="white">
                            <v-avatar class="orange darken-4">
                            <v-icon>mdi-calendar-edit</v-icon>
                            </v-avatar>
                            {{job.created_at}}
                        </v-chip>
                        </h3>

                        <h3 class="purple">
                        <v-chip color="transparent" text-color="white">
                            <v-avatar class="purple darken-3">
                            <v-icon>mdi-shape</v-icon>
                            </v-avatar>
                            {{job.category.name}}
                        </v-chip>
                        </h3>
                        <h3 class="blue">
                        <v-chip color="transparent" text-color="white">
                            <v-avatar class="blue darken-4">
                            <v-icon>mdi-map-marker</v-icon>
                            </v-avatar>
                            {{job.city.name}}
                        </v-chip>
                        </h3>
                        <v-spacer></v-spacer>
                        <v-layout row wrap class="mt-2" fill-height>
                            <h2 class="blue--text">How to apply</h2>
                            <p v-html="job.howtoapply"></p>
                        </v-layout>
                        <v-divider></v-divider>
                        <div class="text-md-right" v-if="!checkForEmptyField(job.howtoapply)">
                            <v-btn class="mt-3 mb-1" color="primary" round dark>Apply now</v-btn>
                        </div>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-card>
</template>

<script>
import { mapGetters } from 'vuex'
import checker from '../../../mixins/checker'

export default {
    name: "view-job",
    props: ['job'],
    mixins: [checker]
}
</script>
