import ProductCard from "../components/shared/ProductCard";
import Breadcrumb from "../components/shared/BreadCrumb";
import { useParams } from "react-router-dom";
import { useGetProductsCategory } from "../hooks/product/product";
import { useGetCategories } from "../hooks/product/category";
import { getAllParents, findCategoryBySlug } from "../utils/categoryHelper";
import { useEffect, useState } from "react";
import { Navigate } from "react-router-dom";
import Notfound from "./Notfound";
export default function Category() {
  const location = useParams();
  const { data, isLoading } = useGetProductsCategory(location.slug);
  const drinks = data?.data?.data;

  const { data: categories } = useGetCategories();
  const category = findCategoryBySlug(categories?.data?.data, location.slug);
  const [dataBreadCrumb, setDataBreadCumb] = useState([]);
  useEffect(() => {
    if (categories?.data) {
      const allParents = getAllParents(categories.data.data, location.slug);
      setDataBreadCumb(
        allParents.map((v) => ({
          label: v.name,
          link: `/category/${v.slug}`,
        }))
      );
    }
  }, [categories, location.slug]);
  if (categories?.data?.data && !category) return <Navigate to="/notfound" />;
  return (
    <div>
      <div className="p-4">
        <Breadcrumb data={dataBreadCrumb} />
      </div>
      {category && (
        <div className="h-[300px] flex items-center border-2 mb-4 p-4">
          <span className="font-bold text-[20px]">{category?.name}</span>
          <img className="h-full ml-auto" src={category?.picture} />
        </div>
      )}
      {isLoading && "Loadding..."}
      <div className="grid grid-cols-4 gap-4">
        {drinks?.map((v) => (
          <ProductCard key={v.id} data={v} />
        ))}
      </div>
    </div>
  );
}
