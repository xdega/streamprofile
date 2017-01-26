import './bootstrap';

Vue.component( 'beam-module', require('./components/BeamModule.vue') );
Vue.component( 'twitch-module', require('./components/TwitchModule.vue') );
Vue.component( 'youtube-module', require('./components/YoutubeModule.vue') );

Vue.component( 'create-profile', require('./components/CreateProfile.vue') );
Vue.component( 'create-stream', require('./components/CreateStream.vue') );

Vue.component( 'user-profile', require('./components/UserProfile.vue') );
Vue.component( 'public-profile', require('./components/PublicProfile.vue') );
Vue.component( 'featured-profiles', require('./components/FeaturedProfiles.vue') );

const app = new Vue({
    el: '#app'
});
