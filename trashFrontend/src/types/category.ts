export type CategoryType = "category" | "recycle_type";

export interface Category {
  uuid: string;
  name: string;
  type: CategoryType;
}
