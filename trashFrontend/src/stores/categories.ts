import { computed, ref } from "vue";
import { defineStore } from "pinia";
// import { useFetch } from "@vueuse/core";
import type { Category } from "@/types/category";

export const useCategoriesStore = defineStore("categories", () => {
  const categories = ref<Category[]>([]);

  const trashCategories = computed(() =>
    categories.value.filter((category) => category.type === "Trash")
  );

  const recycleCategories = computed(() =>
    categories.value.filter((category) => category.type === "Recycle")
  );

  function fetchCategories() {
    // const { data } = useFetch(
    //   "https://clownfish-app-35nwf.ondigitalocean.app/api/category"
    // );

    categories.value = [
      {
        uuid: "2395b6f7-3fd0-4889-b5ae-c7e0a30ad391",
        name: "Glass",
        type: "Trash",
      },
      {
        uuid: "fcc8fe50-ba83-482b-a6a5-4d0909509be5",
        name: "Battery",
        type: "Trash",
      },
      {
        uuid: "033df124-8636-4d09-b1e3-51d99ef695ec",
        name: "Electronic",
        type: "Trash",
      },
      {
        uuid: "c4b15db7-f90a-4c1a-8ad1-1406b680b32a",
        name: "Medicines",
        type: "Trash",
      },
      {
        uuid: "08f34584-89f9-49dd-adfa-459bcc905d3f",
        name: "Glass",
        type: "Recycle",
      },
      {
        uuid: "dd2372c7-b701-4189-a4c5-96208562c775",
        name: "Battery",
        type: "Recycle",
      },
      {
        uuid: "97059bf5-c383-4683-98b8-6198687042fe",
        name: "Electronic",
        type: "Recycle",
      },
    ];
  }

  return { trashCategories, recycleCategories, fetchCategories };
});
