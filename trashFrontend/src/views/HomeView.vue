<script setup lang="ts">
import { ref } from "vue";

const amenities = ref([1, 4]);
</script>

<template>
  <v-container>
    <v-row>
      <v-col cols="3">
        <section class="leftBar">
          <v-card-text>
            <h2 class="text-h6 mb-2">Choose amenities</h2>

            <v-chip-group v-model="amenities" column multiple>
              <v-chip filter outlined> Elevator </v-chip>
              <v-chip filter outlined> Washer / Dryer </v-chip>
              <v-chip filter outlined> Fireplace </v-chip>
              <v-chip filter outlined> Wheelchair access </v-chip>
              <v-chip filter outlined> Dogs ok </v-chip>
              <v-chip filter outlined> Cats ok </v-chip>
            </v-chip-group>
          </v-card-text>
        </section>
      </v-col>
      <v-col cols="9">
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
