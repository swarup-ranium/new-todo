<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header"><h1>Sign Up</h1></div>
          <div class="card-body">
            <form @submit.prevent="register">
              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"
                  >Name</label
                >

                <div class="col-md-6">
                  <input
                    id="name"
                    type="text"
                    class="form-control"
                    name="name"
                    value=""
                    required
                    autocomplete="name"
                    autofocus
                    v-model="name"
                  />
                  <span
                    class="invalid-feedback"
                    role="alert"
                    v-if="errors.name"
                  >
                    <strong>{{ errors.name[0] }}</strong>
                  </span>
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right"
                  >Email</label
                >

                <div class="col-md-6">
                  <input
                    id="email"
                    type="email"
                    class="form-control"
                    name="email"
                    value=""
                    required
                    autocomplete="email"
                    v-model="email"
                  />
                  <span
                    class="invalid-feedback"
                    role="alert"
                    v-if="errors.email"
                  >
                    <strong>{{ errors.email[0] }}</strong>
                  </span>
                </div>
              </div>

              <div class="form-group row">
                <label
                  for="password"
                  class="col-md-4 col-form-label text-md-right"
                  >Password</label
                >

                <div class="col-md-6">
                  <input
                    id="password"
                    type="password"
                    class="form-control"
                    name="password"
                    required
                    autocomplete="new-password"
                    v-model="password"
                  />
                  <span
                    class="invalid-feedback"
                    role="alert"
                    v-if="errors.password"
                  >
                    <strong>{{ errors.password[0] }}</strong>
                  </span>
                </div>
              </div>

              <div class="form-group row">
                <label
                  for="password-confirm"
                  class="col-md-4 col-form-label text-md-right"
                  >Confirm Password</label
                >

                <div class="col-md-6">
                  <input
                    id="password-confirm"
                    type="password"
                    class="form-control"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    v-model="password_confirmation"
                  />
                  <span
                    class="invalid-feedback"
                    role="alert"
                    v-if="errors.password"
                  >
                    <strong>{{ errors.password[1] }}</strong>
                  </span>
                </div>
              </div>
              <div class="form-group row mb-0">
                <label class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-6 offset-md-4">
                  <button class="btn btn-primary pull-left">Register</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState } from "vuex";
export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
    };
  },
  computed: {
    ...mapState("auth", ["errors"]),
  },
  methods: {
    register() {
      this.$store.dispatch("auth/register", {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation,
      });
    },
  },
};
</script>
<style scoped>
label {
  text-align: right;
}
.card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
  border: 1px solid rgba(0, 0, 0, 0.125);
  border-radius: 0.25rem;
}
.card-header {
  padding: 0.75rem 1.25rem;
  margin-bottom: 0;
  background-color: rgba(0, 0, 0, 0.03);
  border-bottom: 1px solid rgba(0, 0, 0, 0.125);
}

.card-header:first-child {
  border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
}
.card-body {
  flex: 1 1 auto;
  min-height: 1px;
  padding: 1.25rem;
}
.invalid-feedback {
  width: 100%;
  margin-top: 0.25rem;
  font-size: 90%;
  color: #e3342f;
}
</style>
