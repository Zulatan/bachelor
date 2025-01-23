<template>
    <div>
        <h2>Opret en bruger</h2>
        <form @submit.prevent="register">
        <input v-model="name" type="text" placeholder="Navn" required />
        <input v-model="email" type="email" placeholder="Email" required />
        <input v-model="password" type="password" placeholder="Kodeord" required />
        <button type="submit">Opret Bruger</button>
        </form>
        <p v-if="message">{{ message }}</p>
    </div>
</template>
  
<script setup>
definePageMeta({
  layout: 'custom'
});
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const name = ref('');
const email = ref('');
const password = ref('');
const message = ref('');
const router = useRouter();
const config = useRuntimeConfig();
const apiBase = config.public.apiBase;

async function register() {
    try {
        const response = await fetch(`${apiBase}/api/register`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ name: name.value, email: email.value, password: password.value })
        });

        const data = await response.json();

        if (response.ok) {
            message.value = 'Bruger oprettet! Du kan nu logge ind.';
            router.push('/login');
        } else {
            message.value = data.message || 'Noget gik galt.';
        }

    } catch (error) {
        message.value = 'Serverfejl, prøv igen senere.';
    }
}
</script>
  
  <style scoped>
  input {
    display: block;
    margin-bottom: 10px;
    padding: 5px;
  }
  button {
    background-color: blue;
    color: white;
    padding: 5px 10px;
    border: none;
    cursor: pointer;
  }
  </style>
  