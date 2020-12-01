<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h1>Sign Up</h1></div>
                    <div class="card-body">
                        <form @submit.prevent="register">
                            <div class="form-group row">
                                <label
                                    for="name"
                                    class="col-md-4 col-form-label text-md-right"
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
                                        v-model="name.val"
                                    />
                                    <span
                                        class="invalid-feedback"
                                        :class="{ block: name.isValid }"
                                        role="alert"
                                    >
                                        <strong>{{ name.msg }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="email"
                                    class="col-md-4 col-form-label text-md-right"
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
                                        v-model="email.val"
                                    />
                                    <span
                                        class="invalid-feedback"
                                        :class="{ block: email.isValid }"
                                        role="alert"
                                    >
                                        <strong>{{ email.msg }}</strong>
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
                                        v-model="password.val"
                                    />
                                    <span
                                        class="invalid-feedback"
                                        :class="{ block: password.isValid }"
                                        role="alert"
                                    >
                                        <strong>{{ password.msg }}</strong>
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
                                        v-model="password_confirmation.val"
                                    />
                                    <span
                                        class="invalid-feedback"
                                        :class="{
                                            block: password_confirmation.isValid
                                        }"
                                        role="alert"
                                    >
                                        <strong>{{
                                            password_confirmation.msg
                                        }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <label
                                    for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right"
                                ></label>
                                <div class="col-md-6 offset-md-4">
                                    <button class="btn btn-primary pull-left">
                                        Register
                                    </button>
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
export default {
    data() {
        return {
            name: {
                val: "",
                msg: "",
                isValid: false
            },
            email: {
                val: "",
                msg: "",
                isValid: false
            },
            password: {
                val: "",
                isValid: false,
                msg: ""
            },
            password_confirmation: {
                val: "",
                msg: "",
                isValid: false
            }
        };
    },
    methods: {
        register() {
            let that = this;
            this.axios
                .post("/register", {
                    name: this.name.val,
                    email: this.email.val,
                    password: this.password.val,
                    password_confirmation: this.password_confirmation.val
                })
                .then(function(response) {
                    // alert(response);
                    window.location.href = "/task";
                })
                .catch(function(error) {
                    if (error.response.data.errors.name !== undefined) {
                        that.name.msg = error.response.data.errors.name;
                        that.name.isValid = true;
                    } else {
                        that.name.msg = "";
                        that.name.isValid = false;
                    }
                    if (error.response.data.errors.email !== undefined) {
                        that.email.msg = error.response.data.errors.email[0];
                        that.email.isValid = true;
                    } else {
                        that.email.msg = "";
                        that.email.isValid = false;
                    }
                    if (error.response.data.errors.password !== undefined) {
                        if (
                            error.response.data.errors.password[0].search(
                                "confirmation"
                            ) < 0
                        ) {
                            if (
                                error.response.data.errors.password[0] !==
                                undefined
                            ) {
                                that.password.msg =
                                    error.response.data.errors.password[0];
                                that.password.isValid = true;
                            } else {
                                that.password.msg = "";
                                that.password.isValid = false;
                            }
                            if (
                                error.response.data.errors.password[1] !==
                                undefined
                            ) {
                                that.password_confirmation.msg =
                                    error.response.data.errors.password[1];
                                that.password_confirmation.isValid = true;
                            } else {
                                that.password_confirmation.msg = "";
                                that.password_confirmation.isValid = false;
                            }
                        } else {
                            if (
                                error.response.data.errors.password[0] !==
                                undefined
                            ) {
                                that.password_confirmation.msg =
                                    error.response.data.errors.password[0];
                                that.password_confirmation.isValid = true;
                            } else {
                                that.password_confirmation.msg = "";
                                that.password_confirmation.isValid = false;
                            }
                        }
                    } else {
                        that.password_confirmation.msg = "";
                        that.password_confirmation.isValid = false;
                        that.password.msg = "";
                        that.password.isValid = false;
                    }
                })
                .finally(() => (this.loading = false));
        }
    },
    mounted() {
        // console.log("Component mounted.");
    }
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
    display: none;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 90%;
    color: #e3342f;
}
.block {
    display: block;
}
</style>
