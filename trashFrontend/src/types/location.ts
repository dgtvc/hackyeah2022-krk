export interface Location {
  uuid: string;
  name: string;
  title: string;
  description: string;
  latitude: string;
  longitude: string;
  categories: {
    uuid: string;
    name: string;
    type: string;
  }[];
}
