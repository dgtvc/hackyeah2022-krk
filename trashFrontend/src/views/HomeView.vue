<script setup lang="ts">
import { ref } from "vue";

const selectedTrashTypes = ref([1, 4]);
const selectedRecycleType = ref(1);
</script>

<template>
  <v-container>
    <v-row>
      <v-col cols="4">
        <section class="leftBar">
          <v-card-text>
            <h2 class="text-h6 mb-2">Trash types</h2>

            <v-chip-group v-model="selectedTrashTypes" column multiple>
              <v-chip filter outlined> Glass </v-chip>
              <v-chip filter outlined> Battery </v-chip>
              <v-chip filter outlined> Electronic </v-chip>
              <v-chip filter outlined> Medicines </v-chip>
            </v-chip-group>
          </v-card-text>
          <v-card-text>
            <h2 class="text-h6 mb-2">Recycle type</h2>

            <v-chip-group v-model="selectedRecycleType" column>
              <v-chip filter outlined> Glass </v-chip>
              <v-chip filter outlined> Battery </v-chip>
              <v-chip filter outlined> Electronic </v-chip>
            </v-chip-group>
          </v-card-text>
        </section>
      </v-col>
      <v-col cols="8">
        <RouterView />
      </v-col>
    </v-row>
  </v-container>
</template>

<style>
.v-selection-control {
  flex-direction: row-reverse;
}
</style>
