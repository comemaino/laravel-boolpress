<template>
    <div>
        <Header />
        <router-view></router-view>
        
    </div>
</template>

<script>
import Header from "../components/Header.vue";
// import Posts from '../components/Posts.vue';
export default {
    name: 'App',
    components: {
        Header
    }
}
</script>

<style>
</style> 