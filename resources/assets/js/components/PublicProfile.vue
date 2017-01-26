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

            </div>

        </div>

        <div class="column is-1">
            <!-- Offset -->
        </div>
        <div class="column is-8">
            <p class="responsive-center">
                <span class="profile-label profile-about" v-for="profile in this.profileData.profile_info">About {{profile.display_name}} </span>
            </p>
            <p class="about-content" v-for="profile in this.profileData.profile_info">

                {{ profile.about }}

            </p>
        </div>

    </div><!-- #End Row-->


    <beam-module 
        v-for="stream in this.profileData.stream_info" 
        v-if="stream.platforms_id == 1" 
        :user="stream.user" 
        :url="stream.url"
    >
    </beam-module>

    <twitch-module 
        v-for="stream in this.profileData.stream_info" 
        v-if="stream.platforms_id == 2" 
        :user="stream.user" 
        :url="stream.url"
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
      export default {

        data() {

            return {
                profileData:[],
                placeholder_avatar: '/img/placeholders/256x256.png'

            };
        },

        props:[ 'displayname'],

        mounted() {
            this.getProfileData();
        },

        methods: {

            getProfileData: function() {
                axios.get( '/api/profiles/u/' + this.displayname )
                     .then( response => this.profileData = response.data );
            }

        }
    }

</script>