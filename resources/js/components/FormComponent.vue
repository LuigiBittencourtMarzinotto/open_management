<template>
    <form action="" :id="formId">
        <slot name="body">

        </slot>

    </form>
</template>
<script>
export default {
    props: ['formId']
}
</script>