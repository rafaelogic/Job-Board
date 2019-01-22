export default {
    inputFields(label) {
        return [
            v => !!v || `${label} is required`
        ]
    },
    emailFields(label) {
        return [
            v => !!v || `${label} is required`,
            v => /.+@.+/.test(v) || `${label} must be a valid email format`
        ]
    }
}