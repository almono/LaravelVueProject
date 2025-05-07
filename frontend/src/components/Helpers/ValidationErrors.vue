<template>
  <div class="px-1" v-if="errors && Object.keys(errors).length">
    <span class="col-12 mb-2" v-for="(errorMsgs, field) in errors" :key="index">
      <span class="validation-field">{{ capitalize(field) }}</span>
      <li class="validation-error" v-for="error in errorMsgs" :key="error">
        {{ error }}
      </li>
    </span>
  </div>
</template>

<script setup>
function capitalize(text) {
  return text ? text.charAt(0).toUpperCase() + text.slice(1) : ''
}

const props = defineProps({
  errors: {
    type: Object,
    required: false,
    default: () => {}
  }
})
</script>

<script>
import { defineProps } from 'vue'

export default {
  name: 'ValidationErrors'
};
</script>

<style>
.validation-field {
  font-weight: 600;
  color: rgb(214, 27, 27);
}

.validation-error {
  color: rgb(180, 38, 38);
}
</style>
