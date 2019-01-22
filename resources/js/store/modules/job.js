export default {
    state: {
        job: [],
        jobs: [],
        paginationLength : 0
    },

    getters: {
        job(state) {
            return state.job
        },

        jobs(state) {
            return state.jobs
        },
        
        paginationLength(state) {
            return state.paginationLength
        }
    },

    mutations: {
        JOB(state, payload) {
            state.job = payload
        },
        JOBS(state, payload) {
            state.jobs = payload
        },
        PAGINATION_LENGTH(state, payload) {
            state.paginationLength = payload
        }
    },

    actions: {
        ADD_JOB_PUBLIC(context, data) {
            let params = { 
                data: data,
                url: '/api/jobs'
             }
            return context.dispatch('PUBLIC_CREATE', params)
        },
        ADD_JOB(context, data) {
            let params = { 
                data: data,
                url: '/api/jobs'
             }
            return context.dispatch('CREATE', params)
        },
        FETCH_JOBS(context, params) {
            return context.dispatch('READ', params)
                          .then(response => {
                                /**
                                 * Jobs Collection reponse from quiried job itself
                                 * otherwise from category, city, etcs.
                                 */
                                if(response.data[0]){
                                    context.commit('JOBS', response.data[0].jobs)
                                    context.commit('PAGINATION_LENGTH', response.data[0].pagination.last_page)
                                }else{
                                    context.commit('JOBS', response.data.collection.jobs)
                                    context.commit('PAGINATION_LENGTH', response.data.collection.pagination.last_page)
                                }
                          })
                          .catch(err => {
                              console.log(err)
                          })
        },
        FETCH_JOBS_RESULT(context, params) {
            return context.dispatch('READ', params)
        },
        FETCH_JOB(context, slug){
            let params = { url: '/api/jobs/'+slug}
            context.dispatch('READ', params)
                   .then(response => {
                       context.commit('JOB', response.data.job)
                   })
        }
    }
}