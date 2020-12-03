require("./bootstrap");

window.Vue = require("vue");

import axios from "axios";
import VueAxios from "vue-axios";
import VueRouter from "vue-router";

window.Vue.use(VueRouter);
window.Vue.use(VueAxios, axios);

import CreateTask from "./components/task/CreateComponent.vue";
import LoginComponent from "./components/auth/LoginComponent.vue";
import RegisterComponent from "./components/auth/RegisterComponent.vue";
import ListTaskCategory from "./components/task-category/ListComponent.vue";
import EditTaskCategory from "./components/task-category/EditComponent.vue";
import CreateTaskCategory from "./components/task-category/CreateComponent.vue";

const routes = [
  {
    name: "createCategory",
    path: "/taskCategory/create",
    component: CreateTaskCategory,
  },
  {
    name: "listCategory",
    path: "/taskCategory/list",
    component: ListTaskCategory,
  },
  {
    name: "editCategory",
    path: "/taskCategory/edit/:id",
    component: EditTaskCategory,
  },
  {
    name: "createTask",
    path: "/createTask/create",
    component: CreateTask,
  },
];

Vue.component("login-component", LoginComponent);
Vue.component("register-component", RegisterComponent);

const router = new VueRouter({ mode: "history", routes });

const app = new Vue({ router: router }).$mount("#app");
