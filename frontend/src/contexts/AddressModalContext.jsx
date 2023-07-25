import { createContext, useContext, useState } from "react";

export const AddressModel = createContext();
export function AddressModelProvider({ children }) {
  const [openAdressModel, setOpenAdressModel] = useState(false);

  return (
    <AddressModel.Provider value={[openAdressModel, setOpenAdressModel]}>
      {children}
    </AddressModel.Provider>
  );
}
export const useAddressModel = function () {
  const arr = useContext(AddressModel);
  return arr;
};
