<template>
    <Navigation/>
    <div class="lg:ml-64 p-4 lg:pr-64">
        <router-view></router-view>
    </div>
</template>

<script setup>
import Navigation from '../components/admin/Navigation.vue';
</script>

<style>

</style>