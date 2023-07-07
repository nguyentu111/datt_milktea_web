import { Link } from "react-router-dom";

export default function BreadCrumb({ data }) {
  return (
    <div className="bread-crumb">
      <Link to="/">Home</Link>
      {data.map((item, index) => {
        if (index != data.length - 1) {
          return (
            <>
              / <Link to={item.link}>{item.label}</Link>
            </>
          );
        }
        return (
          <>
            / <span> {item.label}</span>
          </>
        );
      })}
    </div>
  );
}
