import { useQuery } from "react-query";
import { axiosClient } from "../../utils/request";

export function useGetCategories() {
  return useQuery({
    queryKey: "categories",
    queryFn: () => {
      return axiosClient.get("categories");
    },
    onError: (error) => {
      console.log(error);
    },
    staleTime: 3600,
  });
}
