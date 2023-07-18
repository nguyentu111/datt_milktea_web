import classNames from "classnames";
export default function ToppingBtns({ value, setValue, data }) {
  const handleTopping = (topping) => {
    const i = value.find((v) => v.id === topping.id);
    if (i) {
      setValue(value.filter((v) => v.id !== topping.id));
    } else setValue((prev) => [...prev, topping]);
  };
  return (
    <div className="flex gap-3 pt-2">
      {data.map((topping, index) => (
        <div
          className={classNames(
            " border-[1px] rounded cursor-pointer flex flex-col items-center border-primary"
          )}
          onClick={() => handleTopping(topping)}
          key={topping.id}
        >
          <span
            className={classNames(
              value.findIndex((v) => v.id === topping.id) > -1 &&
                "bg-primary text-white  ",
              "min-w-[80px] w-full py-1 text-center  border-b-[1px] border-primary"
            )}
          >
            {topping.name}
          </span>
          <span className="px-2 text-[14px]">+{topping.price} vnd</span>
        </div>
      ))}
    </div>
  );
}
