export default {
    nameFromId(arr, id) {
        var result =  arr.find(o => {
            return o.id === id 
        })
        return typeof(result) === 'object' ? result.name : "No Entry"
    },

    jobTypeColor(arr, id) {
        var result =  arr.find(o => {
            return o.id === id 
        })
        return typeof(result) === 'object' ? result.class : "black"
    },

    addBukidnon(city) {
        if(city === "No Entry") return "No Entry"
        if(city === "Other") return city

        return city + ", Bukidnon"
    }
}