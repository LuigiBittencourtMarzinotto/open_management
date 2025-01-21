<template>
    <form action="" :id="formId" >
        <input type="hidden" name="_token" id="_token" :value="token">
        <slot name="body">

        </slot>

    </form>
</template>
<script>
export default {
    props: ['formId', 'token'],
    methods:{
    }
}
</script>