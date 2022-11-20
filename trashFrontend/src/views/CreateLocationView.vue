<script setup lang="ts">
import BaseMap from "@/components/BaseMap.vue";
import NewPlaceForm from "@/components/form/NewPlaceForm.vue";
import { reactive } from "vue";

function createLocation(val: any) {
  console.log(val);
}

const markerLocation = reactive({
  lat: 50.049683,
  lng: 19.944544,
  uuid: "sample",
  draggable: true,
});

const centerLocation = reactive({
  lat: 50.049683,
  lng: 19.944544,
});

const setMarkerLocation = (loc: google.maps.places.PlaceResult) => {
  if (!loc.geometry?.location) {
    return;
  }
  centerLocation.lat = markerLocation.lat = loc.geometry.location.lat();
  centerLocation.lng = markerLocation.lng = loc.geometry.location.lng();
};
</script>

<template>
  <v-container fluid class="pb-0">
    <v-row class="app-row">
      <v-col cols="4" class="no-padding fixed-height">
        <v-container>
          <div class="ml-4 mt-6 mb-2">
            <h1>Add new place</h1>
            <v-divider />
          </div>

          <NewPlaceForm
            @submit="createLocation"
            @selectLocation="setMarkerLocation"
          />
        </v-container>
      </v-col>

      <v-col cols="8" class="no-padding">
        <BaseMap
          :markers="[markerLocation]"
          :map-config="{
            center: centerLocation,
            zoom: 12,
          }"
        ></BaseMap>
      </v-col>
    </v-row>
  </v-container>
</template>

<style>
.fixed-height {
  max-height: calc(100vh - 76px);
  overflow-y: auto;
}
</style>
