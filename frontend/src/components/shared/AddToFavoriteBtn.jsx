import { faHeart } from "@fortawesome/free-regular-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import classNames from "classnames";

export default function AddToFavovite({ ...attr }) {
  return (
    <button
      {...attr}
      className={classNames("absolute top-3 right-3", attr?.className)}
      onClick={() => {}}
    >
      <FontAwesomeIcon icon={faHeart} className="w-5 h-5" />
    </button>
  );
}
