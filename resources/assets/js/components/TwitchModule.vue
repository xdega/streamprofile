<template>

<div class="stream-feed">
            
    <div style="margin-top: 20px;" class="columns responsive-center">

        <div class="feed-header column is-3">
            <figure class="image inline-block vertical-middle">
                <img src="/img/platform_logos/twitch.png">
            </figure>
            <div v-if=" this.twitchStreams.stream " class="now-live inline-block">Live</div>
            <div v-else class="now-offline inline-block">Offline</div>

        </div>

        <div style="margin-top: auto;" class="column is-5">
            <p>
                <span class="profile-label profile-url">Channel&nbsp;URL</span>
                <span class="url-content responsive-content">twitch.tv/{{ this.user }}</span>
            </p>
        </div>

        <div style="margin-top: auto;" class="column is-3">
            <p>
                <span class="profile-label profile-subscribers">Followers/Likes</span>
                <span v-text="twitchData.followers" class="subscribers-content responsive-content"></span>
            </p>
        </div>

        <div class="column is-1" style="margin-top:auto;">
            <button 
                v-if="this.edit"
                v-on:click="deleteStream()" 
                class="button delete-button"
            > X 
            </button>
        </div>

    </div>

</div>

</template>

<script>
export default {
    
    mounted() {
        this.getTwitchData();
        this.getTwitchStreams();

        setInterval(function () {
            this.getTwitchStreams();
        }.bind(this), 180000);
    },

    data(){
        return {
            twitchData: [],
            twitchStreams: []
        }
    },
    
    props:['user','url', 'streamID', 'edit'],
    
    methods: {

        getTwitchData: function(){
            
            var config = {
                headers: {
                  'Authorization':'Bearer vxhw5saueuzgua081hvwwn488r6vrx',
                  'Client-ID':'4grvyfvizg1pgmvzgi5ywmvoh923fk'  
                }
            }

            axios_cors.get( 'https://api.twitch.tv/kraken/channels/' + this.user, config )
                .then( response => this.twitchData = response.data );

        },
        getTwitchStreams: function(){
            
            var config = {
                headers: {
                  'Authorization':'Bearer vxhw5saueuzgua081hvwwn488r6vrx',
                  'Client-ID':'4grvyfvizg1pgmvzgi5ywmvoh923fk'  
                }
            }

            axios_cors.get( 'https://api.twitch.tv/kraken/streams/' + this.user, config )
                .then( response => this.twitchStreams = response.data );

        },

        deleteStream: function() {
            var confirmation = confirm("Delete This Stream?");
                
            if (confirmation == true) {
                //Carry Out the Delete Operation
                axios.delete('/api/streams/' + this.streamID )
                    .then( location.reload() );
            }  
            else {
                // Do Nothing
            }
        } 


    }

}
</script>

<style scoped>

    .now-live, .now-offline {
        position: absolute;
        margin-top: 40px;
        vertical-align: middle;
        margin-left: 10px;
    }

</style>