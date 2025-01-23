<template>
  <div class="login-container">
    <h2>Login</h2>
    <form @submit.prevent="handleLogin">
      <div>
        <label for="email">Email:</label>
        <input v-model="email" type="email" id="email" required />
      </div>
      <div>
        <label for="password">Password:</label>
        <input v-model="password" type="password" id="password" required />
      </div>
      <button type="submit">Login</button>
    </form>
    <p v-if="errorMessage" class="error">{{ errorMessage }}</p>
  </div>
</template>

<script setup>
definePageMeta({
  layout: 'custom'
});

import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useRuntimeConfig } from 'nuxt/app';

const email = ref('');
const password = ref('');
const errorMessage = ref('');
const router = useRouter();
const config = useRuntimeConfig();

const apiBase = config.public.apiBase;
// console.log('api nøgle:', apiBase);

const csrfToken = ref('');

async function fetchCsrfToken() {
  try {
    const response = await fetch(`${apiBase}/sanctum/csrf-cookie`, {
      method: 'GET',
      credentials: 'include',
    });

    if (!response.ok) {
      throw new Error('Kunne ikke hente CSRF-Token');
    }

    const text = await response.text();
    console.log('csrf-cookie response tekst:', text);

    // const data = await response.json();
    // console.log('csrf-token i try:', data.token);
  } catch (error) {
    console.error('catch:', error);
  }
}


async function handleLogin() {
  await fetchCsrfToken(); 

  try {
    const response = await fetch(`${apiBase}/login`, {
      method: 'POST',
      headers: { 
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken.value || '', 
      },
      body: JSON.stringify({ 
        email: email.value, 
        password: password.value,
      }),
      credentials: 'include', 
    });

    // Tjek om svaret er JSON
    if (!response.ok) {
      throw new Error('Login mislykkedes');
    }

    // Hvis svaret er JSON, pars det
    const data = await response.json();
    console.log('Login succes:', data);

    if (data.token) {
      localStorage.setItem('authToken', data.token);
      console.log('Token gemt i localstorage:', data.token);
      router.push('/dashboard'); 
    } else {
      errorMessage.value = 'Ingen token modtaget';
    }
  } catch (error) {
    errorMessage.value = `Fejl ved login: ${error.message}`;
    console.error('Fejl ved login:', error);
  }
}


// async function getUserData() {
//     const token = localStorage.getItem('authToken');

//     const response = await fetch('https://bachelor.dk/api/user', {
//         headers: { 'Authorization': `Bearer ${token}` }
//     });

//     return await response.json();
// }

// async function logout() {
// const token = localStorage.getItem('authToken');

// await fetch('http://your-laravel-api.com/api/logout', {
//     method: 'POST',
//     headers: { 'Authorization': `Bearer ${token}` }
// });

// localStorage.removeItem('authToken');
// }
</script>

<style>
.login-container {
  max-width: 300px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
  background: #f9f9f9;
}
input {
  display: block;
  width: 100%;
  margin-bottom: 10px;
  padding: 8px;
}
button {
  width: 100%;
  padding: 10px;
  background: #007bff;
  color: white;
  border: none;
  cursor: pointer;
}
.error {
  color: red;
  margin-top: 10px;
}
</style>