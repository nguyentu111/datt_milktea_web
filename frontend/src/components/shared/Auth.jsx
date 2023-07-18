import { useEffect } from "react";
import { useQueryClient } from "react-query";
import { useNavigate } from "react-router-dom";
import toastr from "toastr";
export default function Auth({ children }) {
  const queryClient = useQueryClient();
  const user = queryClient.getQueryData("user");
  const token = queryClient.getQueryData("token");
  const nav = useNavigate();
  useEffect(() => {
    if (!user || !token) {
      nav("/");
      toastr.error("You are not signed in");
    }
  });
  if (!user || !token) {
    return null;
  }
  return children;
}
