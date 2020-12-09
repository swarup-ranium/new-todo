const create = {
  namespaced: true,
  state() {
    return { errors: {}, categories: {} };
  },
  mutations: {
    errors(state, error) {
      if (error.errors !== "") {
        state.errors = error.errors;
      } else {
        state.errors = "";
      }
    },
    listCategory(state, categories) {
      if (categories !== "") {
        state.categories = categories;
      }
    },
  },
  actions: {
    create(context, data) {
      return axios
        .post("/api/taskCategory", {
          name: data.name,
        })
        .then(function (response) {
          return response;
        })
        .catch(function (error) {
          context.commit("errors", error.response.data);
        })
        .finally(() => (this.loading = false));
    },
    list(context) {
      axios
        .get("/api/taskCategory")
        .then(function (response) {
          context.commit("listCategory", response.data);
        })
        .catch(function (error) {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    delete(context, data) {
      return axios
        .delete("/api/taskCategory/" + data.id)
        .then(function (response) {
          return response;
        })
        .catch(function (error) {})
        .finally(() => (this.loading = false));
    },
    edit(context, data) {
      return axios
        .get("/api/taskCategory/" + data.id + "/edit")
        .then(function (response) {
          return response;
        })
        .catch(function (error) {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    update(context, data) {
      return axios
        .patch("/api/taskCategory/" + data.id, data.category)
        .then(function (response) {
          return response;
        })
        .catch(function (error) {
          context.commit("errors", error.response.data);
        });
    },
  },
};
export default create;
