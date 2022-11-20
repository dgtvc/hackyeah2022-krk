export interface Location {
  uuid: string;
  address: string;
  title: string;
  description: string;
  lat: string;
  lng: string;
  categories: {
    uuid: string;
    name: string;
    type: string;
  }[];
  recycle_type_uuid: string;
}
