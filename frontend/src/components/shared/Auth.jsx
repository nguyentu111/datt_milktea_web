import { useEffect } from "react";
import { useQueryClient } from "react-query";
import { useNavigate } from "react-router-dom";
import { useSelector } from "react-redux";
import toastr from "toastr";
export default function Auth({ children }) {
  const { user, token } = useSelector((state) => state.user);
  const nav = useNavigate();
  useEffect(() => {
    if (!user || !token) {
      nav("/");
      toastr.error("You are not signed in");
    }
  }, [user, token]);
  if (!user || !token) {
    return null;
  }
  return children;
}
