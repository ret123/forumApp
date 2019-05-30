<template>
    <div v-if="question">
        <edit-question
        v-if="editing" 
        :data=question>
        </edit-question>
        
        <show-question
        :data = question
        v-else
        >
        </show-question>
        <v-container fluid>
            <show-replies :question="question"></show-replies>
            <create-reply v-if="loggedIn" :path="question.path"></create-reply>
            <div class="mt-4" v-else>
                <router-link to="/login">Login to reply</router-link>
            </div>
        </v-container>
       
    </div>
</template>

<script>
import ShowQuestion from './ShowQuestion';
import EditQuestion from './EditQuestion';
import ShowReplies from '../reply/ShowReplies';
import CreateReply from '../reply/CreateReply';

export default {
    components: {
        ShowQuestion,
        EditQuestion,
        ShowReplies,
        CreateReply
    },
    data() {
        return {
            question: null,
            editing: false
        }
    },
    computed: {
        loggedIn() {
            return User.loggedIn();
        }
    },
    created() {
        this.listen();
        axios.get(`/api/question/${this.$route.params.slug}`)
        .then(res => this.question = res.data.data)
        .catch(error => console.log(error.response.data));
        
    },
    methods: {
        listen() {
            EventBus.$on('startEditing', () => {
                this.editing = true;
            });
            EventBus.$on('cancelEditing', () => {
                this.editing = false;
            });
            // EventBus.$on('replyChanged', (replies) => {
            //     this.question.replies = replies;
            //     console.log(this.question.replies);
            // })
           
        }
    }

}
</script>

<style>

</style>
