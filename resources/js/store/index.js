import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import auth from '@/store/auth'
import braintree from '@/store/braintree'

const store = createStore({
    plugins:[
        createPersistedState()
    ],
    modules:{
        auth,
        braintree
    }
})

export default store