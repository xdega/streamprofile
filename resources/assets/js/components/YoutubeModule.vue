<template>

<div class="stream-feed">
            
    <div style="margin-top: 50px;" class="columns responsive-center">

        <div class="feed-header column is-3">
            <figure class="image inline-block vertical-middle">
                <img src="/img/platform_logos/youtube.png">
            </figure>
            <!--<div class="now-live inline-block">Live</div>-->
            <div class="now-offline inline-block">Offline</div>
        </div>

        <div class="column is-5">
            <p>
                <span class="profile-label profile-url">Channel&nbsp;URL</span>
                <span class="url-content responsive-content">youtube.com/xdega</span>
            </p>
        </div>

        <div class="column is-4">
            <p>
                <span class="profile-label profile-subscribers">Followers/Likes</span>
                <span class="subscribers-content responsive-content">9999+</span>
            </p>
        </div>

    </div>

</div>

</template>

<script>
export default {
    
    mounted() {
        console.log('Youtube Component mounted.')
    },
    
    props:['user','url']

}
</script>