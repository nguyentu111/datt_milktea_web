import { useQuery } from "react-query";
import ProductCard from "../components/shared/ProductCard";
import { axiosClient } from "../utils/request";

export default function Home() {
  const { data, isLoading } = useQuery("drinks", {
    queryFn: () => axiosClient.get("/drinks", null),
    staleTime: 3600,
  });
  const drinks = data?.data?.data;
  return (
    <div>
      {isLoading && "Loadding..."}
      <div className="grid grid-cols-4 gap-4">
        {drinks?.map((v) => (
          <ProductCard key={v.id} data={v} />
        ))}
      </div>
    </div>
  );
}
