<template>
    <div>
        <Toolbar></Toolbar>
        <router-view></router-view>
        <app-footer></app-footer>
    </div>
   
</template>

<script>
import Toolbar from "./Toolbar";
import AppFooter from './AppFooter';

export default {
    components : {
    Toolbar,
    AppFooter
    },
    
}
</script>
   
<style>

</style>
