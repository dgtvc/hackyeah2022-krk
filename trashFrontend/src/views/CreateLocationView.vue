<script setup lang="ts">
import { reactive } from "vue";

import PlaceAutocompleteInput from "@/components/input/PlaceAutocompleteInput.vue";

const model = reactive({
  name: "",
  address: "",
  description: "",
});

function createLocation(val: any) {
  console.log(val);
}
</script>

<template>
  <v-container>
    <v-row>
      <h1>Add new place</h1>
    </v-row>

    <v-row>
      <v-col cols="12">
        <v-form>
          <PlaceAutocompleteInput @select="createLocation" />
          <v-text-field
            v-model="model.name"
            label="Name"
            required
          ></v-text-field>
          <v-text-field v-model="model.address" label="Address" required>
          </v-text-field>
          <v-text-field
            v-model="model.description"
            label="Description"
            required
          ></v-text-field>
          <v-btn color="primary" @click="createLocation">Create</v-btn>
        </v-form>
      </v-col>
    </v-row>
  </v-container>
</template>
