<template>
    <div>
        <div class="container text-center my-5">
          <h1>App Vue front office</h1>
        </div>
        <WorkInProgress />
    </div>
</template>

<script>
import WorkInProgress from '../components/WorkInProgress.vue';
export default {
    name: 'App',
    components: {
        WorkInProgress
    }
}
</script>

<style>
</style> 