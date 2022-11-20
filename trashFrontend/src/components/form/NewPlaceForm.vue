<script setup lang="ts">
import { useCategoriesStore } from "@/stores/categories";
import { onMounted, reactive } from "vue";
import PlaceAutocompleteInput from "@/components/input/PlaceAutocompleteInput.vue";

const emit = defineEmits<{
  (event: "submit", payload: any): void;
  (event: "selectLocation", payload: google.maps.places.PlaceResult): void;
}>();

const categoriesStore = useCategoriesStore();

const model = reactive({
  lat: 0,
  lng: 0,
  address: "",
  category: [],
  recycleType: "",
  title: "",
  description: "",
  isPaid: "",
});

function submit() {
  emit("submit", model);
}

const selectLocation = (location: google.maps.places.PlaceResult) => {
  if (!location.geometry?.location) {
    return;
  }
  model.lat = location.geometry.location.lat();
  model.lng = location.geometry.location.lng();
  model.address = location.name || "";

  emit("selectLocation", location);
};

onMounted(() => {
  categoriesStore.fetchCategories();
});
</script>

<template>
  <v-form>
    <v-card-text>
      <h2 class="text-h6 mb-2">Location</h2>
      <PlaceAutocompleteInput @select="selectLocation" />
    </v-card-text>
    <v-card-text>
      <h2 class="text-h6 mb-2">Trash types</h2>
      <v-chip-group v-model="model.category" column multiple>
        <v-chip
          filter
          outlined
          v-for="category in categoriesStore.trashCategories"
          :key="category.uuid"
          :value="category.uuid"
          selected-class="bg-primary"
        >
          {{ category.name }}
        </v-chip>
      </v-chip-group>
    </v-card-text>

    <v-card-text>
      <h2 class="text-h6 mb-2">Recycle types</h2>

      <v-btn-toggle color="primary" v-model="model.recycleType">
        <v-btn
          size="small"
          v-for="item in categoriesStore.recycleCategories"
          :key="item.uuid"
          :value="item.uuid"
        >
          {{ item.name }}
        </v-btn>
      </v-btn-toggle>
    </v-card-text>

    <v-card-text>
      <h2 class="text-h6 mb-2">Place title</h2>
      <v-text-field v-model="model.title" label="Title" />
    </v-card-text>

    <v-card-text>
      <h2 class="text-h6 mb-2">Place description</h2>
      <v-textarea
        v-model="model.description"
        label="Description"
        :rows="3"
        no-resize
      />
    </v-card-text>

    <v-card-text>
      <h2 class="text-h6 mb-2">Options</h2>
      <v-switch v-model="model.isPaid" inset label="Paid offer" />
    </v-card-text>

    <v-card-text>
      <v-btn color="primary" @click="submit">Add new place</v-btn>
    </v-card-text>
  </v-form>
</template>
