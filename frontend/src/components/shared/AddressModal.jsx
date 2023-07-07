import { useEffect, useState } from "react";
import Modal from "./Modal";
export default function AddressModel({ open, setOpen }) {
  const [allProvinces, setAllProvinces] = useState([]);
  const [provinceChoosed, setProvincehoosed] = useState(null);
  const [districts, setDistricts] = useState(null);
  const [districtChoosed, setDistrictChoosed] = useState(null);
  const [wards, setWards] = useState(null);
  const [wardChoosed, setWardChoosed] = useState(null);
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
  const handleSubmit = (e, data) => {
    e.preventDefault();
    const rs = e.target[3].value + " " + wardChoosed;
    console.log(rs);
  };
  return (
    <Modal open={open} onClickOutside={() => setOpen(false)}>
      <form
        className="bg-secondary border-2 rounded shadow-xl fixed top-[50%] left-[50%] w-[600px]
       -translate-x-[50%] -translate-y-[50%] p-6"
        onSubmit={handleSubmit}
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
                setWardChoosed(null);
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
                setWardChoosed(null);
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
              onChange={(e) => setWardChoosed(e.target.value)}
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
            ></input>
          </div>
        </div>
        <button className="mt-4 form-btn py-2 rounded float-right">
          Save{" "}
        </button>
      </form>
    </Modal>
  );
}
