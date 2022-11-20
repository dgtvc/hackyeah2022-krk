<script setup lang="ts"></script>
<template>
  <v-btn color="primary" class="font-weight-medium" :to="{ name: 'home' }">
    Home
  </v-btn>
  <v-btn
    color="primary"
    class="font-weight-bold"
    :to="{ name: 'add-new-location' }"
  >
    Add new
  </v-btn>
</template>
