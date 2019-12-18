<template>
    <div :class="(inline) ? 'flex -mx-5 p-5 border-b items-start' : 'mb-6'" >
        <div :class="(inline) ? 'w-1/5' : ''">
            <label class="label">{{ placeholder }}</label>
        </div>

        <div :class="(inline) ? 'w-2/5' : ''">
            <textarea class="input"
                      :name="field"
                      :placeholder="placeholder"
                      rows="5">{{ value }}</textarea>
            <p v-if="error" class="error">{{ error }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TextAreaComponent",

        props: {
            field: {default: null},
            placeholder: {default: null},
            value: {default: null},
            error: {default: null},
            inline: {default: null}
        }
    }
</script>

<style scoped>

</style>
