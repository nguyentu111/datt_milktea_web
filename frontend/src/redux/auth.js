import { createSlice } from "@reduxjs/toolkit";
import { useDispatch } from "react-redux";

const initialState = {
  user: JSON.parse(localStorage.getItem("user")) ?? null,
  token: localStorage.getItem("token") ?? null,
};
const userSlice = createSlice({
  name: "user",
  initialState: initialState,
  reducers: {
    logout: (state) => {
      state.user = null;
      state.token = null;
      localStorage.removeItem("user");
      localStorage.removeItem("token");
    },
    login: (state, action) => {
      state.user = action.payload.user;
      state.token = action.payload.token;
      localStorage.setItem("user", JSON.stringify(action.payload.user));
      localStorage.setItem("token", action.payload.token);
    },
  },
});
const { reducer, actions } = userSlice;
export const logout = actions.logout;
export const login = actions.login;
export const useLogin = () => {
  const dispatch = useDispatch();
  return (payload) => dispatch(login(payload));
};
export const useLogout = () => {
  const dispatch = useDispatch();
  return () => dispatch(logout());
};
export default reducer;
