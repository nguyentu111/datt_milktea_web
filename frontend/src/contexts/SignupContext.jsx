import { createContext, useState } from "react";

export const SignupContext = createContext();
export function SignupContextProvider({ children }) {
  const [openSignup, setOpenSignup] = useState(false);

  return (
    <SignupContext.Provider value={[openSignup, setOpenSignup]}>
      {children}
    </SignupContext.Provider>
  );
}
