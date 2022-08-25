<template>
  <div class="w-full mb-4">
    <input
      :placeholder="label"
      :value="modelValue"
      @input="updateValue($event.target.value)"
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
</template>

<script>
export default {
  props: ["modelValue", "label"],
  methods: {
    updateValue(value) {
      this.$emit("input", value);
    },
  },
};
</script>