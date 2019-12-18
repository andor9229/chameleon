<template>
    <span>
        <span
            class="avatar"
            :class="color"
            v-tooltip=name
        >{{ initials }}</span>
    </span>
</template>

<script>
    export default {
        name: "AvatarComponent",

        props: {
            name: {default: null},
            initials: {default: null},
            color: {default:null}
        }
    }
</script>

<style scoped>

</style>
