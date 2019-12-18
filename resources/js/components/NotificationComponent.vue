<template>
    <div ref="notification">
        <div class="w-full mx-auto mt-0 flex items-center text-white text-sm font-bold px-4 py-3"
             :class="background"
             role="alert">
            <div class="mx-auto flex items-center">
                <i class="fas fa-2x mr-2" :class="icon"></i>
                {{ message }}
            </div>
            <i class="fa fa-times -mt-5 -mr-2 cursor-pointer" @click="close"></i>
        </div>
    </div>
</template>

<script>
    export default {
        name: "NotificationComponent",

        props: {
            message: {default: null},
            type: {default: null}
        },

        data() {
            return {
                background: null,
                icon: null
            }
        },

        mounted() {
            this.getType();

            setTimeout(function(){
                this.close();
            }.bind(this), 15000);
        },

        methods: {
            close() {
                this.$refs.notification.remove();
            },

            getType() {
                if(this.type === 'success') {
                    this.background = 'bg-green-500';
                    this.icon = 'fa-check-circle';
                }

                if(this.type === 'error') {
                    this.background = 'bg-red-500';
                    this.icon = 'fa-exclamation-triangle';
                }
            }
        }
    }
</script>
