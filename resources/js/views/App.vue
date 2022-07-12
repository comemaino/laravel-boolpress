<template>
    <div>
        <div class="container text-center my-5">
          <h1>App Vue front office</h1>
        </div>
        <Posts />
    </div>
</template>

<script>
import Posts from '../components/Posts.vue';
export default {
    name: 'App',
    components: {
        Posts
    }
}
</script>

<style>
</style> 