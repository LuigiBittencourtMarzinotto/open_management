<template>
    <div class="modal fade" v-bind="staticModal ? {'data-bs-backdrop': 'static','data-bs-keyboard': 'false' } : {}" 
        :id="idModal" tabindex="-1" role="dialog" :aria-labelledby="idModal + 'ModalLabel'" aria-hidden="true">
        <div class="modal-dialog" :class="{ 'modal-dialog-centered': centerModal, [sizeModal]: sizeModal }"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" :id="idModal + 'Label'">{{ titleModal }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <slot name="body">

                    </slot>
                </div>
                <div class="modal-footer" v-if="$slots.footer">
                    <slot name="footer">

                    </slot>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['idModal', 'titleModal', 'centerModal', 'sizeModal', 'staticModal'],
    methods: {
        handleSubmit(e) {
            // Aqui você pode emitir um evento ou chamar um método do componente pai
            this.$emit('submit', e); // Emite um evento para o pai
        },
    }
}
</script>