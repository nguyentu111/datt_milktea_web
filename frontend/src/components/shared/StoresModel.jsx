import Modal from "./Modal";

export default function StoresModal({
  open,
  setOpen,
  branch,
  setBranch,
  data,
}) {
  const handle = (branch) => {
    setOpen(false);
    setBranch(branch);
  };
  return (
    <Modal open={open} onClickOutside={() => setOpen(false)}>
      <div
        className="bg-secondary border-2 rounded flex shadow-xl fixed top-[50%] left-[50%]
       -translate-x-[50%] -translate-y-[50%] p-6 flex-col gap-4 w-[500px]"
      >
        <span className="font-bold text-[16px]">Choose another store</span>
        <div>
          <input className="px-2 py-1 w-full" placeholder="Search for store" />
          <div className="mt-4 max-h-[400px] overflow-auto">
            {data?.map((val, ind) => (
              <div
                key={val.id}
                onClick={() => handle(val)}
                className="p-4 flex gap-4 cursor-pointer"
              >
                <div className="w-14 h-14 object-center overflow-hidden rounded-full flex-shrink-0">
                  <img
                    className="w-full h-full object-cover"
                    src="https://order.phuclong.com.vn/_next/static/images/phuclong-store-a0cba2f8c91fff15b6138d6d30982396.jpg"
                  />
                </div>
                <div className="flex flex-col text-[12px]">
                  <span className="font-bold text-[14px]">{val.name}</span>
                  <span>{val.address}</span>
                  <span>{val.phone}</span>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </Modal>
  );
}
