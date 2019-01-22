<template>
  <v-stepper v-model="e1">
      <v-stepper-header>
        <v-stepper-step :complete="e1 > 1" step="1">
          Job Info
          <small v-show="e1 == 1">All fields are required</small>  
        </v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step :complete="e1 > 2" step="2">
          Job Qualifications
          <small v-show="e1 == 2">Only 1 field is required</small>
          </v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step :complete="e1 > 3" step="3">
          Company Info
          <small v-show="e1 == 3">Fields with * are required</small>
          </v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step :complete="submitted" step="4">
          Review and Submit
          <small v-show="e1 == 4">View your job post</small>
        </v-stepper-step>
      </v-stepper-header>

      <v-form ref="form" lazy-validation>
        <v-stepper-items>
          <notifier :alert="alert"></notifier>
          
          <v-stepper-content step="1">
            <job-info :categories="categories" :cities="cities" :job="job" :job_types="job_types"></job-info>

            <v-btn color="primary" @click="e1 = 2" flat>Continue</v-btn>
            <v-btn color="danger" @click="e1 = 4" flat>View</v-btn>
          </v-stepper-content>
          
          <v-stepper-content step="2">
            <job-qualifications :job="job"></job-qualifications>

            <v-btn color="primary" @click="e1 = 3" flat>Continue</v-btn>
            <v-btn @click="e1 = 1" flat>Back</v-btn>
          </v-stepper-content>

          <v-stepper-content step="3">
            <company-info :categories="categories" :cities="cities" :company="company" :job="job" :job_types="job_types"></company-info>
            
            <v-btn color="primary" @click="viewJob()" flat> Continue</v-btn>
            <v-btn @click="e1 = 2" flat>Back</v-btn>
          </v-stepper-content>

          <v-stepper-content step="4">
            <job-view :job="info"></job-view>

            <div class="text-md-right">
              <v-btn color="primary" @click.stop="addJob()" flat> Submit</v-btn>
              <v-btn @click="e1 = 3" flat>Back</v-btn>
            </div>

            <snack-bar :snackbar="snackbar"></snack-bar>
          </v-stepper-content>
        </v-stepper-items>
      </v-form>
    </v-stepper>
</template>

<script>
import { mapGetters } from 'vuex'

import JobInfo from './JobInfo.vue'
import JobView from '../../_templates/job/View.vue'
import CompanyInfo from './CompanyInfo.vue'
import JobQualifications from './JobQualifications.vue'

import Alert from '../../_templates/notification/Alert.vue'
import SnackBar from '../../_templates/notification/Snackbar.vue'

import searcher from '../../../helpers/searcher'

export default {
    name: "new-job",
    components: {
      "job-info": JobInfo,
      "job-view": JobView,
      "company-info": CompanyInfo,
      "job-qualifications": JobQualifications,
      "notifier": Alert,
      "snack-bar": SnackBar
    },
    data() {
        return {
            e1: 0,
            submitted: false,

            job: {},
            company: {},
            info: {},

            snackbar: {
              isActive: false,
              content: "This will be the view of the page when your posted job is approved",
            },

            alert: {
              isActive: false,
              type: 'success',
              content: 'Successfully save your job.'
            },
        }
    },
   
    computed: {
      ...mapGetters ({
        categories: 'categories',
        cities: 'cities',
        job_types: 'job_types',
      })
    },
    methods: {
      addJob() {
        if(this.$refs.form.validate()) {
          let data = { job: this.$data.job, company: this.$data.company }
          this.$store
              .dispatch('ADD_JOB_PUBLIC', data)
              .then(res => {
                this.e1 = 1
                this.job = {}
                this.info = {}
                this.company = {}
                this.submitted = true
                this.alert.isActive = true
                this.snackbar.isActive = false
              })
              .catch((error) => {
                if(error) {
                  this.alert = {
                    isActive : true,
                    type: 'error',
                    content: 'Unable to submit your job. Please try again.'
                  }
                }
              })
        }else{
          this.alert = {
            isActive : true,
            type: 'error',
            content: 'Please complete all required fields before submitting your job.'
          }
        }
      },
      viewJob(){
            this.e1 = 4
            this.snackbar.isActive = true

            var city = searcher.nameFromId(this.cities, this.job.city_id)
            var category = searcher.nameFromId(this.categories, this.job.category_id)
            var job_type = searcher.nameFromId(this.job_types, this.job.job_type_id)
            var job_type_color = searcher.jobTypeColor(this.job_types, this.job.job_type_id)

            this.info = {
                created_at: 'Today',
                title: this.job.title,
                about: this.company.about,
                location: this.job.location,
                howtoapply: this.job.howtoapply,
                description: this.job.description,
                qualifications : this.job.qualifications,
                responsibilities : this.job.responsibilities,
                company: {
                  name: this.company.name,
                  about: this.company.about
                },
                city: {
                  name: searcher.addBukidnon(city)
                },
                category: {
                  name: category
                },
                job_type: {
                  name: job_type,
                  class: job_type_color
                },
            }
      },
    }
}
</script>
