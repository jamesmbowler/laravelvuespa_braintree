import axios from 'axios'
import router from '@/router'

export default {
    namespaced: true,
    state:{
        clientToken:{}
    },
    getters:{
        clientToken(state){
            return state.clientToken
        }
    },
    mutations:{
        SET_CLIENT_TOKEN (state, value) {
            state.clientToken = value
        }
    }
}