import Modal from "./Modal";

export default function OrderHistoryModal({ open, setOpen, data }) {
  return (
    <Modal lockScrollWhenOpen open={open} onClickOutside={() => setOpen(false)}>
      <div
        className="bg-secondary border-2 rounded flex shadow-xl fixed top-[50%] left-[50%] 
      -translate-x-[50%] -translate-y-[50%] p-6"
      >
        <div className="">
          {data.order_details.map((detail) => (
            <div className="flex gap-2 py-1" key={detail.id}>
              <img
                src={detail.drink_size.product.picture}
                className="w-20 h-20"
              />

              <div>
                <div>{detail.drink_size.product.name}</div>
                <div>
                  <span>Size </span> <span>{detail.drink_size.size.name}</span>
                  <div>
                    {detail?.toppings?.length > 0 && (
                      <>
                        <span>Toppings:</span>
                        {detail.toppings.map((topping, i) => {
                          if (i != detail.toppings.length - 1)
                            return (
                              <span key={topping.id}>
                                {" "}
                                {topping.product.name},
                              </span>
                            );
                          return (
                            <span key={topping.id}>
                              {" "}
                              {topping.product.name}
                            </span>
                          );
                        })}
                      </>
                    )}
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </Modal>
  );
}
