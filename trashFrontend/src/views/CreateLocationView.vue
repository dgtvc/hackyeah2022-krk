<script setup lang="ts">
import BaseMap from "@/components/BaseMap.vue";
import NewPlaceForm from "@/components/form/NewPlaceForm.vue";

function createLocation(val: any) {
  console.log(val);
}
</script>

<template>
  <v-container fluid class="pb-0">
    <v-row class="app-row">
      <v-col cols="4" class="no-padding">
        <v-container>
          <div class="ml-4 mt-6 mb-2">
            <h1>Add new place</h1>
            <v-divider />
          </div>

          <NewPlaceForm @submit="createLocation" />
        </v-container>
      </v-col>

      <v-col cols="8" class="no-padding">
        <BaseMap
          :map-config="{
            center: {
              lat: 50.049683,
              lng: 19.944544,
            },
            zoom: 12,
          }"
        ></BaseMap>
      </v-col>
    </v-row>
  </v-container>
</template>
