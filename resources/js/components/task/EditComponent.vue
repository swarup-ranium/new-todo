<template>
  <div class="container">
    <h2>Edit Task</h2>
    <form @submit.prevent="update">
      <div class="form-group">
        <label for="name">Task Name:</label>
        <input
          type="text"
          class="form-control"
          id="name"
          placeholder="Enter Task Name"
          name="name"
          value=""
          v-model="task.name"
        />
        <span class="invalid-feedback" role="alert" v-if="errors.name">
          <strong>{{ errors.name[0] }}</strong>
        </span>
      </div>
      <div class="form-group">
        <label for="pwd">Category:</label>
        <select name="category_id" v-model="task.task_category_id">
          <option
            v-for="category in categories"
            :key="category.id"
            :value="category.id"
          >
            {{ category.name }}
          </option>
        </select>
      </div>
      <div class="form-group">
        <label for="pwd">Is Complete:</label>
        <select name="is_complete" v-model="task.is_complete">
          <option selected disabled>Select</option>
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select>
      </div>
      <button class="btn btn-default">Update</button>
    </form>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      taskId: null,
      task: {},
      categories: {},
      errors: {},
    };
  },
  mounted() {
    let app = this;
    let id = app.$route.params.id;
    app.taskId = id;
    axios
      .get("/api/task/" + id + "/edit")
      .then(function (resp) {
        app.categories = resp.data.categories;
        app.task = resp.data.task;
      })
      .catch(function () {
        alert("Could not load your task");
      });
  },
  methods: {
    update() {
      let app = this;
      let task = app.task;
      axios
        .put("/api/task/" + app.taskId, {
          name: task.name,
          category_id: task.task_category_id,
          is_complete: task.is_complete,
        })
        .then(function (resp) {
          app.$router.push({
            name: "listTask",
            params: {
              msg: resp.data.name + " " + "task update successfully!!",
            },
          });
        })
        .catch(function (error) {
          app.errors = error.response.data.errors;
          //   console.log(error);
          //   alert("Could not create your category");
        });
    },
  },
};
</script>

<style scoped>
.invalid-feedback {
  width: 100%;
  margin-top: 0.25rem;
  font-size: 90%;
  color: #e3342f;
}
</style>
