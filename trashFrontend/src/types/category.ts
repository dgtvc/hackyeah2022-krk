export type CategoryType = "Trash" | "Recycle";

export interface Category {
  uuid: string;
  name: string;
  type: CategoryType;
}
