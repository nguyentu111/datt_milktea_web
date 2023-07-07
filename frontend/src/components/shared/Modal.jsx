import classNames from "classnames";
import { useRef } from "react";
import { createPortal } from "react-dom";

import { useOnClickOutside, useLockedBody } from "usehooks-ts";
export default function Modal({
  children,
  keepMouted,
  open,
  lockScrollWhenOpen,
  onClickOutside = () => {},
}) {
  const ref = useRef();
  useOnClickOutside(ref, onClickOutside);
  useLockedBody(lockScrollWhenOpen ? open : true, "root");
  if (!open && !keepMouted) return null;
  if (keepMouted) {
    return createPortal(
      <div className={classNames(open && "w-screen h-screen bg-gray-800/20")}>
        <div ref={ref}>{children}</div>
      </div>,
      document.querySelector("#modal-root")
    );
  }
  return createPortal(
    <div className="w-screen h-screen">
      <div ref={ref}>{children}</div>
    </div>,
    document.querySelector("#modal-root")
  );
}
