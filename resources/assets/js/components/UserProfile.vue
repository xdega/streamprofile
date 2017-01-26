<template>
<span>
        <div class="columns">

        <div class="user-info column is-2 has-text-centered">

            <p v-for="profile in this.profileData.profile_info" class="username">

                {{ profile.display_name }}

            </p>

            <div class="image is-128x128 has-text-centered">
                
                <img v-for="info in this.profileData.profile_info" 
                     v-if="info.avatar" 
                     :src="info.avatar"
                >

                <img v-else :src="placeholder_avatar">

                <br>
                <button v-if="!editAvatar" v-on:click="editAvatar = true" class="button is-primary">Edit Avatar</button>
                <br>

                <span v-if="editAvatar">

                    <p v-show="errors">
                        <strong v-text="errors.get('avatar')" class="help is-danger"></strong>
                    </p>

                    <input v-model="newAvatar" class="input" placeholder="Avatar URL">

                    <button v-on:click="updateAvatar()" style="margin-top: 10px;" class="button is-primary">Confirm</button>

                    <button v-on:click="editAvatar = false" style="margin-top: 10px;" class="button is-primary is-grey">Cancel</button>
                </span>
            </div>

        </div>

        <div class="column is-1">
            <!-- Offset -->
        </div>
        <div class="column is-8">
            <p class="responsive-center">
                <span class="profile-label profile-about" v-for="profile in this.profileData.profile_info">About {{profile.display_name}} </span>
            </p>
            
            <p  class="about-content" 
                v-for="profile in this.profileData.profile_info"
                style="white-space: pre;"
                >{{ profile.about }}</p>

            <br>
            <button v-for="profile in this.profileData.profile_info" v-if="!editAbout" class="button is-primary" v-on:click="editAboutButton(profile.about)"> Edit About </button>
            <button v-if="editAbout" class="button is-primary" v-on:click="updateAbout()"> Confirm Changes </button>
            <button v-if="editAbout" class="button is-primary is-grey" v-on:click="editAbout = false"> Cancel </button>
            
            <p v-show="errors">
                <strong v-text="errors.get('about')" class="help is-danger"></strong>
            </p>

            <p v-if="editAbout" class="control" >

                <textarea 
                    v-model="newAbout"
                    class="textarea"
                    v-for="profile in this.profileData.profile_info"
                ></textarea>
            </p>

        </div>

    </div><!-- #End Row-->

    <beam-module 
        v-for="stream in this.profileData.stream_info" 
        v-if="stream.platforms_id == 1" 
        :user="stream.user" 
        :url="stream.url"
        :streamID="stream.id"
        :edit="1"
    >
    </beam-module>

    <twitch-module 
        v-for="stream in this.profileData.stream_info" 
        v-if="stream.platforms_id == 2" 
        :user="stream.user" 
        :url="stream.url"
        :streamID="stream.id"
        :edit="1"
    >
    </twitch-module>
    
    <youtube-module 
        v-for="stream in this.profileData.stream_info" 
        v-if="stream.platforms_id == 3"
        :user="stream.user" 
        :url="stream.url"
    >
    </youtube-module>

</span>
</template>

<script>
import {Errors} from '../classes/Errors';

      export default {

        data() {

            return {
                profileData:[],
                errors: [],
                newAbout:'',
                newAvatar:'',
                profileID: '',
                placeholder_avatar: '/img/placeholders/256x256.png',
                editAbout: false,
                editAvatar: false,
                errors: new Errors(),

            };
        },

        props:[ 'auth'],

        mounted() {
            this.getProfileData();
            this.getProfileID();
        },

        methods: {

            getProfileData: function() {

                axios.get( '/api/profiles/id/' + this.auth )
                     .then( response => { this.profileData = response.data } );

            },

            getProfileID: function(profileData) {
                axios.get( '/api/profile_id/' + this.auth )
                     .then( response => { this.profileID = response.data } );
            },

            updateAbout: function() {

                var payload = {'about':this.newAbout, '_method': 'PUT' }
                axios.put('api/profiles/' + this.profileID, payload)
                    .then( response => this.onSuccess() )
                    .catch( error => this.errors.record(error.response.data) );
            },

            updateAvatar: function() {

                var payload = {'avatar':this.newAvatar, '_method': 'PUT' }
                axios.put('api/profiles/' + this.profileID, payload)
                    .then( response => this.onSuccess() )
                    .catch( error => this.errors.record(error.response.data) );
            },

            editAboutButton: function(about) {
                this.editAbout = true;
                this.newAbout = about;

            },

            onSuccess: function() {
                location.reload();
                this.editAbout = false;
                this.editAvatar = false;
            }

        }
    }

</script>

<style scoped>

    .is-grey {
        background-color: #555 !important;
    }

</style>