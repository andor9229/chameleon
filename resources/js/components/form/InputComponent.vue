<template>
    <div :class="(inline) ? 'flex -mx-5 p-5 border-b items-center' : ''" >
        <div :class="(inline) ? 'w-1/5' : ''">
            <label class="label">{{ placeholder }}</label>
        </div>

        <div :class="(inline) ? 'w-2/5' : ''">
            <input class="input"
                   :class="(error) ? 'border-red-500' : '' "
                   :name="field"
                   :type="type"
                   :placeholder="placeholder"
                   :value="value">
            <p v-if="error" class="error">{{ error }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "InputComponent",

        props: {
            type:{default: 'text'},
            field: {default: null},
            placeholder: {default: null},
            value: {default: null},
            error: {default: null},
            inline: {default: null},
        },
    }
</script>

<style scoped>

</style>
