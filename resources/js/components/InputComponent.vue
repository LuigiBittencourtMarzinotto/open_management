<template>
    <div :class="col">
      <div class="mb-3">
        <label class="form-label fw-bold" :for="idInput">{{ label }}</label><span class="text-danger" v-if="required">*</span>
        <slot name="input"> </slot>
      </div>
    </div>
</template>

<script>
export default {
  props: ["label", "idInput", "col", 'required'],
};
</script>