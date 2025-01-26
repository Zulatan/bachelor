<template>
  <div class="login-container">
    <h2>Login</h2>
    <form @submit.prevent="handleLogin">
      <div>
        <label for="email">Email:</label>
        <input v-model="email" type="email"/>
      </div>
      <div>
        <label for="password">Password:</label>
        <input v-model="password" type="password"/>
      </div>
      <div>
        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> -->
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
    
    console.log('csrf cookie:', response);


  } catch (error) {
    console.error('catch:', error);
  }
}


async function handleLogin() {
  await fetchCsrfToken(); 

  console.log('Sender login request:', {
    email: email.value,
    password: password.value
  });

  try {
    // const csrfToken = document.cookie.split(';').find(cookie => cookie.trim().startsWith('XSRF-TOKEN='));
    // const token = csrfToken ? decodeURIComponent(csrfToken.split('=')[1]) : '';

    const response = await fetch(`${apiBase}/login`, {
      method: 'POST',
      headers: { 
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        // 'X-CSRF-TOKEN': csrfToken.value,
        // 'X-CSRF-TOKEN': token,
      },
      body: JSON.stringify({ 
        email: email.value, 
        password: password.value,
      }),
      credentials: 'include', 
    });

    if (!response.ok) {
      throw new Error('Login mislykkedes');
    }

    const data = await response.json();
    console.log('Svar fra API:', data);

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
</script>

<style>

</style>