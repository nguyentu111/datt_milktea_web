import { useContext } from "react";
import { SigninContext } from "../../contexts/SigninContext";
import Modal from "./Modal";
import { SignupContext } from "../../contexts/SignupContext";

export default function SigninModel() {
  const [openSignin, setOpenSignin] = useContext(SigninContext);
  const [openSignup, setOpenSignup] = useContext(SignupContext);

  return (
    <Modal open={openSignin} onClickOutside={() => setOpenSignin(false)}>
      <div className="bg-secondary border-2 rounded flex shadow-xl fixed top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%] p-6">
        <form className="flex flex-col gap-4">
          <span className="pb-6 m-auto">Sign in</span>
          <input
            type="email"
            required
            placeholder="Email"
            className="px-2 py-1"
          />
          <input
            required
            type="password"
            placeholder="Password"
            className="px-2 py-1"
          />
          <span>
            Doesn't have a account?{" "}
            <span
              onClick={() => {
                setOpenSignup(true);
                setOpenSignin(false);
              }}
              className="text-blue-500 underline cursor-pointer"
            >
              Sign up.
            </span>
          </span>
          <button type="submit" className="signin-btn py-2 rounded">
            Sign in
          </button>
        </form>
      </div>
    </Modal>
  );
}
