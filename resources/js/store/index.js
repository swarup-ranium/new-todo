import Vue from "vue";
import Vuex from "vuex";
import Register from "./auth/register";
import Login from "./auth/login";

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    register: Register,
    login: Login,
  },
});

export default store;
