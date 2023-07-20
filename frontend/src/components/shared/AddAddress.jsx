import { useEffect, useState } from "react";
import Modal from "./Modal";
import { useForm } from "react-hook-form";
import { axiosClient } from "../../utils/request";
import { useMutation, useQueryClient } from "react-query";
import toastr from "toastr";
import { useSelector } from "react-redux";
export default function AddAddress() {
  const [openAdressModel, setOpenAdressModel] = useState(false);

  const [allProvinces, setAllProvinces] = useState([]);
  const [provinceChoosed, setProvincehoosed] = useState(null);
  const [districts, setDistricts] = useState(null);
  const [districtChoosed, setDistrictChoosed] = useState(null);
  const [wards, setWards] = useState(null);
  // const [wardChoosed, setWardChoosed] = useState(null);
  const { register, handleSubmit } = useForm();
  const queryClient = useQueryClient();
  // const user = queryClient.getQueryData("user");
  // const token = queryClient.getQueryData("token");
  const { user, token } = useSelector((state) => state.user);
  const {
    mutate,
    data: mutateData,
    isLoading,
  } = useMutation({
    mutationFn: (data) => {
      const response = axiosClient.post(
        "customer/" + user?.customer_id + "/addresses/add",
        data,
        {
          headers: {
            Authorization: "Bearer " + token,
          },
        }
      );
      return response;
    },
    onSuccess: () => {
      setOpenAdressModel(false);
      queryClient.invalidateQueries("user-addresses");
      toastr.success("Add address success");
    },
    onError: (error) => {
      toastr.error(JSON.stringify(error));
      console.log(error);
    },
  });
  useEffect(() => {
    fetch(`./addresses/tinh_tp.json`)
      .then((res) => res.json())
      .then((res) => setAllProvinces(res));
  }, []);
  const handleForcusDistrict = () => {
    provinceChoosed &&
      fetch(`./addresses/quan-huyen/${provinceChoosed}.json`)
        .then((res) => res.json())
        .then((res) => {
          setDistricts(res);
        });
  };
  const handleForcusWard = () => {
    districtChoosed &&
      fetch(`./addresses/xa-phuong/${districtChoosed}.json`)
        .then((res) => res.json())
        .then((res) => setWards(res));
  };
  const onSubmit = async (data) => {
    const response = await mutate({
      is_default: data.is_default,
      address: data.address + " " + data.ward,
    });
    console.log({
      response,
      mutateData,
    });
  };
  return (
    <>
      <span
        onClick={() => setOpenAdressModel(true)}
        className="float-right cursor-pointer underline ml-10"
      >
        + Add address
      </span>
      <Modal
        open={openAdressModel}
        onClickOutside={() => setOpenAdressModel(false)}
      >
        <form
          className="bg-secondary border-2 rounded shadow-xl fixed top-[50%] left-[50%] w-[600px]
         -translate-x-[50%] -translate-y-[50%] p-6"
          onSubmit={handleSubmit(onSubmit)}
        >
          <div className="text-[20px] font-bold pb-6">Add new address</div>
          <div className="grid grid-cols-2 gap-4">
            <div className="flex flex-col">
              <label>Province/City</label>
              <select
                required
                className="px-2 py-1 rounded"
                onChange={(e) => {
                  setDistricts(null);
                  setWards(null);
                  setProvincehoosed(e.target.value);
                  setDistrictChoosed(null);
                  // setWardChoosed(null);
                }}
              >
                <option value disabled selected>
                  -- select province --
                </option>
                {Object.values(allProvinces).map((item) => (
                  <option value={item.code} key={item.slug}>
                    {item.name_with_type}
                  </option>
                ))}
              </select>
            </div>
            <div className="flex flex-col">
              <label>Districts</label>
              <select
                required
                className="px-2 py-1 rounded"
                onClick={handleForcusDistrict}
                onChange={(e) => {
                  setWards(null);
                  setDistrictChoosed(e.target.value);
                  // setWardChoosed(null);
                }}
              >
                {districts &&
                  Object.values(districts).map((item) => (
                    <option value={item.code} key={item.slug}>
                      {item.name_with_type}
                    </option>
                  ))}
              </select>
            </div>
            <div className="flex flex-col">
              <label>Ward</label>
              <select
                required
                className="px-2 py-1 rounded"
                onClick={handleForcusWard}
                // onChange={(e) => setWardChoosed(e.target.value)}
                {...register("ward")}
              >
                {wards &&
                  Object.values(wards).map((item) => (
                    <option value={item.path_with_type} key={item.slug}>
                      {item.name_with_type}
                    </option>
                  ))}
              </select>
            </div>
            <div className="flex flex-col">
              <label>Address</label>
              <input
                required
                name="address"
                className="pl-2 px-2 py-1 "
                type="text"
                {...register("address")}
              ></input>
            </div>
          </div>

          <div className="flex items-center justify-between">
            <div className="flex items-center gap-4">
              <label htmlFor="is_default">Default address </label>
              <input
                id="is_default"
                name="is_default"
                type="checkbox"
                {...register("is_default")}
              />
            </div>

            <button className="mt-4 form-btn py-2 rounded float-right uppercase">
              {isLoading ? "saving..." : "save"}
            </button>
          </div>
        </form>
      </Modal>
    </>
  );
}
