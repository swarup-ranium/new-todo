<template>
  <div class="container">
    <h2>Add Task</h2>
    <form @submit.prevent="add">
      <div class="form-group">
        <label for="name">Task Name:</label>
        <input
          type="text"
          class="form-control"
          id="name"
          placeholder="Enter Task Name"
          name="name"
          v-model="name"
        />
        <span class="invalid-feedback" role="alert" v-if="errors.name">
          <strong>{{ errors.name[0] }}</strong>
        </span>
      </div>
      <div class="form-group">
        <label for="pwd">Category:</label>
        <select name="category_id" v-model="categoryId">
          <option selected disabled value="">Select Category</option>
          <option
            v-for="category in categories"
            :key="category.id"
            :value="category.id"
          >
            {{ category.name }}
          </option>
        </select>
        <br />
        <span class="invalid-feedback" role="alert" v-if="errors.category_id">
          <strong>{{ errors.category_id[0] }}</strong>
        </span>
      </div>
      <button class="btn btn-default">Add</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      categories: [],
      name: "",
      categoryId: "",
      errors: {},
    };
  },
  mounted() {
    let app = this;
    this.axios.get("/api/task/create").then((response) => {
      //   console.log(response.data);
      this.categories = response.data;
    });
  },
  methods: {
    add() {
      let app = this;
      this.axios
        .post("/api/task", {
          name: this.name,
          category_id: this.categoryId,
        })
        .then(function (response) {
          app.$router.push({
            name: "listTask",
            params: {
              msg: response.data.name + " " + "task added successfully!!",
            },
          });
          //   console.log(response.data);
        })
        .catch(function (error) {
          app.errors = error.response.data.errors;
        })
        .finally(() => (this.loading = false));
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
