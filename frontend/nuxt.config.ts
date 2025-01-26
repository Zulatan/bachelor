// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-04-03',
  devtools: { enabled: true },

  app: {
    head: {
      meta: [
        {
          name: 'csrf-token',
          content: process.env.CSRF_TOKEN || '', // Dette vil blive dynamisk injiceret fra en API eller miljøvariabel
        },
      ],
    },
  },

  // modules: ['nuxt-auth-sanctum'],

  // sanctum: {
  //   baseUrl: 'https://bachelor.dk:8080',
  // },

  runtimeConfig: {
    public: {
      apiBase: 'https://sandbox.dev.passon.dk/backend2/public',
      // apiBase: 'http://bachelor.dk:8080',
      // apiBase: 'http://127.0.0.1:8000',
      fetchOptions: {
        credentials: 'include',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
        }
      }
    }
  }
})