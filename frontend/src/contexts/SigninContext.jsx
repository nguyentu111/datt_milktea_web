import { createContext, useState } from "react";

export const SigninContext = createContext();
export function SigninContextProvider({ children }) {
  const [openSignin, setOpenSignin] = useState(false);

  return (
    <SigninContext.Provider value={[openSignin, setOpenSignin]}>
      {children}
    </SigninContext.Provider>
  );
}
