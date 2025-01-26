<template>
  <div>
  <NuxtLayout>
    <NuxtPage />
  </NuxtLayout>

  <!-- {{ user }}

  <form @submit.prevent="onLogin()">
    <div>
      <label for="email">Email:</label>
      <input v-model="form.email" type="email">
    </div>

    <div>
      <label for="password">Password:</label>
      <input v-model="form.password" type="password">
    </div>

    <div>
      <button>Login</button>
    </div>
  </form> -->
</div>

</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRuntimeConfig } from '#app';

axios.defaults.withCredentials = true;
const config = useRuntimeConfig(); // Hent runtime config
const apiBase = config.public.apiBase; // Få adgang til API URL

const form = ref({
  email: null,
  password: null
});

const user = ref();

async function onLogin() {
  await axios.get(`${apiBase}/sanctum/csrf-cookie`);
  await axios.post(`${apiBase}/login`, {
    email: form.value.email,
    password: form.value.password,
  });

  let { data } = await axios.get(`${apiBase}/user`);
  user.value = data;
}
</script>