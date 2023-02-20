let actions = {
    fetchData({ commit }) {
        axios.get('/api/dashboard')
            .then(res => {
                commit('FETCH_POSTS', res.data)
            }).catch(err => {
                console.log(err)
            })
    },
}

export default actions