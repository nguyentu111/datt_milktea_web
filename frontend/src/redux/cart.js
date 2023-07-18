import { createSlice, current } from "@reduxjs/toolkit";
import { useDispatch } from "react-redux";

const initialState = {
  data: JSON.parse(localStorage.getItem("cart")) ?? [],
};
export const cartSlide = createSlice({
  name: "cart",
  initialState,
  reducers: {
    addDrink: (state, action) => {
      const currentState = current(state);
      const item = currentState.data.find(
        (v) =>
          v.drink.id === action.payload.drink.id &&
          v.size.id === action.payload.size.id &&
          JSON.stringify(v.toppings) === JSON.stringify(action.payload.toppings)
      );
      if (item) {
        const index = currentState.data.findIndex(
          (v) =>
            v.drink.id === action.payload.drink.id &&
            v.size.id === action.payload.size.id &&
            JSON.stringify(v.toppings) ===
              JSON.stringify(action.payload.toppings)
        );
        state.data = state.data.map((v, i) => {
          if (i === index)
            return {
              ...v,
              quantity: item.quantity + action.payload.quantity,
            };
          else return v;
        });
      } else {
        state.data = [...state.data, action.payload];
      }
    },
    removeDrink: (state, action) => {
      const currentState = current(state);
      const index = currentState.data.findIndex(
        (v) =>
          v.drink.id === action.payload.drink.id &&
          v.size.id === action.payload.size.id &&
          JSON.stringify(v.toppings) === JSON.stringify(action.payload.toppings)
      );
      state.data.splice(index, 1);
    },
  },
});

// Action creators are generated for each case reducer function
export const { addDrink, removeDrink } = cartSlide.actions;
export const useAddToCart = function () {
  const dispatch = useDispatch();
  return (payload) => dispatch(addDrink(payload));
};
export const useRemoveCartItem = function () {
  const dispatch = useDispatch();
  return (payload) => dispatch(removeDrink(payload));
};

export default cartSlide.reducer;
