<template>
    <div>
        <div v-if="! loading" class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Seleziona organizzazione
                </label>
            </div>
            <div class="md:w-2/3">
                <select
                    v-model="organization"
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="organizations"
                    name="organizations"
                    multiple
                >
                    <option selected value="Seleziona organizzazione">Seleziona Organizzazione</option>
                    <option v-for="organization in organizations" :value="organization.id">{{ organization.name }}</option>
                </select>
            </div>
        </div>
        <loading v-if="loading"></loading>
    </div>
</template>
<script>
    import Loading from "./Loading";
    export default {
        name: 'SelectOrganization',
        components: {Loading},
        data() {
            return {
                organizations: [],
                organization: 'Seleziona organizzazione',
                loading: true,
            }
        },
        mounted() {
            this.getAccounts();
        },
        methods:{
            getAccounts() {
                this.loading = true;
                axios.get('/api/manage/user/organization/all')
                    .then(response => {
                        this.organizations = response.data;
                    })
                    .finally(response => {
                        this.loading = false;
                    })
            },
        },

        watch: {
            organization(value) {
                this.$emit('changeOrganization', value);
            }
        }

    }
</script>
