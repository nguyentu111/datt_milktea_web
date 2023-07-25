import { Outlet } from "react-router-dom";
import Header from "../patials/Header";
export default function NoSizebarLayout({ children }) {
  return (
    <>
      <Header />
      <div className="container m-auto pt-6">
        {children}
        <div className="w-full">
          {" "}
          <Outlet />
        </div>
      </div>
    </>
  );
}
