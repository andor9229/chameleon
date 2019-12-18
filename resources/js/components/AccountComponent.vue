<template>
    <div v-if="showaccountmodal" class="absolute w-full h-full top-0 left-0 flex items-center justify-center z-40">
        <div class="absolute w-full h-full bg-black opacity-50 fixed top-0 left-0 z-40" @click="close()"></div>
        <div class="modal absolute w-1/3 p-6 z-50 bg-white rounded-lg shadow-lg">
            <i class="absolute fa fa-times top-0 right-0 m-2 cursor-pointer text-gray-700" @click="close()"></i>
            <h3 class="font-normal text-xl py-4 -ml-6 mb-3 border-l-4 border-blue-500 pl-4 flex items-center justify-between">
                <div>
                    <avatar-component
                        name=""
                        :initials="account.initials"
                        :color="account.avatar"
                    ></avatar-component>
                    Account
                </div>
                <div v-if="this.notification" class="w-auto ml-auto flex items-center bg-green-500 text-white text-xs font-bold px-2 py-1" role="alert">
                    <p>{{ this.notification }}</p>
                </div>
            </h3>
            <div class="mb-5 flex-1">
                <div class="mb-6">
                    <label class="label">Name</label>
                    <input class="input"
                        :class="(this.errors.name) ? 'border-red-500' : '' "
                        placeholder="Name"
                        v-model="account.name">
                    <p v-if="this.errors.name" class="error">{{ this.errors.name[0] }}</p>
                </div>

                <div class="mb-6">
                    <label class="label">Email</label>
                    <input class="input"
                           :class="(this.errors.email) ? 'border-red-500' : '' "
                           placeholder="Email"
                           v-model="account.email">
                    <p v-if="this.errors.email" class="error">{{ this.errors.email[0] }}</p>
                </div>

                <div class="mb-6">
                    <label class="label">Avatar</label>
                    <select class="input h-10"
                           placeholder="Email"
                            :class="(this.errors.avatar) ? 'border-red-500' : '' "
                           v-model="account.avatar">
                        <option value="bg-blue-500">blue</option>
                        <option value="bg-gray-500">gray</option>
                        <option value="bg-green-500">green</option>
                        <option value="bg-indigo-500">indigo</option>
                        <option value="bg-orange-500">orange</option>
                        <option value="bg-purple-500">purple</option>
                        <option value="bg-red-500">red</option>
                        <option value="bg-teal-500">teal</option>
                        <option value="bg-yellow-500">yellow</option>
                    </select>
                    <p v-if="this.errors.email" class="error">{{ this.errors.email[0] }}</p>
                </div>

                <div class="mb-6">
                    <label class="label">Password</label>
                    <input class="input"
                           :class="(this.errors.password) ? 'border-red-500' : '' "
                           type="password"
                           placeholder="Password"
                           v-model="account.password">
                    <p v-if="this.errors.password" class="error">{{ this.errors.password[0] }}</p>

                </div>

                <div class="mb-6">
                    <label class="label">Confirm Password</label>
                    <input class="input" type="password" placeholder="Confirm Password" v-model="account.password_confirmation">
                </div>
            </div>

            <div class="text-right border-t border-gray-300 pt-5">
                <button class="button button-orange-outline mr-5" @click="close()">Abort</button>
                <button class="button button-blue" @click="update()">Confirm</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AccountComponent",

        props: [ 'showaccountmodal' ],

        data() {
            return {
                account: null,
                notification: null,
                errors: {
                    name: null,
                    email: null,
                    password: null,
                    avatar: null,
                }
            }
        },

        methods: {
            get() {
                axios.get('/account')
                    .then(response => {
                        this.account = response.data;
                    });
            },

            update() {
                axios.put('/account', this.account)
                    .then(response => {
                        this.account = response.data;

                        this.notification = 'Account Information Updated';

                        setInterval(function () {
                            this.notification = null;
                        }.bind(this), 10000);
                    })
                    .catch(error => this.errors = error.response.data.errors)
            },

            close() {
                this.get();
                this.notification = null;
                this.errors = {
                    name: null,
                    email: null,
                    password: null,
                    avatar: null
                };
                this.$emit('close');
            }
        },

        mounted() {
            this.get();
        }
    }
</script>
