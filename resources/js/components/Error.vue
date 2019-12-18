<template>
    <div>
        <lottie
            :options="loading"
            :height="400"
            :width="400" />

        <h2>Si è verificato un errore!</h2>
    </div>

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
