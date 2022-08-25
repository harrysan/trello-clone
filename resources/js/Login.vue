<template>
  <div class="bg-white sm:bg-gray-100 h-full flex justify-center">
    <div class="container mt-2 sm:mt-10 flex flex-col items-center">
      <div class="text-3xl text-blue-700 font-bold mb-10">
        <span>Laravello</span>
      </div>

      <div class="w-full sm:shadow-xl sm:bg-white sm:py-8 sm:px-12">
        <Errors :errors="errors"></Errors>

        <div class="w-full text-center text-gray-600 font-bold mb-8">
          Login to Laravello
        </div>

        <form @submit.prevent="authenticate">
          <BaseInput v-model="email" label="Email"></BaseInput>
          <div class="w-full mb-4">
            <input
              type="password"
              placeholder="Password"
              v-model="password"
              class="
                rounded-sm
                px-4
                py-2
                outline-none
                focus:outline-none
                border-gray-400
                bg-gray-100
                border-solid border-2
                w-full
                text-sm
              "
            />
          </div>
          <div class="w-full mb-6">
            <button
              type="submit"
              class="
                rounded-sm
                px-4
                py-2
                text-sm
                bg-green-500
                font-bold
                outline-none
                focus:outline-none
                hover:bg-opacity-75
                w-full
                text-white
                disabled:opacity-25
              "
            >
              Login
            </button>
          </div>
        </form>

        <div class="bg-gray-400 h-px w-full mb-6"></div>

        <div class="text-center text-sm">
          <router-link
            :to="{ name: 'register' }"
            class="text-blue-600 hover:underline"
            >Sign up for an account</router-link
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BaseInput from "./components/BaseInput.vue";
import Login from "./graphql/Login.gql";
import { gqlErrors } from "./utils";
import Errors from "./components/Errors.vue";

export default {
  components: {
    BaseInput,
    Errors,
    Errors,
  },
  data() {
    return {
      email: null,
      password: null,
      errors: [],
    };
  },
  methods: {
    async authenticate() {
      this.errors = [];

      // console.log(this.email);
      // console.log(this.password);
      try {
        const response = await this.$apollo.mutate({
          mutation: Login,
          variables: {
            email: this.email,
            password: this.password,
          },
        });
        const user = response.data?.login;

        if (user) {
          this.$store.dispatch("setLoggedIn", true);
          this.$store.commit("setUser", user);
          this.$router.push({ name: "board", params: { id: 1 } });
        }
      } catch (err) {
        // console.log(err);
        // console.log(gqlErrors(err));
        this.errors = gqlErrors(err);
      }
    },
  },
};
</script>

<style scoped>
.container {
  width: 300px;
  max-width: 300px;
}
@media (min-width: 640px) {
  .container {
    width: 400px;
    max-width: 400px;
  }
}
</style>
