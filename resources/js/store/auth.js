import axios from 'axios'
import router from '@/router'

export default {
    namespaced: true,
    state:{
        authenticated:false,
        paid:false,
        user:{}
    },
    getters:{
        authenticated(state){
            return state.authenticated
        },
        paid(state){
            return state.paid
        },
        user(state){
            return state.user
        }
    },
    mutations:{
        SET_AUTHENTICATED (state, value) {
            state.authenticated = value
        },
        SET_PAID (state, value) {
            state.paid = value
        },
        SET_USER (state, value) {
            state.user = value
        }
    },
    actions:{
        login({commit}){
            return axios.get('/api/user').then(({data})=>{
                commit('SET_USER',data)
                commit('SET_AUTHENTICATED',true)
                commit('SET_PAID', data.activeSubscription ? true : false)
                if (data.activeSubscription) {
                    router.push({name:'advanced'})
                } else {
                    router.push({name:'dashboard'})
                }
            }).catch(({response:{data}})=>{
                commit('SET_USER',{})
                commit('SET_AUTHENTICATED',false)
                commit('SET_PAID',false)
            })
        },
        logout({commit}){
            commit('SET_USER',{})
            commit('SET_AUTHENTICATED',false)
            commit('SET_PAID',false)
        }
    }
}