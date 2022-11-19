import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import CreateLocationView from "../views/CreateLocationView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/add-new-location",
      name: "add-new-location",
      component: CreateLocationView,
    },
  ],
});

export default router;
