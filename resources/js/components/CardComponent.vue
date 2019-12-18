<template>
    <div class="bg-white rounded-lg shadow-lg px-5 py-10">
        <div class="header header-blu">
            <slot name="header">

            </slot>
        </div>

        <div class="mb-5 flex-1">
            <slot name="body">

            </slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CardComponent"
    }
</script>

<style scoped>

</style>
