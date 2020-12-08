require("./bootstrap");

window.Vue = require("vue");

import axios from "axios";
import VueAxios from "vue-axios";
import VueRouter from "vue-router";
import { routes } from "./routes.js";

window.Vue.use(VueRouter);
window.Vue.use(VueAxios, axios);

import storeData from "./store/index.js";

import LoginComponent from "./components/auth/LoginComponent.vue";
import RegisterComponent from "./components/auth/RegisterComponent.vue";

Vue.component("login-component", LoginComponent);
Vue.component("register-component", RegisterComponent);

const router = new VueRouter({ mode: "history", routes });

const app = new Vue({ router: router, store: storeData }).$mount("#app");
