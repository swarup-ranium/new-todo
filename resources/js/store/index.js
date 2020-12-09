import Vue from "vue";
import Vuex from "vuex";
import Auth from "./auth/index";
import TaskCategory from "./task-category/index";

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    taskCategory: TaskCategory,
    auth: Auth,
  },
});

export default store;
