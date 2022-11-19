<script setup lang="ts">
import BaseMap from "@/components/BaseMap.vue";
import PlaceAutocompleteInput from "@/components/input/PlaceAutocompleteInput.vue";
import { useCategoriesStore } from "@/stores/categories";
import { useLocationStore } from "@/stores/locations";
import { reactive, onMounted, watch } from "vue";
import BaseCard from "@/components/base/BaseCard.vue";
import { storeToRefs } from "pinia";

const categoriesStore = useCategoriesStore();
const locationsStore = useLocationStore();
const { locations } = storeToRefs(locationsStore);

const model = reactive({
  coordinates: {
    lat: 50.049683,
    lng: 19.944544,
  },
  trashTypes: [],
  recycleTypes: [],
});

const setLocation = (loc: google.maps.places.PlaceResult) => {
  if (!loc.geometry?.location) {
    return;
  }
  model.coordinates.lat = loc.geometry.location.lat();
  model.coordinates.lng = loc.geometry.location.lng();
};

watch(
  () => model,
  () => {
    locationsStore.fetchPlaces(model);
  },
  { deep: true, immediate: true }
);

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

            <v-chip-group v-model="model.trashTypes" column multiple>
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

            <v-chip-group v-model="model.recycleTypes" column multiple>
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
            center: model.coordinates,
            zoom: 12,
          }"
          :markers="
            locations.map(({ latitude, longitude }) => ({
              lat: parseFloat(latitude),
              lng: parseFloat(longitude),
            }))
          "
        />
      </v-col>
      <v-col cols="3">
        <section class="right-bar">
          <BaseCard
            v-for="(location, key) in locations"
            :key="key"
            img-src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
            :title="location.title"
            :description="location.description"
          />
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
