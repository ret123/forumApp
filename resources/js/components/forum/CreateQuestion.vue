<template>
    <v-form @submit.prevent="create">
    <v-container>
     
          <v-text-field
            v-model="form.title"
            type="text"
            label="Title"
            required
          ></v-text-field>
       
          <v-autocomplete
            :items="categories"
            v-model="form.category_id"
            item-text="name"
            item-value="id"
            label="Category"
            autocomplete
          >

          </v-autocomplete>
          <markdown-editor v-model="form.body" ref="markdownEditor"></markdown-editor>
               
        <v-btn
            color="green"
            type="submit"
        >Ask a Question
        </v-btn> 
        
    </v-container>
  </v-form>
</template>

<script>
 import markdownEditor from 'vue-simplemde/src/markdown-editor'

export default {
    
    components: {
      markdownEditor
    },
    data() {
        return {
            form : {
                title: null,
                category_id: null,
                body: null
            },
            categories: [],
            errors: {}
        }
    },
    created() {
        axios.get('/api/category')
        .then(res => this.categories = res.data.data);
    },
    methods: {
        create() {
            axios.post('/api/question',this.form)
            .then(res => this.$router.push(res.data.path))
            .catch(err => this.errors = err.response.data.errors);
        }
    }
}
</script>

<style>
    
</style>
