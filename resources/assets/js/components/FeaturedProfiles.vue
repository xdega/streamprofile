<template>
<span>
        <div class="columns">

        <div class="user-info column is-12 has-text-centered">

            <div v-for="info in this.profileData" class="image is-128x128 has-text-centered" style="margin-right: 10px;">
                <a :href=" '/profiles/'+ info.display_name ">
                <img v-if="info.avatar" :src="info.avatar">

                <img v-else :src="placeholder_avatar">
                </a>
            </div>

        </div>

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

        mounted() {
            this.getProfileData();
        },

        methods: {

            getProfileData: function() {
                axios.get( '/api/profiles/' )
                     .then( response => this.profileData = response.data );
            }

        }
    }

</script>