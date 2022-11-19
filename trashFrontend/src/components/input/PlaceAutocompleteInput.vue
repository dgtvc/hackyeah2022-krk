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

const emit = defineEmits(["select"]);

const autocompleteInstance = ref();
const selectedPlace = ref();
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
  const input = document.querySelector("#autocompleteInput");

  loader.load().then((google) => {
    autocompleteInstance.value = new google.maps.places.Autocomplete(
      input,
      options
    );

    autocompleteInstance.value.addListener("place_changed", () => {
      const place = autocompleteInstance.value.getPlace();

      selectedPlace.value = place;
    });
  });
}

watch(selectedPlace, () => {
  emit("select", selectedPlace.value);
});

onMounted(() => {
  initializeAutocomplete();
});
</script>
