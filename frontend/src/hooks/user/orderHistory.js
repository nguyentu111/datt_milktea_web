import { useQuery } from "react-query";
import { axiosClient } from "../../utils/request";
import { useSelector } from "react-redux";
// import toastr from "toastr";
export default function useOrderHistory() {
  const { token } = useSelector((state) => state.user);
  return useQuery({
    queryKey: "order-history",
    queryFn: () => {
      return axiosClient.get("customer/order-history", {
        headers: {
          Authorization: "Bearer " + token,
        },
      });
    },
    onError: (error) => {
      console.log(error);
      //   toastr.error("get order history failed");
    },
    staleTime: Infinity,
  });
}
