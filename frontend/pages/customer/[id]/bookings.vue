<template>
    <div>
        <h1>Customer Bookings</h1>
        <ul v-if="bookings.length">
        <li v-for="booking in bookings" :key="booking.id">
            Booking Time: {{ booking.bookingTime }}
        </li>
        </ul>
        <p v-else>No bookings found.</p>
    </div>
</template>

<script>
export default {
    async asyncData({ $axios, params }) {
        try {
            // Fetch customer bookings using their ID
            const bookings = await $axios.$get(`/customer/${params.id}/bookings`);
            return { bookings };
        } catch (error) {
            console.error(error);
            return { bookings: [] }; // Return empty array if API fails
        }
    },
};
</script>
