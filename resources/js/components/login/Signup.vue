<template>
     <v-form @submit.prevent="signup">
    <v-container>
         <v-text-field
            v-model="form.name"
            type="text"
            label="Name"
            required
        
          ></v-text-field>
          <span class="red--text" v-if="errors.name">{{errors.name[0]}}</span>
          <v-text-field
            v-model="form.email"
            type="email"
            label="Email"
            required
          ></v-text-field>
           <span class="red--text" v-if="errors.email">{{errors.email[0]}}</span>

       
          <v-text-field
            v-model="form.password"
            type="password"
            label="Password"
            required
          ></v-text-field>
           <span class="red--text" v-if="errors.password">{{errors.password[0]}}</span>
          <v-text-field
            v-model="form.password_confirmation"
            type="password"
            label="Password Confirmation"
            required
          ></v-text-field>  
       
        <v-btn
            color="green"
            type="submit"
        >Signup
        </v-btn> 
     
    </v-container>
  </v-form>
</template>

<script>
import User from '../../helpers/User';

export default {
    data() {
        return {
            form: {
                name: null,
                email: null,
                password: null,
                password_confirmation: null
            },
            errors: {}
        }

    },
  
    methods: {
        signup() {
            axios.post('/api/auth/signup',this.form)
            .then(res => {
                User.responseAfterLogin(res);
                this.$router.push({ name: 'forum'});
            })
            .catch(err => this.errors = err.response.data.errors);
           
        }
    },
    created() {
        if(User.loggedIn()) {
             this.$router.push({ name: 'forum'});
        }
    }
}
</script>

<style>

</style>
