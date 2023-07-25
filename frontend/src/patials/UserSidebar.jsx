import classNames from "classnames";

export default function UserSideBar({ tab, setTab }) {
  return (
    <div className="max-w-[300px]">
      <div className="bg-primary menu py-2 rounded mb-4">User</div>
      <div className="w-[300px] bg-secondary rounded text-left">
        <div
          className={classNames(
            "px-4 py-2 cursor-pointer hover:underline border-b-2 border-gray-300",
            tab == 1 && "bg-primary text-white"
          )}
          onClick={() => setTab(1)}
        >
          Info
        </div>
        <div
          className={classNames(
            "px-4 py-2 cursor-pointer hover:underline border-b-2 border-gray-300",
            tab == 2 && "bg-primary text-white"
          )}
          onClick={() => setTab(2)}
        >
          Address list
        </div>
        <div
          className={classNames(
            "px-4 py-2 cursor-pointer hover:underline border-b-2 border-gray-300",
            tab == 3 && "bg-primary text-white"
          )}
          onClick={() => setTab(3)}
        >
          Order history
        </div>
      </div>
    </div>
  );
}
