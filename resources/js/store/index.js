import Vue from "vue"
import Vuex from "vuex"

import api from "./modules/api"
import city from "./modules/city"
import category from "./modules/category"
import job from "./modules/job"
import job_type from "./modules/job_type"
import login from "./modules/login"

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        api, login, city, category, job, job_type
    }
})
