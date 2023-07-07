import { Outlet } from "react-router-dom";
import Header from "../patials/Header";
export default function NoSizebarLayout() {
  return (
    <>
      <Header />
      <div className="container m-auto pt-6">
        <Outlet />
      </div>
    </>
  );
}
