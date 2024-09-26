<template>
  <div :class="['card', 'h-100', hasBorder ? 'border' : 'border-0']">
    <div v-if="$slots.header" class="card-header">
      <slot name="header"></slot>
    </div>
    <div :class="['card-body', center ? 'd-flex justify-content-center' : '']">
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
      type: Boolean,
      default: false,
    },
    center: {
      type: Boolean,
      default: false,
    }
  },
};
</script>