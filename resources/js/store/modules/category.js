export default {
    state: {
        category: [],
        categories: [],
    },

    getters: {
        category(state) {
            return state.category
        },
        categories(state) {
            return state.categories
        }
    },

    mutations: {
        CATEGORY(state, payload) {
            state.category = payload
        },
        CATEGORIES(state, payload) {
            state.categories = payload
        },
    },

    actions: {
        FETCH_CATEGORIES(context) {
            let param = {url: '/api/categories'}
            context.dispatch('READ', param).then(response => {
                context.commit('CATEGORIES', response.data.categories)
            })
        },
    }
}