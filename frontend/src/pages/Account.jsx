import { useState } from "react";
import UserSideBar from "../patials/UserSidebar";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faTrashCan } from "@fortawesome/free-regular-svg-icons";
import BreadCrumb from "../components/shared/BreadCrumb";
import AddAddress from "../components/shared/AddAddress";
import { useForm } from "react-hook-form";
import useUserAddress from "../hooks/user/address";
import { useSelector } from "react-redux";
import useOrderHistory from "../hooks/user/orderHistory";
import { faInfo } from "@fortawesome/free-solid-svg-icons";
import OrderHistoryModal from "../components/shared/OrderHistoryModal";
export default function Account() {
  const [tab, setTab] = useState(1);
  const { user } = useSelector((state) => state.user);
  const { register, handleSubmit } = useForm();
  const { isLoading, data } = useUserAddress();
  const { data: orderHistory } = useOrderHistory();
  const [openHistory, setOpenHistory] = useState(false);
  const onSubmit = (data) => {
    console.log(data);
  };
  console.log(orderHistory);
  return (
    <div className="flex gap-4">
      <UserSideBar tab={tab} setTab={setTab} />
      <div>
        <div className="p-4">
          <BreadCrumb data={[{ label: "Account" }]} />
        </div>
        {tab == 1 && (
          <form
            onSubmit={handleSubmit(onSubmit)}
            className="bg-secondary rounded p-4"
          >
            <span className="font-bold text-[20px] mb-6 block">
              User infomation
            </span>
            <form className="grid grid-cols-2 gap-4">
              <div className="flex flex-col text-left gap-2">
                <label>Email</label>
                <input
                  readOnly
                  value={user?.email}
                  disabled
                  placeholder="Email"
                  className="px-2 py-1 rounded disabled:bg-gray-100"
                />
              </div>
              <div className="flex flex-col text-left gap-2">
                <label>First name</label>
                <input
                  defaultValue={user?.first_name}
                  placeholder="First name"
                  className="px-2 py-1 rounded"
                />
              </div>
              <div className="flex flex-col text-left gap-2">
                <label>Last name</label>
                <input
                  defaultValue={user?.last_name}
                  placeholder="Last name"
                  className="px-2 py-1 rounded"
                />
              </div>
              <div className="flex flex-col text-left gap-2">
                <label>Phone</label>
                <input
                  defaultValue={user?.phone}
                  placeholder="Phone"
                  className="px-2 py-1 rounded"
                />
              </div>
              <button className="form-btn py-2 rounded ml-auto col-span-2 mt-2">
                Save changes
              </button>
            </form>
          </form>
        )}
        {tab == 2 && (
          <>
            <div className="bg-secondary rounded p-4">
              <span className="font-bold text-[20px] mb-6">
                User address list
              </span>
              <AddAddress />
              {isLoading ? (
                "loading..."
              ) : (
                <div className="grid grid-cols-2 gap-4 mt-4">
                  {data?.data?.data?.map((val, index) => {
                    return (
                      <div
                        key={index}
                        className="flex p-4 rounded-sm border-2 border-primary"
                      >
                        <div className="flex flex-col gap-4">
                          <div className="">
                            <span>address: </span>
                            <span>{val.address}</span>
                          </div>
                          <div className="">
                            <span>default : </span>
                            <span>{val.is_default ? "yes" : "no"}</span>
                          </div>
                        </div>
                        <button className="text-red-500 pl-1">
                          <FontAwesomeIcon icon={faTrashCan} />
                        </button>
                      </div>
                    );
                  })}
                </div>
              )}
            </div>
          </>
        )}
        {tab == 3 && (
          <>
            <div className="bg-secondary rounded p-4">
              <span className="font-bold text-[20px] mb-6">Order history</span>

              {isLoading ? (
                "loading..."
              ) : (
                <div className="grid grid-cols-2 gap-4 mt-4">
                  {orderHistory?.data?.data?.map((val, index) => {
                    return (
                      <div
                        key={index}
                        className="flex p-4 rounded-sm border-2 border-primary"
                      >
                        <div className="flex flex-col gap-4">
                          <div className="">
                            <span>time: </span>
                            <span>{val.created_at}</span>
                          </div>
                          <div className="">
                            <span>status : </span>
                            <span>{val.status}</span>
                          </div>
                          {val.ship_to && (
                            <>
                              <div className="">
                                <span>ship to : </span>
                                <span>{val.ship_to}</span>
                              </div>
                            </>
                          )}
                          <div className="">
                            <span>total : </span>
                            <span>{val.total_amount} vnd</span>
                          </div>
                        </div>
                        <div className="">
                          <button
                            className="text-red-500  border-2 border-red-500 rounded-full 
                          w-5 h-5 flex items-center justify-center"
                            onClick={() => setOpenHistory(true)}
                          >
                            <FontAwesomeIcon
                              icon={faInfo}
                              className="w-3 h-3 p-0"
                            />
                          </button>
                          <OrderHistoryModal
                            open={openHistory}
                            setOpen={setOpenHistory}
                            data={val}
                          />
                        </div>
                      </div>
                    );
                  })}
                </div>
              )}
            </div>
          </>
        )}
      </div>
    </div>
  );
}
