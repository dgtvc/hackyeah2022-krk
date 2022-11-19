<script setup lang="ts">
import { ref, onMounted, defineProps } from "vue";
import GoogleMapsApiLoader from "google-maps-api-loader";
const MAP_API_KEY = import.meta.env.VITE_MAP_API_KEY;

const props = defineProps({
  mapConfig: Object,
  apiKey: String,
});

const google = ref(null);
const map = ref(null);
const googleMap = ref(null);

const initializeMap = () => {
  if (!google.value?.maps?.Map) return;

  map.value = new google.value.maps.Map(googleMap.value, props.mapConfig || {});
};

onMounted(async () => {
  const googleMapApi = await GoogleMapsApiLoader({
    apiKey: MAP_API_KEY,
  });
  google.value = googleMapApi;
  initializeMap();
});
</script>

<template>
  <div>
    <div class="google-map" ref="googleMap"></div>
    <template v-if="Boolean(google) && Boolean(map)">
      <slot :google="google" :map="map" />
    </template>
  </div>
</template>

<style>
.google-map {
  height: calc(100vh - 64px);
}
</style>
