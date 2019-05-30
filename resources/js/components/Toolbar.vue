<template>
    <v-toolbar>
    <!-- <v-toolbar-side-icon></v-toolbar-side-icon> -->
    <v-toolbar-title>MyForumApp</v-toolbar-title>
    <v-spacer></v-spacer>
    <app-notification v-if="loggedIn"></app-notification>
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
import AppNotification from './AppNotification';
export default {
  
  components: {
    AppNotification
  },
  data() {
    return {
      loggedIn: User.loggedIn(),
      items: [
        {title: 'Forum', to: '/forum', show: true},
        {title: 'Ask Question', to: '/ask', show: User.loggedIn()},
        {title: 'Category', to: '/category', show: User.admin()},
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
