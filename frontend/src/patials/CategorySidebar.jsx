import { useState } from "react";
import styled from "styled-components";

const UL = styled.ul`
  list-style: none;
  margin: 0;
  padding: 0;
`;
const LI = styled.li``;
const Item = styled.div`
  display: flex;
  padding: 12px 18px;
  padding-left: ${(props) => `${props.dept * 18}px`};
  align-items: center;
`;
const Label = styled.span`
  /* width: 100%; */
  display: block;
  cursor: pointer;
`;
const Arrow = styled.span`
  display: flex;
  height: 25px;
  width: 35px;
  justify-content: center;
  align-items: center;
  cursor: pointer;

  &::after {
    content: "";
    width: 0;
    height: 0;
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;

    border-top: 4px solid #000;

    transform: ${(props) => (props.toggle ? "rotate(180deg)" : "rotate(0deg)")};
  }
`;
const menus = [
  {
    label: "Menu 1",
  },
  {
    label: "Menu 2",
    submenu: [
      {
        label: "Sub Menu 1",
      },
      {
        label: "Sub Menu 2",
      },
    ],
  },
  {
    label: "Menu 3",
    submenu: [
      {
        label: "Sub Menu 1",
        submenu: [
          {
            label: "Boom 1",
          },
          {
            label: "Boom 2",
          },
        ],
      },
      {
        label: "Sub Menu 2",
        submenu: [
          {
            label: "Deep 1",
          },
          {
            label: "Deep 2",
            submenu: [
              {
                label: "Lorem 1",
              },
              {
                label: "Lorem 2",
                submenu: [
                  {
                    label: "Super Deep",
                  },
                ],
              },
            ],
          },
        ],
      },
      {
        label: "Sub Menu 3",
      },
      {
        label: "Sub Menu 4",
        submenu: [
          {
            label: "Last 1",
          },
          {
            label: "Last 2",
          },
          {
            label: "Last 3",
          },
        ],
      },
    ],
  },
  {
    label: "Menu 4",
  },
];
export default function CategorySidebar() {
  const [activeMenus, setActiveMenus] = useState([]);

  const handleMenuClick = (data) => {
    console.log(data);
  };

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
        <Label onClick={() => handleMenuClick(data)}>{data.label} </Label>
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
          data={data.submenu}
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
          const menuName = `sidebar-submenu-${dept}-${menuIndex}-${index}`;

          return (
            <ListMenu
              dept={dept}
              data={menu}
              hasSubMenu={menu.submenu}
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
    <div>
      <div className="bg-primary menu py-2 rounded mb-4">All Category</div>
      <div className="w-[300px] bg-secondary rounded">
        <UL>
          {menus.map((menu, index) => {
            const dept = 1;
            const menuName = `sidebar-menu-${dept}-${index}`;

            return (
              <ListMenu
                dept={dept}
                data={menu}
                hasSubMenu={menu.submenu}
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
