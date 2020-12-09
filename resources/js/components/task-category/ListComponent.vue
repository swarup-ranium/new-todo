<template>
  <div class="container">
    <div class="alert alert-success alert-block" v-if="successMsg">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>{{ successMsg }}</strong>
    </div>
    <h2>Category List</h2>
    <div class="container">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(category, index) in categories" :key="category.id">
            <td>{{ category.id }}</td>
            <td>{{ category.name }}</td>
            <td>
              <router-link
                :to="{ name: 'editCategory', params: { id: category.id } }"
                class="btn btn-xs btn-info"
                ><span class="glyphicon glyphicon-edit"></span>
              </router-link>
            </td>
            <td>
              <button
                class="btn btn-xs btn-danger"
                @click="deleteCategory(category.id, index)"
              >
                <span class="glyphicon glyphicon-trash"></span>
              </button>
            </td>
          </tr>
          <tr v-if="categories == ''">
            No Data Found.
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  data() {
    return {
      successMsg: "",
    };
  },
  computed: {
    ...mapState("taskCategory", ["categories"]),
  },
  mounted() {
    let app = this;
    app.successMsg = app.$route.params.msg;
    this.$store.dispatch("taskCategory/list");
    // this.axios.get("/api/taskCategory").then((response) => {
    //   this.categories = response.data;
    // });
  },
  methods: {
    deleteCategory(id, index) {
      var app = this;
      this.$store
        .dispatch("taskCategory/delete", { id: id })
        .then(function (response) {
          if (response.status == 200) {
            app.categories.splice(index, 1);
            app.successMsg = "Category deleted!!!";
          }
        });
      // this.axios.delete("/api/taskCategory/" + id).then((response) => {
      //   app.categories.splice(index, 1);
      //   app.successMsg = "Category deleted!!!";
      // });
    },
  },
};
</script>
