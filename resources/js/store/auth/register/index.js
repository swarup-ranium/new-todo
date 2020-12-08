export default {
  namespaced: true,
  state() {
    return { errors: {} };
  },
  mutations: {
    register(state, userData) {
      //   console.log(userData);
      axios
        .post("/register", {
          name: userData.name,
          email: userData.email,
          password: userData.password,
          password_confirmation: userData.password_confirmation,
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
