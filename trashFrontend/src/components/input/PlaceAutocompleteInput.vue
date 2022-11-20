<template>
  <v-text-field
    v-model="searchValue"
    id="autocompleteInput"
    label="Search"
    outlined
  />
</template>

<script setup lang="ts">
import { Loader } from "@googlemaps/js-api-loader";
import { defineEmits, onMounted, ref, watch } from "vue";

const emit = defineEmits<{
  (event: "select", payload: google.maps.places.PlaceResult): void;
}>();

const autocompleteInstance = ref();
const selectedPlace = ref<google.maps.places.PlaceResult>();
const searchValue = ref("");

const loader = new Loader({
  apiKey: import.meta.env.VITE_MAP_API_KEY,
  version: "weekly",
  libraries: ["places"],
  language: "en",
});

const options = {
  fields: ["geometry", "name"],
  strictBounds: false,
  types: ["establishment"],
};

function initializeAutocomplete() {
  const input = document.querySelector<HTMLInputElement>("#autocompleteInput");

  if (!input) return;

  loader.load().then((google) => {
    autocompleteInstance.value = new google.maps.places.Autocomplete(
      input,
      options
    );

    autocompleteInstance.value.addListener("place_changed", () => {
      const place = autocompleteInstance.value.getPlace();

      selectedPlace.value = place;
    });
    window.ac = autocompleteInstance.value;
  });
}

watch(selectedPlace, (value) => {
  if (value) {
    emit("select", value);
  }
});

onMounted(() => {
  initializeAutocomplete();
});
</script>
