<template>

    <v-card class="mb-2">
        <v-text-field v-model="job.title" label="Job Title"
                        :rules="titleRules" required></v-text-field>
        <v-text-field v-model="job.location" label="Location"
                        :rules="locationRules" required></v-text-field>

        <v-layout row wrap>
            <v-flex md4>
            <v-select class="mr-2" v-model="job.category_id"
                        :items="categories" item-text="name" item-value="id" 
                        :rules="categoryRules" label="Category" required>        
            </v-select>
            </v-flex>
            
            <v-flex md4>
            <v-select  class="mr-2" v-model="job.city_id" 
                        :items="cities" item-text="name" item-value="id" 
                        :rules="cityRules" label="City" required>
            </v-select>
            </v-flex>
            
            <v-flex md4>
            <v-select v-model="job.job_type_id" 
                        :items="job_types" item-text="name" item-value="id" 
                        :rules="jobTypeRules" label="Job Type" required>
            </v-select>
            </v-flex>  
        </v-layout>

        <!-- <v-textarea v-model="job.howtoapply" name="howtoapply" box label="How To Apply" auto-grow></v-textarea> -->
        <v-subheader>How To Apply</v-subheader>
        <editor v-model="job.howtoapply"></editor>
    </v-card>

</template>
<script>
import VueTrix from 'vue-trix'
import norms from '../../../helpers/norms'

export default {
    props: ['job', 'categories', 'cities', 'job_types'],
    components: {'editor': VueTrix},
    data() {
        return {
            titleRules: norms.inputFields('Job Title'),
            locationRules: norms.inputFields('Job Location'),
            categoryRules: norms.inputFields('Job Category'),
            cityRules: norms.inputFields('Job City'),
            jobTypeRules: norms.inputFields('Job Type'),
        }
    }
}
</script>