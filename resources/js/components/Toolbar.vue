<template>
    <v-toolbar>
    <!-- <v-toolbar-side-icon></v-toolbar-side-icon> -->
    <v-toolbar-title>MyForumApp</v-toolbar-title>
    <v-spacer></v-spacer>
    <div>
    <v-toolbar-items class="hidden-sm-and-down">
      <v-btn flat>Forum</v-btn>
      <v-btn flat>Ask Questions</v-btn>
      <v-btn flat>Category</v-btn>
      <router-link to="/login">
        <v-btn flat>Login</v-btn>
      </router-link>
    </v-toolbar-items>
    </div>
    </v-toolbar>
</template>

<script>
export default {

}
</script>

<style>

</style>
