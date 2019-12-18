<template>
    <div>
        <a @click="setVisibleModal" class="button-icon-gray"><i class="fas fa-trash"></i></a>

        <div v-if="showModal" class="fixed w-full h-full top-0 left-0 flex items-center justify-center z-40">
            <div class="absolute w-full h-full bg-black opacity-50 fixed top-0 left-0 z-40" @click="close()"></div>
            <div class="modal absolute w-1/3 p-6 z-50 bg-white rounded-lg shadow-lg">
                <i class="absolute fa fa-times top-0 right-0 m-2 cursor-pointer text-gray-700" @click="close()"></i>
                <h3 class="font-normal text-xl py-4 -ml-6 mb-3 border-l-4 border-red-500 pl-4 flex items-center justify-between">
                    Cancella risorsa
                </h3>
                <div class="mb-5 flex-1">
                    <p class="">
                         {{ deleteMessage }}
                    </p>
                    <input
                        type="text"
                        v-model="deleteResource"
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500">
                </div>

                <div class="text-right border-t border-gray-300 pt-5">
                    <button class="button button-orange-outline mr-5" @click="close()">Abort</button>
                    <button class="button button-red" @click="destroy()" :class="[matched ? '' : 'cursor-not-allowed']">Confirm</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import axios from 'axios'
    export default {
        name: 'ConfirmDeleteComponent',

        props: {
            url: {
                required: true,
            },

            locationHref: {
                required: true,
            },

            deleteMessage: {

                type: String
            },

            resource: {
                type: String
            },

            match: {
                type: String
            },
        },
        data() {
            return {
                visibleModal: false,
                deleteResource: '',
                matched: false,
            }
        },
        computed: {
            showModal() {
                return this.visibleModal;
            }
        },

        methods: {
            setVisibleModal() {
                this.visibleModal = ! this.visibleModal;
            },
            destroy() {
                if(this.matched) {
                    axios.delete(this.url)
                        .then(response => {
                            switch(response.data.status) {
                                case 200: location.href = this.locationHref;
                                case 400:
                            }

                        });
                }
            },
            close() {
                this.visibleModal = false;
            }
        },

        watch: {
            deleteResource(value) {
                this.matched = JSON.parse(this.resource)[this.match] === value;
            }
        }


    }
</script>

<style scoped>
    a {
        cursor: pointer;
    }
</style>
