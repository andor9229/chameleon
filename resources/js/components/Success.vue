<template>
    <card-component>
        <div slot="body">
            <lottie
                :options="success"
                :height="300"
                :width="300" />
            <h2>{{ message }}</h2>
        </div>
    </card-component>

</template>

<script>
    import Success from '../assets/success'
    import Lottie from 'vue-lottie'
    import CardComponent from "./CardComponent";
    export default {
        name: "Success",
        components: {
            CardComponent,
            Lottie
        },
        props: {
            message: {
                default: ''
            }
        },
        data() {
            return {
                success: { animationData: Success, loop: false },
            }
        }
    }
</script>

<style scoped>
    h2 {
        text-align: center;
        font-size: 3rem;
        color: rgb(19, 205, 79);
    }
</style>
