<template>
  <div :class="['card', 'h-100', hasBorder ? 'border' : 'border-0']">
    <div v-if="$slots.header" class="card-header">
      <slot name="header"></slot>
    </div>
    <div :class="['card-body', center ? 'd-flex justify-content-center m-md-5 mt-5' : '', noPadding ? 'p-0' : '']">
      <slot name="body"> </slot>
    </div>
    <div v-if="$slots.footer" class="card-footer">
      <slot name="footer"></slot>
    </div>
  </div>

</template>

<script>
export default {
  props: {
    hasBorder: {
      type: String,
      default: false,
    },
    center: {
      type: String,
      default: false,
    },
    noPadding: {
      type: String,
      default: false,
    }
  },
};
</script>