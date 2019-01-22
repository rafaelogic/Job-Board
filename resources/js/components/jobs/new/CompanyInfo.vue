<template>
    <v-card class="mb-2">
        <v-text-field v-model="company.name" label="Company Name *"
                    :rules="nameRules" required></v-text-field>
        <v-layout>
            <v-flex xs12 md6>
                    <v-text-field v-model="company.email" label="Company Email *"
                    :rules="emailRules" required></v-text-field>
            </v-flex>
            <v-flex xs12 md6>
                 <v-select  class="mr-2" v-model="company.city_id" name="city_id" 
                        :items="cities" item-text="name" item-value="id" 
                        :rules="cityRules" label="City *" required>
                </v-select>
            </v-flex>
        </v-layout>
        
        <v-textarea v-model="company.about" name="about" box label="About" auto-grow></v-textarea>
    </v-card>  
</template>

<script>
import norms from '../../../helpers/norms'

export default {
    props: ['company', 'companies', 'cities', 'job', 'job_types'],
    data() {
        return {
            nameRules: norms.inputFields('Company Name'),
            emailRules: norms.emailFields('Company Email Address'),
            cityRules: norms.inputFields('Company City'),
        }
    }
}
</script>
