<template>
    <div>
    <NuxtLayout></NuxtLayout>
    <h1>Bookings</h1>
    <ul>
        <li v-for="booking in bookings" :key="booking.id">
          <p>
            {{ booking.user.name }} - {{ booking.scheduled_time }}
          </p>
        </li>
    </ul>
    </div>
</template>

<script setup>
import { useFetch } from 'nuxt/app';

// Hent CSRF-cookie før GET-forespørgsel
const cookie = await useFetch('https://bachelor.dk:8080/sanctum/csrf-cookie', {
  credentials: 'include' // Sørg for, at cookies sendes
});

console.log('cookie:', cookie);

// Foretag GET-forespørgsel med cookies
const { data: bookings, error } = await useFetch('https://bachelor.dk:8080/bookings/customers', {
  method: 'GET',
  credentials: 'include', 
  headers: {
    'X-Requested-With': 'XMLHttpRequest', 
    'Accept': 'application/json',
  },
});

if (error.value) {
    console.error('fandt ingen bookinger', error.value);
}


</script>

<style lang="scss">


</style>