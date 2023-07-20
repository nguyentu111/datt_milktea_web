import { configureStore } from "@reduxjs/toolkit";
import cartReducer from "./cart";
import userReducer from "./auth";
export const store = configureStore({
  reducer: {
    cart: cartReducer,
    user: userReducer,
  },
});
