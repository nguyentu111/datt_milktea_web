import classNames from "classnames";
export default function DrinkSizeBtns({ value, setValue }) {
  return (
    <div className="flex gap-3 pt-2">
      {Array.from({ length: 3 }).map((item, index) => (
        <div
          className={classNames(
            "rounded cursor-pointer flex flex-col items-center  border-[1px] border-primary"
          )}
          onClick={() => setValue(index)}
          key={index}
        >
          <span
            className={classNames(
              value === index && "bg-primary text-white",
              "min-w-[80px] py-1 text-center border-b-2   border-primary"
            )}
          >
            M
          </span>
          <span>+2.00$</span>
        </div>
      ))}
    </div>
  );
}
