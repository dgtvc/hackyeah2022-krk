import { ref } from "vue";
import { defineStore } from "pinia";
import type { Location } from "@/types/location";
// import { useFetch } from "@vueuse/core";

export const useLocationStore = defineStore("location", () => {
  const locations = ref<Location[]>([]);

  function fetchPlaces(filters: any) {
    console.log(filters);
    // const { data } = useFetch(
    //   "https://clownfish-app-35nwf.ondigitalocean.app/api/category"
    // );

    locations.value = [];
  }

  return { locations, fetchPlaces };
});
