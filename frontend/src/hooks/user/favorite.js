import { useMutation, useQuery, useQueryClient } from "react-query";
import { axiosClient } from "../../utils/request";
import { useSelector } from "react-redux";
import toastr from "toastr";
export function useGetFavorite() {
  const { token } = useSelector((state) => state.user);
  return useQuery({
    queryKey: "liked-drinks",
    queryFn: () => {
      return axiosClient.get("customer/favorite", {
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
export function useAddFavorite() {
  const { token } = useSelector((state) => state.user);
  const querClient = useQueryClient();
  return useMutation({
    mutationFn: (productId) =>
      axiosClient.post(
        "customer/add-favorite",
        {
          product_id: productId,
        },
        {
          headers: {
            Authorization: "Bearer " + token,
          },
        }
      ),
    onSuccess(res) {
      console.log(res);
      toastr.success("Add to favorite success");
      querClient.invalidateQueries("liked-drinks");
    },
  });
}

export function useRemoveFavorite() {
  const { token } = useSelector((state) => state.user);
  const querClient = useQueryClient();
  return useMutation({
    mutationFn: (productId) =>
      axiosClient.post(
        "customer/remove-favorite",
        {
          product_id: productId,
        },
        {
          headers: {
            Authorization: "Bearer " + token,
          },
        }
      ),
    onSuccess() {
      toastr.success("Remove favorite success");
      querClient.invalidateQueries("liked-drinks");
    },
  });
}
