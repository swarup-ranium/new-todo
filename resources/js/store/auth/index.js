const auth = {
  namespaced: true,
  state() {
    return { errors: {} };
  },
  mutations: {
    login(state, payload) {
      //   console.log(payload);
      if (payload.status == 200) {
        window.location.href = "/task";
      } else if (payload.errors !== "") {
        state.errors = payload.errors;
      }
    },
    register(state, payload) {
      console.log(payload);
      if (payload.status == 201) {
        window.location.href = "/task";
      } else if (payload.errors !== "") {
        state.errors = payload.errors;
      }
    },
  },
  actions: {
    login(context, userData) {
      axios
        .post("/login", {
          email: userData.email,
          password: userData.password,
          remember: userData.remember,
        })
        .then(function (response) {
          //   console.log(response);
          context.commit("login", response);
        })
        .catch(function (error) {
          //   console.log(error.response.data.errors);
          context.commit("login", error.response.data);
        })
        .finally(() => (this.loading = false));
    },
    register(context, userData) {
      //   console.log(userData);
      axios
        .post("/register", {
          name: userData.name,
          email: userData.email,
          password: userData.password,
          password_confirmation: userData.password_confirmation,
        })
        .then(function (response) {
          context.commit("register", response);
          //   console.log(response);
          // window.location.href = "/task";
        })
        .catch(function (error) {
          context.commit("register", error.response.data);
          //   console.log(error.response.data.errors);
          // state.errors = error.response.data.errors;
        })
        .finally(() => (this.loading = false));
    },
  },
};
export default auth;
