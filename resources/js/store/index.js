import Vue from "vue";
import Vuex from "vuex";
import Auth from "./auth/index";
import Task from "./task/index";
import TaskCategory from "./task-category/index";

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    task: Task,
    auth: Auth,
    taskCategory: TaskCategory,
  },
});

export default store;
