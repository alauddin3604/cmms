import { createStore } from 'vuex'
import actions from './actions'

const store = createStore({
    state: {},
    actions() {
        return actions
    }

})

export default store