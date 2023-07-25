import { Link } from "react-router-dom";

export default function Notfound() {
  return (
    <div className="mt-20 flex justify-center">
      <div>
        <span className="text-[40px] font-bold block">404 Page not found</span>
        <Link to="/" className="text-[20px] block underline mx-auto w-fit">
          Go home
        </Link>
      </div>
    </div>
  );
}
