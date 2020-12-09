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
import { mapState } from "vuex";
export default {
  data: function () {
    return {
      taskId: null,
    };
  },
  mounted() {
    let app = this;
    let id = app.$route.params.id;
    app.taskId = id;
    this.$store.dispatch("task/edit", { id: id }).then(function (response) {
      if (response.status == 200) {
        app.task = response.data.task;
        app.categories = response.data.categories;
      }
    });
  },
  computed: {
    ...mapState("task", ["errors", "task", "categories"]),
  },
  methods: {
    update() {
      let app = this;
      let task = app.task;
      this.$store
        .dispatch("task/update", {
          id: task.id,
          name: task.name,
          category_id: task.task_category_id,
          is_complete: task.is_complete,
        })
        .then(function (response) {
          app.$router.push({
            name: "listTask",
            params: {
              msg: response.data.name + " " + "task update successfully!!",
            },
          });
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
