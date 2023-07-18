import { useQuery, useQueryClient } from "react-query";
import { axiosClient } from "../../utils/request";

export function useGetAllBranch() {
  return useQuery({
    queryKey: "branches",
    queryFn: () => {
      return axiosClient.get("branches");
    },
    onError: (error) => {
      console.log(error);
    },
    staleTime: 3600,
  });
}
