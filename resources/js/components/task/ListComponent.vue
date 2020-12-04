<template>
  <div class="container">
    <div class="alert alert-success alert-block" v-if="successMsg">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>{{ successMsg }}</strong>
    </div>
    <div>
      <h2 style="display: inline-block">Task List</h2>
      <form method="get" action="" style="display: inline">
        <div class="pull-right">
          <label for="pwd">Filter:</label>

          <select name="task_category_id" @change="filter($event)">
            <option disabled selected>Select Category</option>
            <option value="">All</option>
            <option
              v-for="category in categories"
              :key="category.id"
              :value="category.id"
            >
              {{ category.name }}
            </option>
            @endforeach
          </select>
        </div>
      </form>
    </div>
    <div class="container">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Category</th>
            <th>Is Complete</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(task, index) in tasks" :key="task.id">
            <td>{{ task.id }}</td>
            <td>{{ task.name }}</td>
            <td>{{ taskCategory(task.task_category_id) }}</td>
            <td>
              <button
                class="btn btn-xs btn-danger"
                v-if="task.is_complete == 0"
                @click="toggleCompleted(task.id, index)"
              >
                <i style="font-size: 14px" class="fa">&#xf00d;</i>
              </button>

              <button
                type="submit"
                class="btn btn-xs btn-success"
                v-else
                @click="toggleCompleted(task.id, index)"
              >
                <i style="font-size: 14px" class="fa">&#xf00c;</i>
              </button>
            </td>
            <td>
              <router-link
                :to="{ name: 'editTask', params: { id: task.id } }"
                class="btn btn-xs btn-info"
                ><span class="glyphicon glyphicon-edit"></span>
              </router-link>
            </td>
            <td>
              <button
                type="submit"
                class="btn btn-xs btn-danger"
                @click="deleteTask(task.id, index)"
              >
                <span class="glyphicon glyphicon-trash"></span>
              </button>
            </td>
          </tr>

          <tr v-if="categories === ''">
            No Data Found.
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tasks: [],
      categories: [],
      successMsg: "",
    };
  },
  mounted() {
    let app = this;
    app.successMsg = app.$route.params.msg;
    this.axios.get("/api/task/fetch-data").then((response) => {
      this.tasks = response.data.tasks;
      this.categories = response.data.categories;
    });
  },
  methods: {
    deleteTask(id, index) {
      var app = this;
      this.axios.delete("/api/task/" + id).then((response) => {
        app.tasks.splice(index, 1);
        app.successMsg = response.data.name + " " + "task deleted!!!";
      });
    },
    toggleCompleted(id, index) {
      var app = this;
      this.axios
        .put("/api/task/" + id + "/toggle-completed")
        .then((response) => {
          this.tasks[index]["is_complete"] = !this.tasks[index]["is_complete"];
          app.successMsg = "Task status updated!!!";
        });
    },
    taskCategory(catId) {
      var app = this;
      let catName = "";
      let categories = app.categories;
      categories.forEach((element) => {
        if (element.id == catId) {
          catName = element.name;
        }
      });
      return catName;
    },
    filter(event) {
      let id = event.target.value;
      this.axios.get("/api/task/fetch-data?id=" + id).then((response) => {
        this.tasks = response.data.tasks;
      });
    },
  },
};
</script>
