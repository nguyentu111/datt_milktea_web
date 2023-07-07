import { useState } from "react";
import StoresModal from "../components/shared/StoresModel";
import AddAddress from "../components/shared/AddAddress";

export default function Checkout() {
  const [openStoreModel, setOpenStoreModel] = useState(false);
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
                  <span className="font-bold text-[14px]">
                    HCM-CH Coop Thắng Lợi, 2 TRC{" "}
                  </span>
                  <span>
                    Address : 02 Trường Chinh, P.Tây Thạnh, Q.Tân Phú, TP. Hồ
                    Chí Minh
                  </span>
                  <span>Phone number : 0966 666 666</span>
                </div>
              </div>
            </div>
            <div className="mt-6">
              <span className="font-bold text-[16px]">Ship to address</span>
              <AddAddress />
              <div className="p-2 mt-4 border-2 max-h-[400px] overflow-y-auto">
                {Array.from({ length: 10 }).map((val, ind) => (
                  <div key={ind} className="py-2 cursor-pointer">
                    <span>
                      Address : 02 Trường Chinh, P.Tây Thạnh, Q.Tân Phú, TP. Hồ
                      Chí Minh
                    </span>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>
        <div className="p-4 w-full">
          <div className="py-2">
            <span>Shipping fee : </span>
            <span className="float-right">4.00$</span>
          </div>
          <div className="py-2">
            <span>Total tax fee : </span>
            <span className="float-right">4.00$</span>
          </div>
          <div className="py-2">
            <span className="font-bold">Total amount : </span>
            <span className="float-right font-bold">34.00$</span>
          </div>
          <div className="pt-10 select-none flex flex-col gap-5">
            <div className="flex items-center gap-3">
              <input id="cash" name="payment_type" type="radio" value="" />
              <label htmlFor="cash">Cash</label>
            </div>
            <div className="flex items-center gap-3">
              <input id="momo" name="payment_type" type="radio" value="" />
              <label htmlFor="momo">Momo</label>
            </div>
            <div className="flex items-center gap-3">
              <input id="zalopay" name="payment_type" type="radio" value="" />
              <label htmlFor="zalopay">Zalopay</label>
            </div>
          </div>
          <button className="form-btn py-2 w-full rounded mt-6">
            Check out
          </button>
        </div>
      </div>
      <StoresModal open={openStoreModel} setOpen={setOpenStoreModel} />
    </>
  );
}
