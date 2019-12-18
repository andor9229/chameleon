<template>
    <div>
        <div v-for="tab in opt.tabs">
            <button @click="setTab(tab)">{{ tab }}</button>
        </div>
        <div v-for="g in groups">
            <table style="width:100%">
                <tr>
                    <th v-for="(column, index) in columns"> {{ index }}</th>
                </tr>
                <tr v-for="d in data">
                    <td v-for="column in columns">
                        {{ showItem(d, column) }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    import options from "../../../DashboardArchitecture"
    export default {
        name: "PartnerStatistics",
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
        created() {
            this.init();
        },
        computed: {
            columns() {
                if (this.hasTabs) return this.opt.columns[this.tab];

                return this.opt.columns
            },
            hasTabs() {
                return this.opt.hasOwnProperty('tabs');
            },
            showItem() {
                return (d,column) => {
                    if (column.hasOwnProperty("value")) return column.value;

                    return d[column.name];
                }
            }
        },
        methods: {
            setTab(tab) {
                this.tab = tab;
            },
            init() {
                let url = "/partner/query/";
                switch(this.tab) {
                    case 'Dettaglio Lavorazione Leads': url += "leads"; break;
                    case 'Dettaglio Contratti': url += "contracts"; break;
                }
                axios.get(url)
                    .then(function({data}) {
                        this.data = data;
                    }.bind(this))
            },
        },

        watch: {
            tab() {
                this.init()
            }
        }
    }
</script>

<style scoped>
    button {
        border: 1px solid grey;
    }
</style>
