<script setup lang="ts">
import { RouterView } from "vue-router";

import AppNavigation from "./components/app/AppNavigation.vue";
</script>

<template>
  <v-layout>
    <v-app-bar :elevation="1">
      <v-spacer />
      <AppNavigation />
    </v-app-bar>
    <v-main>
      <RouterView />
    </v-main>
  </v-layout>
</template>
