<template>
  <div class="container">
    <h2>Add Category</h2>
    <form @submit.prevent="add">
      <div class="form-group">
        <label for="name">Category Name:</label>
        <input
          type="text"
          class="form-control"
          id="name"
          placeholder="Enter Category Name"
          name="name"
          v-model="name"
        />
        <span class="invalid-feedback" role="alert" v-if="errors.name">
          <strong>{{ errors.name[0] }}</strong>
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
      name: "",
      errors: {},
    };
  },
  methods: {
    add() {
      let that = this;
      this.axios
        .post("/api/taskCategory", {
          name: this.name,
        })
        .then(function (response) {
          console.log(response.data);
          // window.location.href = "/taskCategory";
          // this.$router.push({ name: "/taskCategory" });
        })
        .catch(function (error) {
          that.errors = error.response.data.errors;
        })
        .finally(() => (this.loading = false));
    },
  },
  mounted() {
    // console.log("Component mounted.");
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
