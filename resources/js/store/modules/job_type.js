export default {
    state: {
        job_type: [],
        job_types: [],
    },

    getters: {
        job_type(state) {
            return state.job_type
        },
        job_types(state) {
            return state.job_types
        }
    },

    mutations: {
        JOB_TYPE(state, payload) {
            state.job_type = payload
        },
        JOB_TYPES(state, payload) {
            state.job_types = payload
        },
    },

    actions: {
        FETCH_JOB_TYPES(context) {
            let param = {url: '/api/job-types'}
            context.dispatch('READ', param).then(response => {
                context.commit('JOB_TYPES', response.data.jobTypes)
            })
        }
    }
}