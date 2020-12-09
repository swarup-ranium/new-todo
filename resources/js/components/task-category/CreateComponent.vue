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
import { mapState } from "vuex";
export default {
  data() {
    return {
      name: "",
    };
  },
  computed: {
    ...mapState("taskCategory", ["errors"]),
  },
  methods: {
    add() {
      let app = this;
      this.$store
        .dispatch("taskCategory/create", {
          name: this.name,
        })
        .then(function (response) {
          if (response.status == 201) {
            app.$router.push({
              name: "listCategory",
              params: {
                msg:
                  response.data.name + " " + "category created successfully!!",
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
