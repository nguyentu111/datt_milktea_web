import { Link } from "react-router-dom";
import HeaderActions from "../components/header/HeaderActions";
import Search from "../components/header/Search";

export default function Header() {
  return (
    <div className="border-2">
      <div className="container py-6 px-4 mx-auto flex justify-between">
        <Link to="/">
          <img src="logo.png" />
        </Link>
        <Search />
        <HeaderActions />
      </div>
    </div>
  );
}
