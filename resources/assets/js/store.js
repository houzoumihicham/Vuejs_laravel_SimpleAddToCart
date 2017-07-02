import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        prods: []
    },
    getters: {
        all_prods(state) {
            return state.prods
        },
        all_prods_count(state) {
            return state.prods.length
        }
    },
    mutations: {
        add_prod(state, prod) {
            state.prods.push(prod)
        },
        remove_product(state,prod){

            state.prods.splice(state.prods.indexOf(prod), 1);
        }

    }
});