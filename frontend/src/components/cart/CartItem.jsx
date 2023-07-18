import { faTrashCan } from "@fortawesome/free-regular-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { useRemoveCartItem } from "../../redux/cart";

export default function CartItem({ data }) {
  const remove = useRemoveCartItem();
  const totalPrice =
    ((data.drink.promotion_amount ?? data.drink.regular_amount) +
      data.toppings.reduce((acc, v) => acc + v.price, 0) +
      data.size.price) *
    data.quantity;
  return (
    <div className="flex gap-2 p-2">
      <img
        className="w-20 aspect-square rounded object-cover"
        src={data.drink.picture}
      />
      <div className="px-3 w-full">
        <span className="font-bold text-[15px] max-w-[400px] overflow-hidden line-clamp-2">
          {data.drink.name}
        </span>
        <div className="text-[13px]">
          <div>
            <span className="">Size : </span>
            <span className="">{data.size.name}</span>
          </div>
          <div>
            {data.toppings.length > 0 && <span className="">Toppings : </span>}
            {data.toppings.map((t, i) => {
              if (i !== data.toppings.length - 1)
                return (
                  <span key={t.id} className="">
                    {t.name},{" "}
                  </span>
                );
              else
                return (
                  <span key={t.id} className="">
                    {t.name}{" "}
                  </span>
                );
            })}
          </div>
          <div>
            <span className="">Quantity : </span>
            <span className="">{data.quantity}</span>
          </div>
          <div>
            <span className="">Total : </span>
            <span className="">{totalPrice} vnd</span>
          </div>
        </div>
        <div>
          <button onClick={() => remove(data)} className="ml-auto block">
            <FontAwesomeIcon
              icon={faTrashCan}
              className="w-4 h-4 text-red-500"
            />
          </button>
        </div>
      </div>
    </div>
  );
}
