<template>
   <v-form @submit.prevent="login">
    <v-container>
     
          <v-text-field
            v-model="form.email"
            type="email"
            label="Email"
            required
          ></v-text-field>
       

       
          <v-text-field
            v-model="form.password"
            type="password"
            label="Password"
            required
          ></v-text-field>
       

       
        <v-btn
            color="green"
            type="submit"
        >Login
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
                email: null,
                password: null
            }
        }
    },
    methods: {
        login() {
           User.login(this.form);
        }
    }
}
</script>

<style>

</style>
