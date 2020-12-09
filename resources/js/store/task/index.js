const task = {
  namespaced: true,
  state() {
    return { errors: {}, tasks: {}, categories: {}, task: {} };
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
    listTask(state, tasks) {
      if (tasks !== "") {
        state.tasks = tasks;
      }
    },
    editTask(state, data) {
      state.task = data.task;
      state.categories = data.categories;
    },
  },
  actions: {
    create(context) {
      axios
        .get("/api/task/create")
        .then(function (response) {
          context.commit("listCategory", response.data);
        })
        .catch(function (error) {
          context.commit("errors", error.response.data);
        })
        .finally(() => (this.loading = false));
    },
    store(context, data) {
      return axios
        .post("/api/task", {
          name: data.name,
          category_id: data.categoryId,
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
        .get("/api/task/fetch-data")
        .then(function (response) {
          context.commit("listTask", response.data.tasks);
          context.commit("listCategory", response.data.categories);
        })
        .catch(function (error) {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    delete(context, data) {
      return axios
        .delete("/api/task/" + data.id)
        .then(function (response) {
          return response;
        })
        .catch(function (error) {})
        .finally(() => (this.loading = false));
    },
    edit(context, data) {
      return axios
        .get("/api/task/" + data.id + "/edit")
        .then(function (response) {
          context.commit("editTask", {
            task: response.data.task,
            categories: response.data.categories,
          });
        })
        .catch(function (error) {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    update(context, data) {
      return axios
        .patch("/api/task/" + data.id, data)
        .then(function (response) {
          return response;
        })
        .catch(function (error) {
          context.commit("errors", error.response.data);
        });
    },
    toggleCompleted(context, data) {
      return axios
        .put("/api/task/" + data.id + "/toggle-completed")
        .then((response) => {
          return response;
        });
    },
    filter(context, data) {
      axios.get("/api/task/fetch-data?id=" + data.id).then((response) => {
        context.commit("listTask", response.data.tasks);
      });
    },
  },
};
export default task;
