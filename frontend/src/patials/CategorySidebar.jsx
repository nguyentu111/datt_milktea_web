import { useState } from "react";
import styled from "styled-components";
import { useGetCategories } from "../hooks/product/category";
import { useNavigate, Link } from "react-router-dom";

const UL = styled.ul`
  list-style: none;
  margin: 0;
  padding: 0;
`;
const LI = styled.li``;
const Item = styled.div`
  display: flex;
  padding: 12px 18px;
  /* padding-left: ${(props) => `${props.dept * 18}px`}; */
  align-items: center;
`;
const Label = styled.span`
  width: 100%;
  display: block;
  cursor: pointer;
`;
const Arrow = styled.span`
  border-left: 2px #ccc solid;
  display: flex;
  height: 25px;
  width: 35px;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  margin-left: auto;
  &::after {
    content: "";
    width: 0;
    height: 0;
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;

    border-top: 4px solid #000;

    /* transform: ${(props) =>
      props.toggle ? "rotate(180deg)" : "rotate(0deg)"}; */
  }
`;
export default function CategorySidebar() {
  const [activeMenus, setActiveMenus] = useState([]);
  const { data } = useGetCategories();
  const categories = data?.data?.data;
  const nav = useNavigate();
  const handleArrowClick = (menuName) => {
    let newActiveMenus = [...activeMenus];

    if (newActiveMenus.includes(menuName)) {
      var index = newActiveMenus.indexOf(menuName);
      if (index > -1) {
        newActiveMenus.splice(index, 1);
      }
    } else {
      newActiveMenus.push(menuName);
    }

    setActiveMenus(newActiveMenus);
  };

  const ListMenu = ({ dept, data, hasSubMenu, menuName, menuIndex }) => (
    <LI>
      <Item dept={dept}>
        <Label onClick={() => nav(`/category/${data.slug}`)}>
          {data.name}{" "}
        </Label>
        {hasSubMenu && (
          <Arrow
            onClick={() => handleArrowClick(menuName)}
            toggle={activeMenus.includes(menuName)}
          />
        )}
      </Item>
      {hasSubMenu && (
        <SubMenu
          dept={dept}
          data={data.descendants}
          toggle={activeMenus.includes(menuName)}
          menuIndex={menuIndex}
        />
      )}
    </LI>
  );

  const SubMenu = ({ dept, data, toggle, menuIndex }) => {
    if (!toggle) {
      return null;
    }

    dept = dept + 1;

    return (
      <UL>
        {data.map((menu, index) => {
          const menuName = menu.name;

          return (
            <ListMenu
              dept={dept}
              data={menu}
              hasSubMenu={menu.descendants.length > 0}
              menuName={menuName}
              key={menuName}
              menuIndex={index}
            />
          );
        })}
      </UL>
    );
  };

  return (
    <div className="">
      <Link to="/" className="block bg-primary menu py-2 rounded mb-4">
        All Category
      </Link>
      <div className="w-[300px] bg-secondary rounded">
        {!categories && <span className="p-2">Loading...</span>}
        <UL>
          {categories?.map((menu, index) => {
            const dept = 1;
            const menuName = menu.name;

            return (
              <ListMenu
                dept={dept}
                data={menu}
                hasSubMenu={menu.descendants.length > 0}
                menuName={menuName}
                key={menuName}
                menuIndex={index}
              />
            );
          })}
        </UL>
      </div>
    </div>
  );
}
