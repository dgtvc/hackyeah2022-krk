<script setup lang="ts">
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
  <v-layout>
    <v-app-bar :elevation="1">
      <RouterLink :to="{ name: 'home' }">Home</RouterLink>
      <RouterLink :to="{ name: 'add-new-location' }">Add new</RouterLink>
    </v-app-bar>
    <v-main>
      <RouterView />
    </v-main>
  </v-layout>
</template>
