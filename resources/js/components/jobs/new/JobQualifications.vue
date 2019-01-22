<template>
  <v-card class="mb-2">
    <!-- <v-textarea v-model="job.description" name="description" box label="Description" auto-grow></v-textarea>
    <v-textarea v-model="job.qualifications" name="qualifications" :rules="qualificationsRules" box label="Qualifications" auto-grow requried></v-textarea>
    <v-textarea v-model="job.responsibilities" name="responsibilities" box label="Responsibilities" auto-grow></v-textarea> -->

    <v-subheader>Job Description</v-subheader>
    <editor v-model="job.description"></editor>

    <v-subheader>Job Qualifications</v-subheader>
    <editor v-model="job.qualifications"></editor>

    <v-subheader>Job Responsibilities</v-subheader>
    <editor v-model="job.responsibilities"></editor>
  </v-card>      
</template>

<script>
import VueTrix from 'vue-trix'
import norms from '../../../helpers/norms'

export default {
    props: ['job'],
    components: {'editor': VueTrix},
    data() {
        return {
            qualificationsRules: norms.inputFields('Job Qualifications is required')
        }
    }
}
</script>