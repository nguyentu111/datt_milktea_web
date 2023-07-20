import { useQuery, useQueryClient } from "react-query";
import { axiosClient } from "../../utils/request";
import { useSelector } from "react-redux";

export default function useUserAddress() {
  const { user, token } = useSelector((state) => state.user);
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
