const auth = {
  namespaced: true,
  state() {
    return { errors: {} };
  },
  mutations: {
    errors(state, payload) {
      if (payload.errors !== "") {
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
          window.location.href = "/task";
        })
        .catch(function (error) {
          context.commit("errors", error.response.data);
        })
        .finally(() => (this.loading = false));
    },
    register(context, userData) {
      axios
        .post("/register", {
          name: userData.name,
          email: userData.email,
          password: userData.password,
          password_confirmation: userData.password_confirmation,
        })
        .then(function (response) {
          window.location.href = "/task";
        })
        .catch(function (error) {
          context.commit("errors", error.response.data);
        })
        .finally(() => (this.loading = false));
    },
  },
};
export default auth;
