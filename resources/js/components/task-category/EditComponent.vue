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
        <span class="invalid-feedback" role="alert" v-if="errors.name">
          <strong>{{ errors.name[0] }}</strong>
        </span>
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
      categoryId: null,
      category: [],
    };
  },
  mounted() {
    let app = this;
    let id = app.$route.params.id;
    app.categoryId = id;
    this.$store
      .dispatch("taskCategory/edit", { id: id })
      .then(function (response) {
        if (response.status == 200) {
          app.category = response.data;
        }
      });
  },
  computed: {
    ...mapState("taskCategory", ["errors"]),
  },
  methods: {
    update() {
      let app = this;
      let category = app.category;
      this.$store
        .dispatch("taskCategory/update", {
          id: app.categoryId,
          category: category,
        })
        .then(function (response) {
          if (response.status == 200) {
            app.$router.push({
              name: "listCategory",
              params: {
                msg:
                  response.data.name + " " + "category update successfully!!",
              },
            });
          }
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
