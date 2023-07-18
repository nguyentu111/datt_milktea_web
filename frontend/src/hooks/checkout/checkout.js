import { useMutation, useQueryClient } from "react-query";
import { axiosClient } from "../../utils/request";
export default function useUserAddress(onSuccess, onError) {
  const queryClient = useQueryClient();
  //   const user = queryClient.getQueryData("user");
  const token = queryClient.getQueryData("token");
  return useMutation({
    mutationFn: (data) => {
      return axiosClient.post("customer/checkout", data, {
        headers: {
          Authorization: "Bearer " + token,
        },
      });
    },
    onSuccess,
    onError,
    staleTime: Infinity,
  });
}
