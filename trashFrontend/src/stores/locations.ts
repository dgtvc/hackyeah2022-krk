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
    const data = [
      {
        uuid: "1c3e43e6-7e19-42a0-adc7-c337859db44e",
        name: "Grzybowa 64",
        title: "Any fancy place",
        description: "Any fancy place description",
        latitude: "50.091352",
        longitude: "19.989579",
        categories: [
          {
            uuid: "2395b6f7-3fd0-4889-b5ae-c7e0a30ad391",
            name: "Glass",
            type: "Trash",
          },
          {
            uuid: "c4b15db7-f90a-4c1a-8ad1-1406b680b32a",
            name: "Medicines",
            type: "Trash",
          },
          {
            uuid: "dd2372c7-b701-4189-a4c5-96208562c775",
            name: "Battery",
            type: "Recycle",
          },
          {
            uuid: "fcc8fe50-ba83-482b-a6a5-4d0909509be5",
            name: "Battery",
            type: "Trash",
          },
        ],
      },
      {
        uuid: "348798fc-1bb0-4918-b907-179e45878886",
        name: "Rubinowa 41A",
        title: "Any fancy place",
        description: "Any fancy place description",
        latitude: "49.993513",
        longitude: "19.93438",
        categories: [
          {
            uuid: "dd2372c7-b701-4189-a4c5-96208562c775",
            name: "Battery",
            type: "Recycle",
          },
        ],
      },
      {
        uuid: "3715a946-f9f3-4894-9e23-bb1c82ea71ae",
        name: "Spółdzielcza 35/42",
        title: "Any fancy place",
        description: "Any fancy place description",
        latitude: "50.09388",
        longitude: "19.972403",
        categories: [
          {
            uuid: "08f34584-89f9-49dd-adfa-459bcc905d3f",
            name: "Glass",
            type: "Recycle",
          },
          {
            uuid: "2395b6f7-3fd0-4889-b5ae-c7e0a30ad391",
            name: "Glass",
            type: "Trash",
          },
          {
            uuid: "97059bf5-c383-4683-98b8-6198687042fe",
            name: "Electronic",
            type: "Recycle",
          },
          {
            uuid: "fcc8fe50-ba83-482b-a6a5-4d0909509be5",
            name: "Battery",
            type: "Trash",
          },
        ],
      },
    ];

    locations.value = data;
  }

  return { locations, fetchPlaces };
});
