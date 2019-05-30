<template>
    <v-form @submit.prevent="create">
    <v-container>
          <span class="red--text" v-if="errors.title">{{errors.title[0]}}</span>
          <v-text-field
            v-model="form.title"
            type="text"
            label="Title"
            required
          ></v-text-field>
           <span class="red--text" v-if="errors.category_id">{{errors.category_id[0]}}</span>
          <v-autocomplete
            :items="categories"
            v-model="form.category_id"
            item-text="name"
            item-value="id"
            label="Category"
            autocomplete
          >

          </v-autocomplete>
          <span class="red--text" v-if="errors.body">{{errors.body[0]}}</span>
          <markdown-editor v-model="form.body" ref="markdownEditor"></markdown-editor>
          
        <v-btn
            color="green"
            type="submit"
            :disabled = "disabled"
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
    computed: {
        disabled() {
            return !(this.form.title && this.form.category_id && this.form.body);
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
