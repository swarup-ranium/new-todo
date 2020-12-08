const register = {
  namespaced: true,
  state() {
    return { errors: {} };
  },
  mutations: {
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

export default register;
