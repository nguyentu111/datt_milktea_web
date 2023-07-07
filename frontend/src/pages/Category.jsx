import ProductCard from "../components/shared/ProductCard";
import Breadcrumb from "../components/shared/BreadCrumb";
export default function Category() {
  return (
    <div>
      <div className="p-4">
        <Breadcrumb />
      </div>
      <div className="grid grid-cols-4 gap-4">
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
      </div>
    </div>
  );
}
