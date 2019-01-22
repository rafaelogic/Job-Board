export default {
    methods: {
        checkForEmptyField(val) {
            return typeof(val) != 'undefined' && val != "" && val != null  ? true:false
        }
    }
}