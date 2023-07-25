import { useQuery } from "react-query";
import { axiosClient } from "../../utils/request";

export function useGetProducts() {
  return useQuery({
    queryKey: ["products"],
    queryFn: () => axiosClient.get("/drinks"),
    staleTime: 3600,
  });
}
export function useGetProductsCategory(category_slug) {
  return useQuery({
    queryKey: ["products", category_slug],
    queryFn: () => axiosClient.get("/drinks?category_slug=" + category_slug),
    staleTime: 3600,
  });
}
