<template>
    <lottie
            :options="loading"
            :height="100"
            :width="100" />
</template>

<script>
    import Loading from '../assets/loading'
    import Lottie from 'vue-lottie'
    export default {
        name: "Loading",
        components: {
            Lottie
        },
        data() {
            return {
                loading: { animationData: Loading, loop: false },
            }
        }
    }
</script>

<style scoped>

</style>
