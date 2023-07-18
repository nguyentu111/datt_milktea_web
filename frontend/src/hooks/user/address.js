import { useQuery, useQueryClient } from "react-query";
import { axiosClient } from "../../utils/request";

export default function useUserAddress() {
  const queryClient = useQueryClient();
  const user = queryClient.getQueryData("user");
  const token = queryClient.getQueryData("token");
  return useQuery({
    queryKey: "user-addresses",
    queryFn: () => {
      return axiosClient.get("customer/" + user?.customer_id + "/addresses", {
        headers: {
          Authorization: "Bearer " + token,
        },
      });
    },
    onError: (error) => {
      console.log(error);
    },
    staleTime: Infinity,
  });
}
