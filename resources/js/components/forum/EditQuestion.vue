<template>
     <v-form @submit.prevent="update">
    <v-container fluid>
        <v-card>
     
          <v-text-field
            v-model="form.title"
            type="text"
            label="Title"
            required
          ></v-text-field>
       
                 
          <markdown-editor v-model="form.body" ref="markdownEditor"></markdown-editor>
        <v-card-actions>
            <v-btn icon small type="submit">
                <v-icon color="teal">save</v-icon>
            </v-btn>
            <v-btn icon small @click="cancel">
                <v-icon>cancel</v-icon>
            </v-btn>
        </v-card-actions>
        </v-card>
    </v-container>
  </v-form>
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
            form: {
                title: null,
                body: null
            }
        }
    },
    created() {
        this.form = this.data;
    },
    methods: {
        cancel() {
            EventBus.$emit('cancelEditing');
        },
        update() {
            axios.patch(`/api/${this.form.path}`, this.form)
            .then(res => this.cancel())
            
        }
    }
}
</script>

<style>

</style>
