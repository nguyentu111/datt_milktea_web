import { useContext } from "react";
import { SignupContext } from "../../contexts/SignupContext";
import Modal from "./Modal";
import { SigninContext } from "../../contexts/SigninContext";
import toastr from "toastr";
export default function SignupModel() {
  const [openSignup, setOpenSignup] = useContext(SignupContext);
  // eslint-disable-next-line no-unused-vars
  const [_, setOpenSignin] = useContext(SigninContext);
  const handleSubmit = (e) => {
    e.preventDefault();
    const data = Array.from(e.target).reduce((acc, item) => ({
      ...acc,
      [item.name]: item.value,
    }));

    if (data.password !== data.confirm_password)
      toastr.error("I do not think that word means what you think it means.");
    data.first_name = data.value;
    delete data[""];
    delete data["value"];
    delete data["confirm_password"];
    console.log({ data });
  };
  return (
    <Modal open={openSignup} onClickOutside={() => setOpenSignup(false)}>
      <div className="bg-secondary border-2 rounded flex shadow-xl fixed top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%] p-6">
        <form onSubmit={handleSubmit} className="flex flex-col gap-4">
          <span className="pb-6 m-auto">Sign up</span>
          <div className="grid grid-cols-2 gap-4">
            <input
              name="first_name"
              type="text"
              required
              placeholder="First name"
              className="px-2 py-1"
            />
            <input
              name="last_name"
              type="text"
              required
              placeholder="Last name"
              className="px-2 py-1"
            />
            <input
              type="email"
              name="email"
              required
              placeholder="Email"
              className="px-2 py-1"
            />
            <input
              type="text"
              name="phone"
              required
              placeholder="Phone"
              className="px-2 py-1"
            />
            <input
              required
              name="password"
              type="password"
              placeholder="Password"
              className="px-2 py-1"
            />
            <input
              required
              name="confirm_password"
              type="password"
              placeholder="Password confirm"
              className="px-2 py-1"
            />
          </div>
          <span>
            Allready have a account?{" "}
            <span
              onClick={() => {
                setOpenSignup(false);
                setOpenSignin(true);
              }}
              className="text-blue-500 underline cursor-pointer"
            >
              Sign in.
            </span>
          </span>
          <button type="submit" className="signin-btn py-2 rounded">
            Sign up
          </button>
        </form>
      </div>
    </Modal>
  );
}
