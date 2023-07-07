import BreadCrumb from "../components/shared/BreadCrumb";
import ProductCard from "../components/shared/ProductCard";
export default function Favorite() {
  return (
    <div>
      <div className="p-4">
        <BreadCrumb data={[{ label: "Favorite" }]} />
      </div>
      <div className="grid grid-cols-4 gap-4">
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
      </div>
    </div>
  );
}
