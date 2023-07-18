import classNames from "classnames";
export default function DrinkSizeBtns({ value, setValue, data }) {
  return (
    <div className="flex gap-3 pt-2">
      {data.map((size, index) => (
        <div
          className={classNames(
            "rounded cursor-pointer flex flex-col items-center  border-[1px] border-primary"
          )}
          onClick={() => setValue(size)}
          key={index}
        >
          <span
            className={classNames(
              value?.id === size.id && "bg-primary text-white",
              "min-w-[80px] w-full py-1 text-center border-b-2   border-primary"
            )}
          >
            {size.name}
          </span>
          <span className="px-2 text-[14px]">+{size.price} vnd</span>
        </div>
      ))}
    </div>
  );
}
