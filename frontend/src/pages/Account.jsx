import { useState } from "react";
import UserSideBar from "../patials/UserSidebar";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faTrashCan } from "@fortawesome/free-regular-svg-icons";
import AddressModel from "../components/shared/AddressModal";
import BreadCrumb from "../components/shared/BreadCrumb";

export default function Account() {
  const [tab, setTab] = useState(1);
  const [openAdressModel, setOpenAdressModel] = useState(false);

  return (
    <div className="flex gap-4">
      <UserSideBar tab={tab} setTab={setTab} />
      <div>
        <div className="p-4">
          <BreadCrumb data={[{ label: "Account" }]} />
        </div>
        {tab == 1 && (
          <div className="bg-secondary rounded p-4">
            <span className="font-bold text-[20px] mb-6 block">
              User infomation
            </span>
            <form className="grid grid-cols-2 gap-4">
              <div className="flex flex-col text-left gap-2">
                <label>Email</label>
                <input
                  disabled
                  placeholder="Email"
                  className="px-2 py-1 rounded disabled:bg-gray-100"
                />
              </div>
              <div className="flex flex-col text-left gap-2">
                <label>First name</label>
                <input placeholder="First name" className="px-2 py-1 rounded" />
              </div>
              <div className="flex flex-col text-left gap-2">
                <label>Last name</label>
                <input placeholder="Last name" className="px-2 py-1 rounded" />
              </div>
              <div className="flex flex-col text-left gap-2">
                <label>Phone</label>
                <input placeholder="Phone" className="px-2 py-1 rounded" />
              </div>
              <button className="form-btn py-2 rounded ml-auto col-span-2 mt-2">
                Save changes
              </button>
            </form>
          </div>
        )}
        {tab == 2 && (
          <>
            <div className="bg-secondary rounded p-4">
              <span className="font-bold text-[20px] mb-6">
                User address list
              </span>
              <span
                onClick={() => setOpenAdressModel(true)}
                className="float-right cursor-pointer underline "
              >
                + Add address
              </span>
              <div className="grid grid-cols-2 gap-4 mt-4">
                {Array.from({ length: 3 }).map((val, index) => {
                  return (
                    <div
                      key={index}
                      className="flex p-4 rounded-sm border-2 border-primary"
                    >
                      <div className="">
                        <span>address: </span>
                        <span>
                          97 man thien, hiep phu, quan 9phu, quan 9phu, quan 9
                        </span>
                      </div>
                      <button className="text-red-500 pl-1">
                        <FontAwesomeIcon icon={faTrashCan} />
                      </button>
                    </div>
                  );
                })}
              </div>
            </div>
            <AddressModel open={openAdressModel} setOpen={setOpenAdressModel} />
          </>
        )}
      </div>
    </div>
  );
}
