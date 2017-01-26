<template>

<div class="stream-feed">
            
    <div style="margin-top: 20px;" class="columns responsive-center">

        <div class="feed-header column is-3">
            <figure class="image inline-block vertical-middle">
                <img src="/img/platform_logos/beam.png">
            </figure>
            <div v-if="beamData.online == true" class="now-live inline-block">Live</div>
            <div v-else class="now-offline inline-block">Offline</div>
        </div>

        <div class="column is-5">
            <p>
                <span class="profile-label profile-url">Channel&nbsp;URL</span>
                <span class="url-content responsive-content">beam.pro/{{ this.user }}
                </span>
            </p>
        </div>

        <div class="column is-3">
            <p>
                <span class="profile-label profile-subscribers">Followers/Likes</span>
                <span v-text="beamData.numFollowers" class="subscribers-content responsive-content"></span>
            </p>
        </div>

        
        <div class="column is-1">
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

        this.getBeamData();

        setInterval(function () {
            this.getBeamData();
        }.bind(this), 180000); 

    },

    data() {
        return {
            beamData: []
        }
    },
    
    props:['user','url', 'streamID', 'edit'],

    methods: {

        getBeamData: function(){
    

            axios_cors.get( 'https://beam.pro/api/v1/channels/' + this.user )
                .then( response => this.beamData = response.data );

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