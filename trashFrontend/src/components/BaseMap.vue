<script setup lang="ts">
import { ref, onMounted, defineProps } from "vue";
import type { Ref } from "vue";
import { Loader } from "@googlemaps/js-api-loader";

const props = defineProps({
  mapConfig: Object,
  apiKey: String,
});

const map: Ref<google.maps.Map | null> = ref(null);
const googleMapElement: Ref<HTMLElement | null> = ref(null);

onMounted(async () => {
  const googleMapApiLoader = new Loader({
    apiKey: import.meta.env.VITE_MAP_API_KEY,
  });

  const google = await googleMapApiLoader.load();

  if (!googleMapElement.value) return;

  map.value = new google.maps.Map(
    googleMapElement.value,
    props.mapConfig || {}
  );
});
</script>

<template>
  <div ref="googleMapElement" class="google-map" />
</template>

<style>
.google-map {
  height: calc(100vh - 64px);
}
</style>
