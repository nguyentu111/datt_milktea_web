import ProductCard from "../components/shared/ProductCard";
import { useGetProducts } from "../hooks/product/product";

export default function Home() {
  const { data, isLoading } = useGetProducts();
  const drinks = data?.data?.data;
  return (
    <div className="">
      {isLoading && "Loadding..."}
      <div className="grid grid-cols-4 gap-4">
        {drinks?.map((v) => (
          <ProductCard key={v.id} data={v} />
        ))}
      </div>
    </div>
  );
}
