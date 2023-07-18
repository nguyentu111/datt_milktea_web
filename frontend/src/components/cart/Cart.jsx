import { faCartPlus } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { useContext, useRef, useState } from "react";
import Modal from "../shared/Modal";
import { useOnClickOutside } from "usehooks-ts";
import classNames from "classnames";
import CartItem from "./CartItem";
import { Link, useNavigate } from "react-router-dom";
import { useSelector } from "react-redux";
import { useQueryClient } from "react-query";
import { SigninContext, useSigninModel } from "../../contexts/SigninContext";
export default function Cart() {
  const [open, setOpen] = useState(false);
  const nav = useNavigate();
  const cart = useSelector((state) => state.cart.data);
  localStorage.setItem("cart", JSON.stringify(cart));
  const queryClient = useQueryClient();
  const user = queryClient.getQueryData("user");
  const token = queryClient.getQueryData("token");
  const [openSignin, setOpenSignin] = useSigninModel();
  const total = cart.reduce((acc, v) => {
    return (
      acc +
      ((v.drink.promotion_amount ?? v.drink.regular_amount) +
        v.toppings.reduce((acc, v) => acc + v.price, 0) +
        v.size.price) *
        v.quantity
    );
  }, 0);
  const handleCheckout = () => {
    if (user && token) {
      setOpen(false);
      nav("/checkout");
    } else {
      setOpenSignin(true);
    }
  };
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
            <div className="h-20 px-4 border-b-2 pt-6 font-bold">
              <span>Total {cart.length} products</span>
            </div>
            <div className="overflow-y-auto max-h-full pb-60">
              {cart.map((item, index) => {
                return <CartItem key={index} data={item} />;
              })}
            </div>
            <div className="absolute bottom-0 h-[100px] border-t-2 border-primary w-full bg-white px-4 py-5 pb-10">
              <div>
                <span>Total amount : </span>
                <span>{total} VND</span>
              </div>
              <button
                onClick={handleCheckout}
                className="cart-confirm-btn text-center items-center rounded w-full h-10 mt-2"
              >
                Confirm
              </button>
            </div>
          </div>
        </div>
      </Modal>
    </>
  );
}
