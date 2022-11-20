export interface Location {
  uuid: string;
  name: string;
  title: string;
  description: string;
  lat: string;
  lng: string;
  categories: {
    uuid: string;
    name: string;
    type: string;
  }[];
}
