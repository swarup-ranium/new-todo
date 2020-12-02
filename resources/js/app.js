require("./bootstrap");

window.Vue = require("vue");
import VueRouter from "vue-router";
import VueAxios from "vue-axios";
import axios from "axios";

window.Vue.use(VueRouter);
window.Vue.use(VueAxios, axios);

import CreateTaskCategory from "./components/task-category/CreateComponent.vue";
import LoginComponent from "./components/auth/LoginComponent.vue";
import RegisterComponent from "./components/auth/RegisterComponent.vue";

const routes = [
  {
    path: "/taskCategory/create",
    component: CreateTaskCategory,
    name: "createCategory"
  }
];

Vue.component("register-component", RegisterComponent);

Vue.component("login-component", LoginComponent);

const router = new VueRouter({ mode: "history", routes });

const app = new Vue({ router: router }).$mount("#app");
