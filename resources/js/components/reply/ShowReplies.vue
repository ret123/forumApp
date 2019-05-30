<template>
       <div>
            <Reply v-for="(reply,index) in content" :key="reply.id" :data="reply" :index=index>

            </Reply>
        </div>
       
   
</template>

<script>
import Reply from './Reply';
export default {
    props: ['question'],
    data() {
        return {
            content: this.question.replies
        }
    },
   
    components: {
        Reply
    },
    created() {
        this.listen();

    },
    methods: {
        listen() {
            EventBus.$on('addReply', (reply) => {
                this.content.unshift(reply);
                // EventBus.$emit('replyChanged',this.content);
               
            });
            EventBus.$on('deleteReply', (index) => {
                axios.delete(`/api/${this.question.path}/reply/${this.content[index].id}`)
                .then(res => this.content.splice(index,1));
            });
            Echo.private('App.User.' + User.userId())
                .notification((notification) => {
                this.content.unshift(notification.reply);
            });
             Echo.channel('deleteReplyChannel')
                .listen('DeleteReplyEvent', (e) => {
                 for(let i = 0; i < this.content.length; i++) {
                     if(this.content[i].id == e.id) {
                         this.content.splice(i, 1);
                     }
                 }  
             
            });
        }
    }


    
}
</script>

<style>

</style>
