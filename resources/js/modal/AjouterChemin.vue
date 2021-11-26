<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-container">
                <p>template modal</p>
                <slot>


                </slot>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: ['show'],
}
</script>