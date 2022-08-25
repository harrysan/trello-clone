<template>
  <form>
    <div class="w-full mb-4">
      <input
        type="text"
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
        placeholder="Enter email"
        v-model="email"
      />
    </div>
    <div class="w-full mb-4" v-if="register_page">
      <input
        type="text"
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
        placeholder="Enter full name"
        v-model="fullname"
      />
    </div>
    <div class="w-full mb-4">
      <input
        type="password"
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
        placeholder="Enter password"
        v-model="password"
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
        {{ label }}
      </button>
    </div>
  </form>
</template>

<script>
import Login from "./../graphql/Login.gql";

export default {
  props: ["label"],
  data() {
    return {
      email: null,
      fullname: null,
      password: null,
    };
  },
  computed: {
    register_page() {
      return this.$route.meta.register_page;
    },
  },
  methods: {
    authenticate() {
      this.$apollo.mutate({
        mutation: Login,
        variables: {
          email: this.email,
          password: this.password,
        },
      });
    },
  },
};
</script>
