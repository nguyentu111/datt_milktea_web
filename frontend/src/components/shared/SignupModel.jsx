import { useContext } from "react";
import { SignupContext } from "../../contexts/SignupContext";
import Modal from "./Modal";
import { SigninContext } from "../../contexts/SigninContext";
import toastr from "toastr";
import { axiosClient } from "../../utils/request";
import { useForm } from "react-hook-form";
import { useMutation, useQueryClient } from "react-query";
export default function SignupModel() {
  const [openSignup, setOpenSignup] = useContext(SignupContext);
  const { register, handleSubmit } = useForm();
  const [_, setOpenSignin] = useContext(SigninContext);
  const queryClient = useQueryClient();
  const { mutate } = useMutation({
    mutationFn: (data) => axiosClient.post("/auth/customer/register", data),
    onError: (error) => {
      if (error.response?.data?.error?.message) {
        toastr.error(error.response?.data?.error?.message);
      } else toastr.error("Something not right :<<");
    },
    onSuccess: (response) => {
      toastr.success("Signup successfully");
      setOpenSignup(false);
      console.log(response.data.data);
      queryClient.setQueryData("user", response.data.data.user);
      queryClient.setQueryData("token", response.data.data.token);
    },
  });
  const onSubmit = async (data) => {
    if (data.password !== data.password_confirmation)
      return toastr.error("Pass word confimation is not right !");
    if (data.phone.length != 10)
      return toastr.error("Phone must be 10 digits !");
    mutate(data);
  };
  return (
    <Modal open={openSignup} onClickOutside={() => setOpenSignup(false)}>
      <div className="bg-secondary border-2 rounded flex shadow-xl fixed top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%] p-6">
        <form onSubmit={handleSubmit(onSubmit)} className="flex flex-col gap-4">
          <span className="pb-6 m-auto">Sign up</span>
          <div className="grid grid-cols-2 gap-4">
            <input
              name="first_name"
              type="text"
              required
              placeholder="First name"
              className="px-2 py-1"
              {...register("first_name")}
            />
            <input
              name="last_name"
              type="text"
              required
              placeholder="Last name"
              className="px-2 py-1"
              {...register("last_name")}
            />
            <input
              type="email"
              name="email"
              required
              placeholder="Email"
              className="px-2 py-1"
              {...register("email")}
            />
            <input
              type="text"
              name="phone"
              required
              placeholder="Phone"
              className="px-2 py-1"
              {...register("phone")}
            />
            <input
              required
              name="password"
              type="password"
              placeholder="Password"
              className="px-2 py-1"
              {...register("password")}
            />
            <input
              required
              type="password"
              placeholder="Password confirm"
              className="px-2 py-1"
              {...register("password_confirmation")}
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
