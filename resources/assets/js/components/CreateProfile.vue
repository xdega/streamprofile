<template>

<div class="container">
    <div class="columns is-vcentered">
        <div class="column is-6 is-offset-3">
            
            <h1 class="title has-text-centered">
              Create One Now...
            </h1>
            
            <div class="box">

                <form class="form-horizontal" role="form" method="POST" v-on:submit.prevent="onSubmit">

                <!-- Display Name -->
                <label class="label has-text-centered">Display Name</label>
                <p class="control">  
                    <input v-model="newProfile.display_name" name="display_name" class="input" type="text" placeholder="" :disabled="disabled == 1 ? true : false">
                </p>
                <p v-show="errors">
                    <strong v-text="errors.get('display_name')" class="help is-danger"></strong>
                </p>

                <!-- Avatar URL -->
                <label class="label has-text-centered">Avatar URL (Upload Coming Soon!)</label>
                <p class="control">  
                    <input v-model="newProfile.avatar" name="avatar" class="input" type="text" placeholder="" :disabled="disabled == 1 ? true : false">
                </p>
                <p v-show="errors">
                    <strong v-text="errors.get('avatar')" class="help is-danger"></strong>
                </p>

                <!-- About -->
                <label class="label has-text-centered">About</label>
                <p class="control">  
                    <input v-model="newProfile.about" name="about" type="text" class="input" placeholder="" :disabled="disabled == 1 ? true : false">
                </p>
                <p v-show="errors">
                    <strong v-text="errors.get('about')" class="help is-danger"></strong>
                </p>

                <hr style="background-color: rgb(170, 170, 170);">

                <p v-show="!disabled" class="has-text-centered">
                    <button type="submit" class="button is-primary">Create Profile</button>
                </p>

                </form>

                <span v-show="message" class="help has-text-centered">
                    <strong class="form-message" v-text="message"></strong>
                </span>

                <span v-show="reloadbutton" class="help has-text-centered">
                    <button class="button is-primary" onclick="location.reload();"> Reload Page </button>
                </span>
            </div>

        </div>
    </div>
</div>

</template>

<script>
    import {Errors} from '../classes/Errors';    

    export default {

        data() {

            return {
                newProfile: {
                    display_name: '', 
                    avatar: '',
                    about: '',
                    users_id: this.auth

                },
                profile: [],
                errors: new Errors(),
                message: '',
                disabled: 0,
                reloadbutton: 0
            };
        },

        props: ['auth'],

        mounted() {
            
        },

        methods: {

            onSubmit: function(){

                    // User Input
                    var profile = this.newProfile;

                    // Clear Form Input
                    this.newProfile = {display_name:'', avatar:'', about:'' }

                    // Send Post Request
                    axios.post('/api/profiles', profile)
                        .then( response => this.onSuccess() )
                        .catch( error => this.errors.record(error.response.data) );

            },

            onSuccess: function(){

                this.reloadbutton = 1;

                this.disabled = 1;

                this.message = 'You Did It! You Made a Profile!';
            
            },

            onKeydown: function() {
                this.message = '';
                this.errors.clear('display_name');
                this.errors.clear('avatar');
                this.errors.clear('about');

            }
        }
    }
        
</script>

<style scoped>

    .form-message {
        color:#1fc78f !important;
        text-transform: uppercase;
        font-size: 14px;
    }

</style>