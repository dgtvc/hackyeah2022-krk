<script setup lang="ts">
import BaseMap from "@/components/BaseMap.vue";
import PlaceAutocompleteInput from "@/components/input/PlaceAutocompleteInput.vue";
import { useCategoriesStore } from "@/stores/categories";
import { ref, reactive, onMounted } from "vue";

const categoriesStore = useCategoriesStore();

const selectedTrashTypes = ref([]);
const selectedRecycleTypes = ref([]);
const coordinates = reactive({
  lat: 50.049683,
  lng: 19.944544,
});
const setLocation = (loc: google.maps.places.PlaceResult) => {
  if (!loc.geometry?.location) {
    return;
  }
  coordinates.lat = loc.geometry.location.lat();
  coordinates.lng = loc.geometry.location.lng();
};

onMounted(() => {
  categoriesStore.fetchCategories();
});
</script>

<template>
  <v-container fluid class="pb-0">
    <v-row class="app-row">
      <v-col cols="3">
        <section class="leftBar">
          <v-card-text>
            <h2 class="text-h6 mb-2">Location</h2>
            <PlaceAutocompleteInput @select="setLocation" />
          </v-card-text>
          <v-card-text>
            <h2 class="text-h6 mb-2">Trash types</h2>

            <v-chip-group v-model="selectedTrashTypes" column multiple>
              <v-chip
                filter
                outlined
                v-for="category in categoriesStore.trashCategories"
                :key="category.uuid"
                :value="category.uuid"
              >
                {{ category.name }}
              </v-chip>
            </v-chip-group>
          </v-card-text>
          <v-card-text>
            <h2 class="text-h6 mb-2">Recycle type</h2>

            <v-chip-group v-model="selectedRecycleTypes" column>
              <v-chip
                filter
                outlined
                v-for="category in categoriesStore.recycleCategories"
                :key="category.uuid"
                :value="category.uuid"
              >
                {{ category.name }}
              </v-chip>
            </v-chip-group>
          </v-card-text>
          <v-card-text>
            <h2 class="text-h6 mb-2">Options</h2>

            <v-switch inset label="Only paid offers"></v-switch>
          </v-card-text>
        </section>
      </v-col>
      <v-col cols="6" class="no-padding">
        <BaseMap
          :map-config="{
            center: coordinates,
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
      <v-col cols="3">
        <section class="right-bar">
          <v-card color="#d3d3d3" class="mb-3">
            <v-img
              height="150"
              src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
              cover
            ></v-img>

            <v-card-title>Cafe Badilico</v-card-title>

            <v-card-text>
              <div>
                Small plates, salads & sandwiches - an intimate setting with 12
                indoor seats plus patio seating.
              </div>
            </v-card-text>

            <v-card-actions>
              <v-btn color="lighten-2" text> More details </v-btn>
            </v-card-actions>
          </v-card>
          <v-card color="#d3d3d3">
            <v-img
              height="150"
              src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
              cover
            ></v-img>

            <v-card-title>Cafe Badilico</v-card-title>

            <v-card-text>
              <div>
                Small plates, salads & sandwiches - an intimate setting with 12
                indoor seats plus patio seating.
              </div>
            </v-card-text>

            <v-card-actions>
              <v-btn color="lighten-2" text> More details </v-btn>
            </v-card-actions>
          </v-card>
        </section>
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
.right-bar {
  max-height: calc(100vh - 76px);
  overflow-y: auto;
}
.v-col {
  padding-bottom: 0 !important;
}
</style>
