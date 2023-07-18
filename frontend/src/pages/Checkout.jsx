import { useEffect, useState } from "react";
import StoresModal from "../components/shared/StoresModel";
import AddAddress from "../components/shared/AddAddress";
import useUserAddress from "../hooks/user/address";
import classNames from "classnames";
import { useGetAllBranch } from "../hooks/branch/branch";
import { useSelector } from "react-redux";

const shipFee = Math.round(Math.random() * 20) * 1000;
export default function Checkout() {
  const [openStoreModel, setOpenStoreModel] = useState(false);
  const { data } = useUserAddress();
  const [address, setAddress] = useState(null);
  const { data: dataBranches } = useGetAllBranch();
  const [branch, setBranch] = useState(null);
  const [paymentType, setPaymentType] = useState("cash");
  const cart = useSelector((state) => state.cart.data);
  // const shippingFee = Math.round(Math.random() * 20) * 1000;
  const [note, setNote] = useState(null);

  const tax = cart.reduce((acc, val) => {
    const taxToppings = val.toppings.reduce(
      (acc, val) => acc + val.price * val.tax,
      0
    );
    return (
      acc +
      taxToppings +
      (val.drink.promotion_amount ?? val.drink.regular_amount) * val.drink.tax
    );
  }, 0);
  const total =
    cart.reduce((acc, v) => {
      return (
        acc +
        ((v.drink.promotion_amount ?? v.drink.regular_amount) +
          v.toppings.reduce((acc, v) => acc + v.price, 0) +
          v.size.price) *
          v.quantity
      );
    }, 0) +
    tax +
    shipFee;
  const handleCheckout = () => {};

  useEffect(() => {
    if (data && address == null) {
      const defaultAddress = data.data.data.find((v) => v.is_default);
      if (defaultAddress) setAddress(defaultAddress);
      else if (data.data.data.length > 0) setAddress(data.data.data[0]);
    }
  }, [data]);
  useEffect(() => {
    if (dataBranches && branch == null) {
      setBranch(dataBranches.data.data[0]);
    }
  }, [dataBranches]);
  return (
    <>
      <div className="flex gap-6">
        <div className="rounded max-w-[600px]">
          <div>
            <div className="max-h-[500px] overflow-auto">
              <div
                onClick={() => setOpenStoreModel(true)}
                className="p-4 flex gap-4 cursor-pointer"
              >
                <div className="w-14 h-14 object-center overflow-hidden flex-shrink-0 rounded-full">
                  <img
                    className="w-auto h-full object-cover"
                    src="https://order.phuclong.com.vn/_next/static/images/phuclong-store-a0cba2f8c91fff15b6138d6d30982396.jpg"
                  />
                </div>
                <div className="flex flex-col text-[12px]">
                  {branch && (
                    <>
                      <span className="font-bold text-[14px]">
                        {branch.name}
                      </span>
                      <span>{branch.address}</span>
                      <span>{branch.phone}</span>
                    </>
                  )}
                </div>
              </div>
            </div>
            <div className="mt-6 flex flex-col">
              <span className="font-bold text-[16px]">Note for shipper</span>
              <textarea
                value={note}
                onChange={(e) => setNote(e.target.value)}
                placeholder="type note"
                className="border-2 border-primary p-3 rounded"
              ></textarea>
            </div>
            <div className="mt-6">
              <span className="font-bold text-[16px]">Ship to address</span>
              <AddAddress />
              <div className=" mt-4 border-2 max-h-[400px] overflow-y-auto">
                {data?.data.data.map((val) => (
                  <div
                    onClick={() => setAddress(val)}
                    key={val.id}
                    className={classNames(
                      "py-2 cursor-pointer p-2",
                      address?.id === val.id && "bg-primary text-white"
                    )}
                  >
                    <span>{val.address}</span>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>
        <div className="p-4 w-full">
          <div className="py-2">
            <span>Shipping fee : </span>
            <span className="float-right">{shipFee} VND</span>
          </div>
          <div className="py-2">
            <span>Total tax fee : </span>
            <span className="float-right">{tax} VND</span>
          </div>
          <div className="py-2">
            <span className="font-bold">Total amount : </span>
            <span className="float-right font-bold">{total} VND</span>
          </div>
          <div className="pt-10 select-none flex flex-col gap-5">
            <div className="flex items-center gap-3">
              <input
                id="cash"
                name="payment_type"
                type="radio"
                value="cash"
                onChange={(e) => setPaymentType(e.target.value)}
                checked={paymentType == "cash" ? "true" : ""}
              />
              <label htmlFor="cash">Cash</label>
            </div>
            <div className="flex items-center gap-3">
              <input
                id="momo"
                name="payment_type"
                type="radio"
                value="momo"
                onChange={(e) => setPaymentType(e.target.value)}
                checked={paymentType == "momo" ? "true" : ""}
              />
              <label htmlFor="momo">Momo</label>
            </div>
            <div className="flex items-center gap-3">
              <input
                id="zalopay"
                name="payment_type"
                type="radio"
                value="zalopay"
                onChange={(e) => setPaymentType(e.target.value)}
                checked={paymentType == "zalopay" ? "true" : ""}
              />
              <label htmlFor="zalopay">Zalopay</label>
            </div>
          </div>
          <button
            onClick={handleCheckout}
            className="form-btn py-2 w-full rounded mt-6"
          >
            Check out
          </button>
        </div>
      </div>
      <StoresModal
        open={openStoreModel}
        setOpen={setOpenStoreModel}
        data={dataBranches?.data.data}
        branch={branch}
        setBranch={setBranch}
      />
    </>
  );
}
