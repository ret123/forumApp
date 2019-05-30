<template>
    <v-btn icon @click="likeIt">
        <v-icon color="red">favorite</v-icon>{{count}}
    </v-btn>
</template>

<script>
export default {
    props: ['data'],
    data() {
        return {
            liked: this.data.liked,
            count: this.data.like_count,
        }
        
    },
    created() {
        Echo.channel('likeChannel')
            .listen('LikeEvent', (e) => {
               
             if(this.data.id == e.id) {
                 e.type == 1 ? this.count++ : this.count--;
             }
        });
    },
    methods: {
        likeIt() {
            if(User.loggedIn()) {
                this.liked ? this.dec() : this.inc()
                this.liked = !this.liked;
            }
        },
        inc() {
            axios.post(`/api/like/${this.data.id}`)
            .then(res => this.count++)
            .catch(err =>console.log(err.response.data)) 
            
        },
        dec() {
            axios.delete(`/api/like/${this.data.id}`)
            .then(res => this.count--)
            .catch(err =>console.log(err.response.data)) 
        }
    },
    
}
</script>

<style>

</style>
