import { Outlet } from "react-router-dom";
import Header from "../patials/Header";
import CategorySidebar from "../patials/CategorySidebar";
export default function DefaultLayout() {
  return (
    <>
      <Header />
      <div className="flex container m-auto pt-6 gap-4 ">
        <CategorySidebar />
        <Outlet />
      </div>
    </>
  );
}
