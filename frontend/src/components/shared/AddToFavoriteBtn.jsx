import classNames from "classnames";
import { faHeart } from "@fortawesome/free-regular-svg-icons";
import { faHeart as faHeartSolid } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  useAddFavorite,
  useGetFavorite,
  useRemoveFavorite,
} from "../../hooks/user/favorite";
export default function AddToFavovite({ productId, ...attr }) {
  const { data } = useGetFavorite();
  const favoriteDrinks = data?.data?.data ?? [];
  const { mutate: muatateAdd } = useAddFavorite();
  const { mutate: muatateRemove } = useRemoveFavorite();
  const handleAdd = (e) => {
    e.preventDefault();
    e.stopPropagation();
    muatateAdd(productId);
  };
  const handleRemove = (e) => {
    e.preventDefault();
    e.stopPropagation();
    muatateRemove(productId);
  };
  return (
    <>
      {favoriteDrinks.findIndex((v) => v.id == productId) > -1 ? (
        <button
          {...attr}
          className={classNames("absolute top-3 right-3", attr?.className)}
          onClick={(e) => handleRemove(e)}
        >
          <FontAwesomeIcon
            icon={faHeartSolid}
            className="w-5 h-5 text-[var(--primary-color)]"
          />
        </button>
      ) : (
        <button
          {...attr}
          className={classNames("absolute top-3 right-3", attr?.className)}
          onClick={(e) => handleAdd(e)}
        >
          <FontAwesomeIcon
            icon={faHeart}
            className="w-5 h-5 text-[var(--primary-color)]"
          />
        </button>
      )}
    </>
  );
}
