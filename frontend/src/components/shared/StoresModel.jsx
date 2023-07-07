import Modal from "./Modal";

export default function StoresModal({ open, setOpen }) {
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
            {Array.from({ length: 10 }).map((val, ind) => (
              <div key={ind} className="p-4 flex gap-4 cursor-pointer">
                <div className="w-14 h-14 object-center overflow-hidden rounded-full flex-shrink-0">
                  <img
                    className="w-full h-full object-cover"
                    src="https://order.phuclong.com.vn/_next/static/images/phuclong-store-a0cba2f8c91fff15b6138d6d30982396.jpg"
                  />
                </div>
                <div className="flex flex-col text-[12px]">
                  <span className="font-bold text-[14px]">
                    HCM-CH Coop Thắng Lợi, 2 TRC{" "}
                  </span>
                  <span>
                    Address : 02 Trường Chinh, P.Tây Thạnh, Q.Tân Phú, TP. Hồ
                    Chí Minh
                  </span>
                  <span>Phone number : 0966 666 666</span>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </Modal>
  );
}
