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
import { useRuntimeConfig } from 'nuxt/app';

const bookings = ref([]);
const config = useRuntimeConfig();
const apiBase = config.public.apiBase;

onMounted(async () => {
  console.log('onmount kører', apiBase);
  console.log('config:', config);
  
  const { data, error } = await useFetch(`${apiBase}/bookings/customers`, {
    credentials: 'include',
    headers: {
      
    }
  });

  if (error.value) {
    console.error('Fandt ingen bookinger', error.value);
  } else {
    bookings.value = data.value;
  }
});
</script>
