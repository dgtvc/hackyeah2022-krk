import { computed, ref } from "vue";
import { defineStore } from "pinia";
import { useFetch } from "@vueuse/core";
import type { Category } from "@/types/category";

export const useCategoriesStore = defineStore("categories", () => {
  const categories = ref<Category[]>([]);

  const trashCategories = computed(() =>
    categories.value.filter((category) => category.type === "category")
  );

  const recycleCategories = computed(() =>
    categories.value.filter((category) => category.type === "recycle_type")
  );

  const getRecycleTypeByUUID = (uuid: string) =>
    categories.value.find((category) => category.uuid === uuid);

  async function fetchCategories() {
    const { data } = await useFetch(
      "https://clownfish-app-35nwf.ondigitalocean.app/api/base"
    ).json();

    categories.value = data.value;
  }

  return {
    trashCategories,
    recycleCategories,
    fetchCategories,
    getRecycleTypeByUUID,
  };
});
