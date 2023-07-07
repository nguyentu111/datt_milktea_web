import { faTrashCan } from "@fortawesome/free-regular-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";

export default function CartItem() {
  return (
    <div className="flex gap-2 p-2">
      <img
        className="w-20 aspect-square rounded"
        src="https://demos.codezeel.com/prestashop/PRS19/PRS190462/35-home_default/consectetur-hamirginiap.jpg"
      />
      <div className="px-3">
        <span className="font-bold text-[15px] max-w-[400px] overflow-hidden line-clamp-2">
          Flavour Special French Press Grind Flavou Grind
        </span>
        <div className="text-[13px]">
          <span className="">Toppings : </span> <span className="">Cherry</span>
        </div>
        <div>
          <button className="ml-auto block">
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
