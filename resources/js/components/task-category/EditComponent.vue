<template>
  <div class="container">
    <h2>Edit Category</h2>
    <form @submit.prevent="update">
      <div class="form-group">
        <label for="name">Category Name:</label>
        <input
          type="text"
          class="form-control"
          id="name"
          placeholder="Enter Category Name"
          name="name"
          v-model="category.name"
        />
        <span class="invalid-feedback" role="alert">
          <strong></strong>
        </span>
      </div>
      <button class="btn btn-default">Update</button>
    </form>
  </div>
</template>

<script>
export default {
  mounted() {
    let app = this;
    let id = app.$route.params.id;
    app.categoryId = id;
    axios
      .get("/api/taskCategory/" + id)
      .then(function (resp) {
        // console.log(resp.data);
        app.category = resp.data;
      })
      .catch(function () {
        alert("Could not load your category");
      });
  },
  data: function () {
    return {
      categoryId: null,
      category: [],
    };
  },
  methods: {
    update() {
      var app = this;
      var category = app.category;
      axios
        .patch("/api/taskCategory/" + app.categoryId, category)
        .then(function (resp) {
          app.$router.push({
            name: "listCategory",
            params: {
              msg: category.name + " " + "category update successfully!!",
            },
          });
        })
        .catch(function (resp) {
          console.log(resp);
          alert("Could not create your company");
        });
    },
  },
};
</script>
