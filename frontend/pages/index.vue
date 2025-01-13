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
import { ref, onMounted } from 'vue';
import { useFetch } from 'nuxt/app';

const bookings = ref([]);

onMounted(async () => {
  await useFetch('https://bachelor.dk:8080/sanctum/csrf-cookie', {
    credentials: 'include',
  });

  const { data, error } = await useFetch('https://bachelor.dk:8080/bookings/customers', {
    method: 'GET',
    credentials: 'include',
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
      'Accept': 'application/json',
    },
  });

  if (error.value) {
    console.error('Fandt ingen bookinger', error.value);
  } else {
    bookings.value = data.value;
  }
});
</script>
