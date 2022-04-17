import { createStore } from 'vuex';
import createPersistedState from "vuex-persistedstate";
import order from './modules/order';

export default createStore({
    state: {
    },
    mutations: {
    },
    actions: {
    },
    modules: {
        order
    },
    plugins: [createPersistedState()]
});
