<template>
        <div>
            <markdown-editor v-model="body" ref="markdownEditor"></markdown-editor>
            <v-btn color="green" dark @click="submit">Reply</v-btn>
        </div>       
   
</template>

<script>
import markdownEditor from 'vue-simplemde/src/markdown-editor'
export default {
    props: ['path'],
    components: {
      markdownEditor
    },
    data() {
        return {
            body: ''
        }
    },
    methods: {
        submit() {
            axios.post(`/api/${this.path}/reply`,{body:this.body})
            .then(res => {
                this.body ='';
                EventBus.$emit('addReply',res.data.reply);
                window.scrollTo(0,0);
            })
        }
    }
}
</script>

<style>

</style>
