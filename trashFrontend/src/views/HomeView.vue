<script setup lang="ts">
import BaseMap from "@/components/BaseMap.vue";
import PlaceAutocompleteInput from "@/components/input/PlaceAutocompleteInput.vue";
import { useCategoriesStore } from "@/stores/categories";
import { useLocationStore } from "@/stores/locations";
import { reactive, onMounted, watch, computed, ref } from "vue";
import BaseCard from "@/components/base/BaseCard.vue";
import { storeToRefs } from "pinia";
import { debounce } from "lodash";

const categoriesStore = useCategoriesStore();
const locationsStore = useLocationStore();
const { locations } = storeToRefs(locationsStore);

const model = reactive({
  coordinates: {
    lat: 50.049683,
    lng: 19.944544,
  },
  name: "",
  category: [],
  recycleType: "",
  distance: 20,
});

const setLocation = (loc: google.maps.places.PlaceResult) => {
  if (!loc.geometry?.location) {
    return;
  }
  model.coordinates.lat = loc.geometry.location.lat();
  model.coordinates.lng = loc.geometry.location.lng();

  if (loc.name) {
    model.name = loc.name;
  }
};

onMounted(() => {
  categoriesStore.fetchCategories();
});

const selectedPoint = ref("");

const coords = computed(() =>
  locations.value.map(({ lat, lng, uuid }) => ({
    lat: parseFloat(lat),
    lng: parseFloat(lng),
    uuid,
    clickable: true,
  }))
);

const filteredLocations = computed(() =>
  selectedPoint.value
    ? locations.value.filter(
        (location) => location.uuid === selectedPoint.value
      )
    : locations.value
);

const selectPoint = ({ uuid }: { uuid: string }) => {
  selectedPoint.value = uuid;
};

const clearSelectedPoint = () => selectPoint({ uuid: "" });

const updateRange = debounce((value: number) => {
  model.distance = value;
}, 1000);

watch(
  () => model,
  () => {
    clearSelectedPoint();
    locationsStore.fetchPlaces(model);
  },
  { deep: true, immediate: true }
);
</script>

<template>
  <v-container fluid class="pb-0">
    <v-row class="app-row">
      <v-col cols="3">
        <section class="left-bar v-theme--light">
          <v-card-text>
            <h2 class="text-h6 mb-2">Location</h2>
            <PlaceAutocompleteInput @select="setLocation" />
          </v-card-text>
          <v-card-text>
            <h2 class="text-h6 mb-2">Trash types</h2>

            <v-chip-group
              v-model="model.category"
              column
              multiple
              selected-class="bg-primary"
            >
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

            <v-btn-toggle color="primary" v-model="model.recycleType">
              <v-btn
                size="small"
                v-for="item in categoriesStore.recycleCategories"
                :key="item.uuid"
                :value="item.uuid"
              >
                {{ item.name }}
              </v-btn>
            </v-btn-toggle>
          </v-card-text>
          <v-card-text>
            <h2 class="text-h6 mb-5">Distance</h2>
            <v-slider
              color="primary"
              step="1"
              thumb-size="12"
              thumb-label
              min="1"
              max="50"
              :value="model.distance"
              @update:modelValue="updateRange"
            ></v-slider>
          </v-card-text>
          <v-card-text>
            <h2 class="text-h6 mb-2">Options</h2>

            <v-switch
              class="primary--text"
              :dark="false"
              inset
              label="Only paid offers"
            ></v-switch>
          </v-card-text>
        </section>
      </v-col>
      <v-col cols="6" class="no-padding">
        <BaseMap
          :map-config="{
            center: model.coordinates,
            zoom: 12,
          }"
          :markers="coords"
          @selected-point="selectPoint"
        />
      </v-col>
      <v-col cols="3">
        <section class="right-bar">
          <v-fade-transition group mode="out-in">
            <div v-if="!filteredLocations.length" class="info pa-2">
              <h2 class="pb-4">No results found</h2>
              <p class="font-weight-light text-center pb-4">
                We did not found any places. Try to change search criterias.
              </p>
              <v-icon size="80" large color="green darken-4"
                >mdi-map-search
              </v-icon>
            </div>
            <BaseCard
              v-for="location in filteredLocations"
              :key="location.uuid"
              :title="location.title || ''"
              :description="location.description || ''"
              :recycle-type-uuid="location.recycle_type_uuid"
            />
          </v-fade-transition>
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
.right-bar,
.left-bar {
  max-height: calc(100vh - 76px);
  overflow-y: auto;
}
.v-col {
  padding-bottom: 0 !important;
}
.info {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.v-switch__track {
  color: #28965a;
}
</style>
