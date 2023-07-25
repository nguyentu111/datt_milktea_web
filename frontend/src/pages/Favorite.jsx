import BreadCrumb from "../components/shared/BreadCrumb";
import ProductCard from "../components/shared/ProductCard";
import { useGetFavorite } from "../hooks/user/favorite";
export default function Favorite() {
  const { data } = useGetFavorite();
  const favoriteDrinks = data?.data?.data ?? [];
  return (
    <div>
      <div className="p-4">
        <BreadCrumb data={[{ label: "Favorite" }]} />
      </div>
      <div className="grid grid-cols-4 gap-4">
        {favoriteDrinks?.map((v) => (
          <ProductCard key={v.id} data={v} />
        ))}
      </div>
    </div>
  );
}
