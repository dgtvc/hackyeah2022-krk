<script setup lang="ts">
import { defineProps } from "vue";

interface Props {
  imgSrc: string;
  title: string;
  description: string;
}

const props = defineProps<Props>();
</script>

<template>
  <v-card color="#d3d3d3" class="mb-3">
    <v-img height="150" :src="props.imgSrc" cover></v-img>

    <v-card-title>{{ props.title }}</v-card-title>

    <v-card-text>
      {{ props.description }}
    </v-card-text>

    <v-card-actions>
      <v-btn color="lighten-2" text> More details </v-btn>
    </v-card-actions>
  </v-card>
</template>
