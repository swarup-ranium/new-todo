import Vue from "vue";
import Vuex from "vuex";
import Auth from "./auth/index";
import createTask from "./task-category/create";

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    createTask: createTask,
    auth: Auth,
  },
});

export default store;
