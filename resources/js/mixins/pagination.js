export default {
    data() {
        return {
            current: 1
        }
    },
    methods: {
        changePage(url) {
            window.scroll({top: 0, behavior: 'smooth'})
            let params = { url : url + this.current }
            this.$store.dispatch('FETCH_JOBS', params)
        }
    }
}