require("./bootstrap");

window.Vue = require("vue");
import VueRouter from "vue-router";
import VueAxios from "vue-axios";
import axios from "axios";

window.Vue.use(VueRouter);
window.Vue.use(VueAxios, axios);

import LoginComponent from "./components/LoginComponent.vue";

import RegisterComponent from "./components/RegisterComponent.vue";

const routes = [
    {
        path: "/api/vue",
        component: LoginComponent,
        name: "loginComponent"
    }
];

Vue.component("register-component", RegisterComponent);

Vue.component("login-component", LoginComponent);

const router = new VueRouter({ mode: "history", routes });

const app = new Vue({ router }).$mount("#app");
