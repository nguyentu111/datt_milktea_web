import { faCartPlus } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { useRef, useState } from "react";
import Modal from "../shared/Modal";
import { useOnClickOutside } from "usehooks-ts";
import classNames from "classnames";
import CartItem from "./CartItem";
export default function Cart() {
  const [open, setOpen] = useState(false);
  return (
    <>
      <button onClick={() => setOpen(true)}>
        <FontAwesomeIcon icon={faCartPlus} className="w-6 h-6" />
      </button>
      <Modal open={open} keepMouted onClickOutside={() => setOpen(false)}>
        <div
          className={classNames(
            "z-50 bg-secondary fixed h-screen min-w-[400px] transition-all duration-200",
            open ? "right-0" : "-right-[100%]"
          )}
        >
          <div className="relative h-full">
            <div className="h-20 px-4 border-b-2 pt-6">
              <span>Total 5 products</span>
            </div>
            <div className="overflow-y-auto max-h-full pb-60">
              {Array.from({ length: 10 }).map((item, index) => {
                return <CartItem key={index} />;
              })}
            </div>
            <div className="absolute bottom-0 h-[100px] border-t-2 border-primary w-full bg-white px-4 py-5 pb-10">
              <div>
                <span>Total amount : </span>
                <span>200.00$</span>
              </div>
              <button className="cart-confirm-btn rounded w-full h-10 mt-2">
                Confirm
              </button>
            </div>
          </div>
        </div>
      </Modal>
    </>
  );
}
