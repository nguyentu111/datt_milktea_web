import { useContext } from "react";
import { SigninContext } from "../../contexts/SigninContext";
import Modal from "./Modal";
import { SignupContext } from "../../contexts/SignupContext";
import { axiosClient } from "../../utils/request";
import { useForm } from "react-hook-form";
import { useMutation, useQueryClient } from "react-query";
import { useLocalStorage } from "usehooks-ts";
import toastr from "toastr";
export default function SigninModel() {
  const queryClient = useQueryClient();
  const [openSignin, setOpenSignin] = useContext(SigninContext);
  // eslint-disable-next-line no-unused-vars
  const [____, setOpenSignup] = useContext(SignupContext);
  // eslint-disable-next-line no-unused-vars
  const [__, setCurrentUser] = useLocalStorage("currentUser");
  const { register, handleSubmit } = useForm();
  const [token, setToken] = useLocalStorage("token");
  const { mutate: mutateSignin } = useMutation({
    mutationFn: (data) =>
      axiosClient.post("auth/customer/login", data, {
        headers: {
          Authorization: "Bearer " + token,
        },
      }),
    onSuccess: (response) => {
      toastr.success("Login successfully");
      queryClient.setQueryData("user", response.data.data.user);
      queryClient.setQueryData("token", response.data.data.token);
      setOpenSignin(false);
    },
    onError: () => {
      toastr.error("Login failed");
    },
  });
  const onSubmit = (data) => {
    mutateSignin(data);
  };
  return (
    <Modal open={openSignin} onClickOutside={() => setOpenSignin(false)}>
      <div className="bg-secondary border-2 rounded flex shadow-xl fixed top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%] p-6">
        <form className="flex flex-col gap-4" onSubmit={handleSubmit(onSubmit)}>
          <span className="pb-6 m-auto">Sign in</span>
          <input
            type="email"
            required
            placeholder="Email"
            className="px-2 py-1"
            {...register("email")}
          />
          <input
            required
            type="password"
            placeholder="Password"
            className="px-2 py-1"
            {...register("password")}
          />
          <span>
            Doesn`t have a account?{" "}
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
