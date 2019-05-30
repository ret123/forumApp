<template>
    <div class="text-xs-center">
        <v-menu offset-y>
             <v-btn icon slot="activator">
                <v-icon :color="color"> add_alert</v-icon>{{unread.length}}
            </v-btn>
            <v-list>
                 
                <v-list-tile v-for =" item in unread" :key="item.id">
                    <router-link :to="item.path">
                        <v-list-tile-title @click="readNotification(item)">{{item.question}}</v-list-tile-title>
                    </router-link>
                    
                </v-list-tile>
               
                <v-divider></v-divider>
               
                    <!-- <v-list-tile v-for =" item in read" :key="item.id">
                         
                        <v-list-tile-title >{{item.question}}</v-list-tile-title>
                       
                    </v-list-tile>
                 -->
                
            </v-list>
        </v-menu>
    </div>
   
</template>

<script>
export default {
    data() {
        return {
            read: {},
            unread: {},
            sound: 'http://soundbible.com/mp3/glass_ping-Go445-1207030150.mp3'
        }

    },
    computed: {
        color() {
            return this.unread.length > 0 ? "red" : "red lighten-4"
        },
        
    },
    created() {
        if(User.loggedIn()) {
            this.getNotifications();
        }
        Echo.private('App.User.' + User.userId())
            .notification((notification) => {
                this.playSound();
                this.unread.unshift(notification);
        });
    },
    methods: {

        playSound() {
            const alert  = new Audio(this.sound);
            alert.play();
        },
        getNotifications() {
            axios.get('/api/notifications')
            .then(res => {
                this.read = res.data.read;
                this.unread = res.data.unread;
            })
            .catch(error => Exception.handle(error));
        },
        readNotification(item) {
            if(User.loggedIn()) {
                axios.post('/api/markAsRead', {id: item.id})
                .then(res => {
                    this.unread.splice(item,1);
                    this.read.push(item);
                
                })
                .catch(error => Exception.handle(error));
            }
        }
    }
}
</script>

<style>

</style>
