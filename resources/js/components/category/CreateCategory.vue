<template>
    <v-container>
        <v-alert
            :value="true"
            type="error"
            v-if="errors"
        >
            <div v-for=" error in errors" :key="error.index">
                {{error[0]}}
            </div>
        </v-alert>
        <v-form @submit.prevent="submit">
            <v-text-field
            label="Category Name"
            v-model="form.name"
            type="text"
            required
            >
            </v-text-field>
             <v-btn type="submit" color="orange" :disabled="disabled" v-if="editSlug">Update</v-btn>
            <v-btn type="submit" :disabled="disabled" color="teal" v-else>Create</v-btn>

            <v-card class="mt-4">
                <v-toolbar color="indigo" dark dense>
                    <v-toolbar-title>
                        Categories
                    </v-toolbar-title>
                </v-toolbar>
                <v-list>
                    <div v-for="(category,index) in categories" :key="category.id">
                        <v-list-tile >
                            <v-list-tile-action>
                                <v-btn icon small @click="edit(index)">
                                <v-icon color="orange">edit</v-icon>
                            </v-btn>
                            </v-list-tile-action>
                                
                            <v-list-tile-content>
                                <v-list-tile-title> {{category.name}}</v-list-tile-title>
                            
                            </v-list-tile-content>
                            <v-list-tile-action>
                                <v-btn icon small @click="deleteCategory(category.slug,index)">
                                    <v-icon color="red">delete</v-icon>
                                </v-btn>
                            </v-list-tile-action>
                        </v-list-tile>
                        <v-divider></v-divider>
                    </div>
                   
                </v-list>
            </v-card>
        </v-form>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            form: {
                name: null  
            },
            categories: {},
            errors: null,
            editSlug: null

        }
    },
    computed: {
        disabled() {
            // return !this.form.name;
        }
    },
    created() {
         if(!User.admin()) {
             this.$router.push('forum');
         }
         axios.get('/api/category')
        .then(res => this.categories = res.data.data)
        .catch(err => this.errors = err.response.data.errors)
    },
    methods: {
        
        submit() {
            this.editSlug ? this.update() : this.create()
           
        },
        create() {
             axios.post('/api/category',this.form)
             .then(res => { 
                this.categories.unshift(res.data);
                this.form.name = null;
            })
            .catch(err => this.errors = err.response.data.errors);
        },
        update() {
            axios.patch(`/api/category/${this.editSlug}`, this.form)
            .then(res => { 
                this.categories.unshift(res.data);
                this.form.name = null;
            })
        },
        deleteCategory(slug,index) {
            axios.delete(`/api/category/${slug}`)
            .then(res => this.categories.splice(index,1))
            .catch(err => this.errors = err.response.data.errors);
        },
        edit(index) {
            this.form.name = this.categories[index].name;
            this.editSlug = this.categories[index].slug;
            this.categories.splice(index,1);
        }
    }
}
</script>

<style>

</style>
