import Vue from "vue";
import Vuex from "vuex";
import Login from "./auth/login";
import Register from "./auth/register";
import createTask from "./task-category/create";

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    register: Register,
    login: Login,
    createTask: createTask,
  },
});

export default store;
