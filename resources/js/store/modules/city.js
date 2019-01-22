export default {
    state: {
        city: [],
        cities: [],
    },

    getters: {
        city(state) {
            return state.city
        },
        cities(state) {
            return state.cities
        }
    },

    mutations: {
        CITY(state, payload) {
            state.city = payload
        },
        CITIES(state, payload) {
            state.cities = payload
        },

    },

    actions: {
        FETCH_CITIES(context) {
            let param = {url: '/api/cities'}
            context.dispatch('READ', param).then(response => {
                context.commit('CITIES', response.data.cities)
            })
        }
    }
}