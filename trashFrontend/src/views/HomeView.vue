<script setup lang="ts">
import BaseMap from "@/components/BaseMap.vue";
import PlaceAutocompleteInput from "@/components/input/PlaceAutocompleteInput.vue";
import { ref, reactive } from "vue";

const selectedTrashTypes = ref([1, 4]);
const selectedRecycleType = ref(1);
const coordiantes = reactive({
  lat: 50.049683,
  lng: 19.944544,
});
const setLocation = (loc: google.maps.places.PlaceResult) => {
  if (!loc.geometry?.location) {
    return;
  }
  coordiantes.lat = loc.geometry.location.lat();
  coordiantes.lng = loc.geometry.location.lng();
};
</script>

<template>
  <v-container fluid>
    <v-row class="app-row">
      <v-col cols="4">
        <section class="leftBar">
          <v-card-text>
            <h2 class="text-h6 mb-2">Location</h2>
            <PlaceAutocompleteInput @select="setLocation" />
          </v-card-text>
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
              <v-chip filter outlined> Recycle </v-chip>
              <v-chip filter outlined> Repair </v-chip>
              <v-chip filter outlined> Reprocess </v-chip>
            </v-chip-group>
          </v-card-text>
          <v-card-text>
            <h2 class="text-h6 mb-2">Options</h2>

            <!-- <v-icon large color="green darken-2">mdi-currency-usd</v-icon> -->
            <v-switch inset label="Only paid offers"></v-switch>
          </v-card-text>
        </section>
      </v-col>
      <v-col cols="8" class="no-padding">
        <BaseMap
          :map-config="{
            center: coordiantes,
            zoom: 12,
          }"
          :markers="[
            {
              lat: 50.049683,
              lng: 19.944544,
            },
            {
              lat: 49.9834763,
              lng: 20.0537965,
              draggable: true,
            },
          ]"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<style>
.no-padding {
  padding: 0 !important;
}
.app-row.v-row {
  margin: -16px;
}
</style>
