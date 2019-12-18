<template>
    <div :class="(inline) ? 'flex -mx-5 p-5 border-b items-center' : 'mb-6'" >
        <div :class="(inline) ? 'w-1/5' : ''">
            <label class="label">{{ placeholder }}</label>
        </div>

        <div :class="(inline) ? 'w-2/5' : ''">
            <select class="input h-10"
                   :class="(error) ? 'border-red-500' : '' "
                   :name="field"
                   :value="value"
                    v-model="selectedvalue" @change="selected">
                <option value=""> -- </option>
                <option v-for="(index, value) in items" :value="value"> {{ index }} </option>
            </select>
            <p v-if="error" class="error">{{ error }}</p>
        </div>

        <div :class="(inline) ? 'w-2/5' : ''">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SelectComponent",

        props: {
            field: {default: null},
            placeholder: {default: null},
            value: {default: null},
            error: {default: null},
            inline: {default: null},
            items: {default: null}
        },

        data() {
            return {
                selectedvalue: this.value
            }
        },

        methods: {
            selected() {
                return this.$emit('selected', this.selectedvalue)
            }
        }
    }
</script>

<style scoped>

</style>
