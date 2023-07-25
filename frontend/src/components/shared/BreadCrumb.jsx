import React from "react";
import { Link } from "react-router-dom";
export default function BreadCrumb({ data }) {
  return (
    <div className="bread-crumb ml-auto w-fit flex">
      <Link to="/" className="block px-2">
        Home
      </Link>
      {data.map((item, index) => {
        if (index != data.length - 1) {
          return (
            <React.Fragment key={item.link}>
              |{" "}
              <Link to={item.link} className="px-2 block">
                {item.label}{" "}
              </Link>
            </React.Fragment>
          );
        }
        return (
          <React.Fragment key={item.slug}>
            | <span className="block px-2"> {item.label} </span>
          </React.Fragment>
        );
      })}
    </div>
  );
}
