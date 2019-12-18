<template>
    <div>
        <div v-for="tab in opt.tabs">
            <button @click="setTab(tab)">{{ tab }}</button>
        </div>
        <div>
            <table style="width:100%">
                <tr>
                    <th v-for="(column, index) in columns"> {{ index }}</th>
                </tr>
<!--                <tr>-->
<!--                    <td>Jill</td>-->
<!--                    <td>Smith</td>-->
<!--                    <td>50</td>-->
<!--                </tr>-->
            </table>
        </div>
    </div>
</template>

<script>
    import options from "../../../DashboardArchitecture"
    export default {
        name: "CampaignStatistics",
        props: {
            section: {
                default: ''
            }
        },
        data() {
            return {
                opt: options[this.section],
                tab: options[this.section].hasOwnProperty('tabs') ? options[this.section].tabs[0] : '',
                data: []
            }
        },

        computed: {
            columns() {
                if (this.hasTabs) return this.opt.columns[this.tab];

                return this.opt.columns
            },
            hasTabs() {
                return this.opt.hasOwnProperty('tabs');
            },
        },
        methods: {
            setTab(tab) {
                this.tab = tab;
            }
        }
    }
</script>

<style scoped>
    button {
        border: 1px solid grey;
    }
</style>
