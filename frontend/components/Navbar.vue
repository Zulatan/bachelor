<template>
    <nav>
        <NuxtLink to="/">Hjem</NuxtLink>
        <NuxtLink to="/dashboard">Dashboard</NuxtLink>
        <button v-if="isAuthenticated" @click="logout">Logout</button>
        <NuxtLink v-else to="/login">Login</NuxtLink>
    </nav>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const authToken = ref(localStorage.getItem('authToken'));

const isAuthenticated = computed(() => !!authToken.value);

function logout() {
    localStorage.removeItem('authToken');
    authToken.value = null;
    router.push('/login');
}
</script>

<style scoped>
    nav {
    display: flex;
    gap: 20px;
    }
    
    button {
    background: red;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    }
</style>
  