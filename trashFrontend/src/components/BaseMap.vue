<script setup lang="ts">
import { ref, onMounted, defineProps, watch, defineEmits } from "vue";
import type { Ref } from "vue";
import { Loader } from "@googlemaps/js-api-loader";

import { MAP_STYLES } from "@/constants/mapStyles";

interface Props {
  mapConfig: {
    center: {
      lat: number;
      lng: number;
    };
    zoom: number;
  };
  markers?: {
    lat: number;
    lng: number;
    uuid: string;
    draggable?: boolean;
    clickable?: boolean;
  }[];
}

const props = withDefaults(defineProps<Props>(), {
  markers: () => [],
});

const emit = defineEmits<{
  (
    event: "selectedPoint",
    payload: { position: google.maps.LatLng | null | undefined; uuid: string }
  ): void;
}>();

const map: Ref<google.maps.Map | null> = ref(null);
const googleMapElement: Ref<HTMLElement | null> = ref(null);
const onMapMarkers: Ref<google.maps.Marker[]> = ref([]);

const removeMarkers = () => {
  onMapMarkers.value.forEach((onMapMarker) => {
    onMapMarker.setMap(null);
    onMapMarker.setVisible(false);
  });
  onMapMarkers.value = [];
};

onMounted(async () => {
  const googleMapApiLoader = new Loader({
    apiKey: import.meta.env.VITE_MAP_API_KEY,
    version: "weekly",
    libraries: ["places"],
    language: "en",
  });

  const google = await googleMapApiLoader.load();

  if (!googleMapElement.value) return;

  map.value = new google.maps.Map(
    googleMapElement.value,
    { ...props.mapConfig, styles: MAP_STYLES } || {}
  );

  watch(
    () => props.mapConfig,
    (config) => {
      if (!map.value || !config) {
        return;
      }

      console.log(props.mapConfig);

      map.value.setCenter(config.center);
    },
    { deep: true }
  );

  watch(
    () => props.markers,
    (newMarkers) => {
      removeMarkers();

      newMarkers.forEach(({ lat, lng, draggable, uuid, clickable }) => {
        const marker = new google.maps.Marker({
          position: { lat, lng },
          title: "Hello World!",
          draggable,
        });

        if (clickable) {
          marker.addListener("click", () => {
            map.value?.setZoom(16);
            map.value?.setCenter(marker.getPosition() as google.maps.LatLng);
            emit("selectedPoint", { position: marker.getPosition(), uuid });
          });
        }
        onMapMarkers.value.push(marker);
        marker.setMap(map.value);
      });
    },
    { deep: true, immediate: true }
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
