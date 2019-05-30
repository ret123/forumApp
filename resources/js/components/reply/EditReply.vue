<template>
    <div>
        <markdown-editor v-model="data.reply" ref="markdownEditor"></markdown-editor>
        <v-btn icon small>
            <v-icon color="green" @click="update">save</v-icon>
        </v-btn>
        <v-btn icon small>
            <v-icon color="black" @click="cancel">cancel</v-icon>
        </v-btn>
</div>
</template>

<script>
import markdownEditor from 'vue-simplemde/src/markdown-editor';
export default {
    props: ['data'],
    components: {
      markdownEditor
    },
    data() {
        return {
            body: this.data.reply
        }
        
    },
    methods: {
        update() {
            axios.patch(`/api/question/${this.data.question_slug}/reply/${this.data.id}`, {body: this.body})
            .then(res => this.cancel())
        },
        cancel() {
            EventBus.$emit('cancelEditing');
        }
    }
}
</script>

<style>

</style>
