<template>
    <div>

    </div>
</template>

<script>
export default {
  async fetch() {
    const response = await fetch('http://127.0.0.1:8000/api/bookings');
    const bookings = await response.json();

    // Log or use the fetched data
    console.log(bookings);
    this.bookings = bookings;
  },
  data() {
    return {
      bookings: []
    };
  }
};
</script>

<style lang="scss" >

</style>