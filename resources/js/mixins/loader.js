export default {
    data() {
        return {
            loader: this.$loading.show({
                loader: 'dots',
                container: this.$refs.jobsLayout
            })
        }
    }
}