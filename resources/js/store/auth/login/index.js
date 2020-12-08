export default {
  namespaced: true,
  state() {
    return { errors: {} };
  },
  mutations: {
    login(state, userData) {
      //   console.log(userData);
      axios
        .post("/login", {
          email: userData.email,
          password: userData.password,
          remember: userData.remember,
        })
        .then(function (response) {
          //   console.log(response);
          window.location.href = "/task";
        })
        .catch(function (error) {
          //   console.log(error.response.data.errors);
          state.errors = error.response.data.errors;
        })
        .finally(() => (this.loading = false));
    },
  },
};
