import { faHeart } from "@fortawesome/free-regular-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { useRef, useState } from "react";
import Modal from "./Modal";
import DrinkSizeBtns from "./DrinkSizeBtns";
import ToppingBtns from "./ToppingBtns";
import { faCartPlus } from "@fortawesome/free-solid-svg-icons";
import AddToFavovite from "./AddToFavoriteBtn";

export default function ProductCard() {
  const [openModal, setOpenModel] = useState(false);
  const [sizeChoosed, setSizeChoosed] = useState(null);
  const [quantity, setQuantity] = useState(1);
  const [topping, setTopping] = useState(null);
  const handleLikeBtn = (e) => {
    e.preventDefault();
  };
  return (
    <>
      <div
        onClick={() => setOpenModel(true)}
        className="border-[1px] rounded group cursor-pointer hover:shadow-lg"
      >
        <div className="relative">
          <img
            className="w-full aspect-square"
            src="https://demos.codezeel.com/prestashop/PRS19/PRS190462/35-home_default/consectetur-hamirginiap.jpg"
          />
          <AddToFavovite />
        </div>
        <div className="p-3 flex flex-col gap-2">
          <span>Flavour Special French Press Grind</span>
          <div className="flex gap-2">
            <strike className="w-fit">36.00$</strike>
            <span>
              <b>20.00$</b>
            </span>
          </div>
          <button className="bg-secondary group-hover:bg-primary group-hover:text-white add-product-btn rounded py-2">
            Add to cart
          </button>
        </div>
      </div>
      <Modal open={openModal} onClickOutside={() => setOpenModel(false)}>
        <div className="bg-secondary border-2 rounded flex shadow-xl fixed top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%]">
          <div className="relative p-4">
            <img
              className="w-60 aspect-square"
              src="https://demos.codezeel.com/prestashop/PRS19/PRS190462/35-home_default/consectetur-hamirginiap.jpg"
            />
            <AddToFavovite className="top-6 right-6" />
          </div>
          <div className="p-4 flex flex-col gap-3">
            <span className="font-bold text-[24px] max-w-[400px] overflow-hidden line-clamp-2">
              Flavour Special French Press Grind Flavou Grind
            </span>
            <p className="max-h-[100px] max-w-[400px] overflow-y-auto overflow-x-hidden">
              The point of using Lorem Ipsum is that it has a more-or-less
              normal distribution of letters, as opposed to using 'Content here,
              content here', making it look like readable that it has a
              more-or-less normal distribution of letters.
            </p>
            <div className="flex gap-2">
              <strike className="w-fit">36.00$</strike>
              <span>
                <b>20.00$</b>
              </span>
            </div>
            <div>
              <span>Quantity : </span>
              <input
                type="number"
                className="max-w-[100px] border-[1px] pl-2"
                value={quantity}
                min={1}
                onChange={(e) => setQuantity(e.target.value)}
              />
            </div>
            <div>
              <span>Choose size : </span>
              <DrinkSizeBtns value={sizeChoosed} setValue={setSizeChoosed} />
            </div>
            <div>
              <span>Choose toppings : </span>
              <ToppingBtns value={topping} setValue={setTopping} />
            </div>
            <button className=" add-product-btn bg-primary mt-2 hover:text-white rounded py-2 ">
              <FontAwesomeIcon icon={faCartPlus} className="pr-3" />
              Add to cart : <span>20.00$</span>
            </button>
          </div>
        </div>
      </Modal>
    </>
  );
}
