<script setup lang="ts">
import { RouterView } from "vue-router";

import AppNavigation from "./components/app/AppNavigation.vue";
import AppLogo from "./components/app/AppLogo.vue";
</script>

<template>
  <v-layout>
    <v-app-bar :elevation="1">
      <AppLogo />
      <v-spacer />
      <AppNavigation />
    </v-app-bar>
    <v-main>
      <RouterView />
    </v-main>
  </v-layout>
</template>
