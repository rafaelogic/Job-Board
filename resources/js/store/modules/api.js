let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

// I am a big fan of CRUD that's why I chose to its term
export default {
    mutations: {
        UPDATE(state, payload) {
            state.unshift(payload)
        }
    },

    actions: {
        PUBLIC_CREATE(context, params) {
            return axios.post(params.url, params.data, {_token: csrf })
        },

        CREATE(context, params) {
            return axios.post(params.url, params.data, {
                headers: {
                    Authorization: `Bearer ${
                        context.getters.currentUser.token
                    }`
                }
            })
        },

        READ(context, param) {
            return axios.get(param.url, {_token: csrf})
        },

        UPDATE(context, params) {
            return axios.patch(params.url, params.data, {
                headers: {
                    Authorization: `Bearer ${
                        context.getters.currentUser.token
                    }`
                }
            })
        },

        DELETE(context, param) {
            return axios.delete(param.url, {
                headers: {
                    Authorization: `Bearer ${context.getters.currentUser.token}`
                }
            })
        }
    }
}