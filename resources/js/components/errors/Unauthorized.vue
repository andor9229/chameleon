<template>
    <lottie
        :options="unauthorized"
        :height="200"
        :width="200" />
</template>

<script>
    import Unauthorized from '../../assets/errors/403'
    import Lottie from 'vue-lottie'
    export default {
        name: "Unauthorized",
        components: {
            Lottie
        },
        data() {
            return {
                unauthorized: { animationData: Unauthorized, loop: false },
            }
        }
    }
</script>

<style scoped>

</style>
