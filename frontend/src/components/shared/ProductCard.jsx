import { faHeart } from "@fortawesome/free-regular-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { useEffect, useState } from "react";
import Modal from "./Modal";
import DrinkSizeBtns from "./DrinkSizeBtns";
import ToppingBtns from "./ToppingBtns";
import { faCartPlus } from "@fortawesome/free-solid-svg-icons";
import AddToFavovite from "./AddToFavoriteBtn";
import { useLocalStorage } from "usehooks-ts";
import { useAddToCart } from "../../redux/cart";
import toastr from "toastr";
export default function ProductCard({ data }) {
  const [openModal, setOpenModel] = useState(false);
  const [size, setSize] = useState(data.sizes[0]);
  const [quantity, setQuantity] = useState(1);
  const [toppings, setToppings] = useState([]);
  const [drinks, setDrinks] = useLocalStorage("cart-drinks", []);
  const add = useAddToCart();
  const [total, setTotal] = useState(
    (data.promotion_amount ?? data.regular_amount) + data.sizes[0].price
  );

  const handleLikeBtn = (e) => {
    e.preventDefault();
  };
  const handleAddCart = () => {
    const newCartDrink = {
      drink: data,
      toppings: [...toppings].sort((a, b) => a.id - b.id),
      size,
      quantity,
    };
    add(newCartDrink);
    toastr.success("Add to cart successfully");
    setOpenModel(false);
  };
  useEffect(() => {
    const price = data.promotion_amount ?? data.regular_amount;
    const toppingPrices = toppings.reduce((acc, v) => acc + v.price, 0);
    const total = (price + (size ? size.price : 0) + toppingPrices) * quantity;
    setTotal(total);
  }, [quantity, toppings, size]);
  return (
    <>
      <div
        onClick={() => setOpenModel(true)}
        className="border-[1px] rounded group cursor-pointer hover:shadow-lg"
      >
        <div className="relative">
          <img className="w-full aspect-square" src={data.picture} />
          <AddToFavovite />
        </div>
        <div className="p-3 flex flex-col gap-2">
          <span>{data.name}</span>
          <div className="flex gap-2">
            {data.promotion_amount ? (
              <>
                <strike className="w-fit">{data.regular_amount}</strike>
                <span>
                  <b>{data.promotion_amount} VND</b>
                </span>
              </>
            ) : (
              <span>
                <b>{data.regular_amount} VND</b>
              </span>
            )}
          </div>
          <button className="bg-secondary group-hover:bg-primary group-hover:text-white add-product-btn rounded py-2">
            Add to cart
          </button>
        </div>
      </div>
      <Modal open={openModal} onClickOutside={() => setOpenModel(false)}>
        <div className="bg-secondary border-2 rounded flex shadow-xl fixed top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%]">
          <div className="relative p-4">
            <img className="w-60 aspect-square" src={data.picture} />
            <AddToFavovite className="top-6 right-6" />
          </div>
          <div className="p-4 flex flex-col gap-3">
            <span className="font-bold text-[24px] max-w-[400px] overflow-hidden line-clamp-2">
              {data.name}
            </span>
            <p className="max-h-[100px] max-w-[400px] overflow-y-auto overflow-x-hidden">
              {data.description}
            </p>
            <div className="flex gap-2">
              {data.promotion_amount ? (
                <>
                  <strike className="w-fit">{data.regular_amount}</strike>
                  <span>
                    <b>{data.promotion_amount} VND</b>
                  </span>
                </>
              ) : (
                <span>
                  <b>{data.regular_amount} VND</b>
                </span>
              )}
            </div>
            <div>
              <span>Quantity : </span>
              <input
                type="number"
                className="max-w-[100px] border-[1px] pl-2"
                value={quantity}
                min={1}
                onChange={(e) => setQuantity(+e.target.value)}
              />
            </div>
            <div>
              <span>Choose size : </span>
              <DrinkSizeBtns
                value={size}
                setValue={setSize}
                data={data.sizes}
              />
            </div>
            <div>
              {data.toppings.length > 0 && (
                <>
                  <span>Choose toppings : </span>
                  <ToppingBtns
                    value={toppings}
                    setValue={setToppings}
                    data={data.toppings}
                  />
                </>
              )}
            </div>
            <button
              onClick={handleAddCart}
              className=" add-product-btn bg-primary mt-2 hover:text-white rounded py-2 "
            >
              <FontAwesomeIcon icon={faCartPlus} className="pr-3" />
              Add to cart : <span>{total} vnd</span>
            </button>
          </div>
        </div>
      </Modal>
    </>
  );
}
