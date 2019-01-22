import axios from 'axios'

export function initialize(store, router) {

  router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth)
    const currentUser = store.state.login.currentUser

    if(requiresAuth && !currentUser) {
        next('/login')
    } else if (to.path == '/login' && currentUser) {
        next('/')
    } else {
        next()
    }
  })

  axios.interceptors.response.use(null, (error) => {
    if(error.response.status == 401) {
        store.commit('LOGOUT')
        router.push('/login')
    }
    return Promise.reject(error)
  })

}
