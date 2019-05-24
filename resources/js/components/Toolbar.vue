<template>
    <v-toolbar>
    <!-- <v-toolbar-side-icon></v-toolbar-side-icon> -->
    <v-toolbar-title>MyForumApp</v-toolbar-title>
    <v-spacer></v-spacer>
    <div>
    <v-toolbar-items class="hidden-sm-and-down">
     
      <router-link 
        v-for="item in showLink"
        :to= "item.to"
        :key="item.title"
        
        
        
      >
        <v-btn flat>{{item.title}}</v-btn>
      </router-link>
    </v-toolbar-items>
    </div>
    </v-toolbar>
</template>

<script>
import User from '../helpers/User';
export default {
  
  data() {
    return {
      items: [
        {title: 'Forum', to: '/forum', show: true},
        {title: 'Ask Question', to: '/ask', show: User.loggedIn()},
        {title: 'Category', to: '/category', show: User.loggedIn()},
        {title: 'Login', to: '/login', show: !User.loggedIn()},
        {title: 'Logout', to: '/logout', show: User.loggedIn()}
      ]
    }
  },
  
  computed: {
    showLink() {
      return this.items.filter(item => item.show)
    }
  },
  created() {
    EventBus.$on('logout', () => {
      User.logout();
    });
  }
}
</script>

<style>

</style>
