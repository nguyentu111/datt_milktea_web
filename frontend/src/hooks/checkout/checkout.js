import { useMutation, useQueryClient } from "react-query";
import { axiosClient } from "../../utils/request";
import { useSelector } from "react-redux";
export default function useCheckOut({ onSuccess, onError }) {
  const { token } = useSelector((state) => state.user);
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
  });
}
