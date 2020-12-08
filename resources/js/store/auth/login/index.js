const login = {
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
  },
};
export default login;
