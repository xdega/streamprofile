<template>

<div class="container">
    <div class="columns is-vcentered">
        <div class="column is-6 is-offset-3">
            
            <h1 class="title has-text-centered">
              Add a Stream...
            </h1>
            
            <div class="box">

                <form class="form-horizontal" role="form" method="POST" v-on:submit.prevent="onSubmit">

                <!-- Platform Select -->
                
                <label class="label has-text-centered">Platform</label>
                <p class="control">         
                    
                    <span>
                    <div class="platform-select" v-for="platform in platforms">
                        
                        <input type="radio" v-model="newStream.platforms_id" name="platform" :value="platform.id">
                        <img :src=" platform_logos + platform.logo ">

                    </div>
                    </span>

                </p>
                <p v-show="errors">
                    <strong v-text="errors.get('platforms_id')" class="help is-danger"></strong>
                </p>

                <!-- Stream URL -->
                <!--
                <label class="label has-text-centered">Stream URL</label>
                <p class="control">  
                    <input v-on:keydown="onKeydown()" v-model="newStream.url" name="url" class="input" type="text" placeholder="" :disabled="disabled == 1 ? true : false">
                </p>
                <p v-show="errors">
                    <strong v-text="errors.get('url')" class="help is-danger"></strong>
                </p>
                -->

                <!-- Platform Username -->
                <label class="label has-text-centered">Platform Username</label>
                <p class="control">  
                    <input v-on:keydown="onKeydown()" v-model="newStream.user" name="user" type="text" class="input" placeholder="" :disabled="disabled == 1 ? true : false">
                </p>
                <p v-show="errors">
                    <strong v-text="errors.get('user')" class="help is-danger"></strong>
                </p>

                <hr style="background-color: rgb(170, 170, 170);">

                <p v-show="!disabled" class="has-text-centered">
                <button type="submit" class="button is-primary" :disabled="disabled == 1 ? true : false">Add Stream</button>
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
                newStream: {
                    platforms_id: '', 
                    url: '',
                    user: '',
                    profiles_id: this.profileID

                },
                profileID: '',
                platforms: [],
                errors: new Errors(),
                message: '',
                platform_logos: '/img/platform_logos/',
                disabled: 0,
                reloadbutton: 0

            };
        },

        props:[ 'auth'],

        mounted() {
            this.getProfileID();
            this.getPlatforms();
        },

        methods: {

            onSubmit: function(){

                    this.newStream.profiles_id = this.profileID;

                    // User Input
                    var payload = this.newStream;

                    // Clear Form Input
                    this.newStream = {platforms_id:'', url:'', user:'' }

                    // Send Post Request
                    axios.post('/api/streams', payload)
                        .then( response => this.onSuccess() )
                        .catch( error => this.errors.record(error.response.data) );

            },

            onSuccess: function(){

                this.disabled = 1;

                this.reloadbutton = 1;

                this.message = 'Awesome! You added a Stream!';
            
            },

            onKeydown: function() {
                this.message = '';
                this.errors.clear('platforms_id');
                this.errors.clear('url');
                this.errors.clear('user');

            },

            getProfileID: function() {

                axios.get( '/api/profile_id/' + this.auth )
                     .then( response => this.profileID = response.data );
            },

            getPlatforms: function() {
                axios.get( '/api/platforms/' )
                     .then( response => this.platforms = response.data );
            },

            selectPlatform: function(id) {

                this.newStream.platforms_id = id;
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

    .platform-select {
        margin-left: 25%;
    }

    .platform-select img {
        height: 65px;
        vertical-align: middle;
        margin-left: 10px;
        padding-bottom: 20px;
    }

</style>