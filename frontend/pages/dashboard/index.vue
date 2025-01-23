<template>
    <div>
        <h1>Velkommen til Dashboardet</h1>
        <p v-if="user">Hej {{ user.name }}</p>
        <p v-else>Indlæser brugerdata...</p>
        <button @click="logout">Logout</button>
    </div>
</template>

<script setup>
definePageMeta({
  layout: 'default'
})
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';


const user = ref(null);
const router = useRouter();
const config = useRuntimeConfig();
const apiBase = config.public.apiBase;

console.log('api nøgle:', apiBase);

async function getUserData() {
    const token = localStorage.getItem('authToken');

    if (!token) {
        router.push('/login');
        return;
    }

    try {
        const response = await fetch(`${apiBase}/api/user`, {
        headers: { 'Authorization': `Bearer ${token}` }
        });

        if (!response.ok) {
            throw new Error('Ugyldigt token');
        }

        user.value = await response.json();
        console.log('bruger info:', user.value);

    } catch (error) {
        localStorage.removeItem('authToken');
        router.push('/login');
    }
}

function logout() {
    localStorage.removeItem('authToken');
    router.push('/login');
}

onMounted(getUserData);
</script>
