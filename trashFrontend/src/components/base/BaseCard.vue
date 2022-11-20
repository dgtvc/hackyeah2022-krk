<script setup lang="ts">
import { useCategoriesStore } from "@/stores/categories";
import { computed } from "vue";
import { defineProps } from "vue";

const categoriesStore = useCategoriesStore();

interface Props {
  title: string;
  description: string;
  recycleTypeUuid: string;
}

const props = defineProps<Props>();

const recycleType = categoriesStore.getRecycleTypeByUUID(props.recycleTypeUuid);

const iconName = computed(() => {
  if (!recycleType) {
    return "";
  }

  if (recycleType.name === "Repair") {
    return "mdi-wrench";
  } else if (recycleType.name === "Recycle") {
    return "mdi-recycle";
  }

  return "";
});
</script>

<template>
  <v-card color="grey-lighten-4" class="mb-4">
    <v-card-title class="d-flex align-baseline">
      <v-icon color="primary" size="22" class="mr-2">{{ iconName }}</v-icon>
      {{ props.title }}
    </v-card-title>

    <v-card-text>
      {{ props.description }}
    </v-card-text>
  </v-card>
</template>
