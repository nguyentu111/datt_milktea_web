import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import Tippy from "@tippyjs/react/headless";
import { faUser, faHeart } from "@fortawesome/free-regular-svg-icons";
import { Link } from "react-router-dom";
import Cart from "../cart/Cart";
import { useContext } from "react";
import SigninModel from "../shared/SigninModel";
import { SigninContext } from "../../contexts/SigninContext";
import { SignupContext } from "../../contexts/SignupContext";
import SignupModel from "../shared/SignupModel";
export default function HeaderActions() {
  const [openSignin, setOpenSignin] = useContext(SigninContext);
  const [openSignup, setOpenSignup] = useContext(SignupContext);
  const renderTippy = (attrs) => {
    return (
      <>
        <div
          className="border-[1px] flex flex-col bg-white"
          tabIndex="-1"
          {...attrs}
        >
          <button
            onClick={() => setOpenSignin(true)}
            className="mb-2 px-4 py-2 hover:bg-gray-200"
          >
            Sign in
          </button>
          <button
            onClick={() => setOpenSignup(true)}
            className="mb-2 px-4 py-2 hover:bg-gray-200"
          >
            Sign up
          </button>
        </div>
        <SigninModel
          open={openSignin}
          onClickOutside={() => setOpenSignin(false)}
        />
        <SignupModel
          open={openSignup}
          onClickOutside={() => setOpenSignup(false)}
        />
      </>
    );
  };
  return (
    <div className="flex gap-6 mx-6">
      <Tippy
        interactive={true}
        render={renderTippy}
        delay={[200, 200]}
        animation={false}
        placement="bottom-end"
        hideOnClick={false}
        //   disabled={currenUser.status === "fail" || currenUser.status === undefined}
        trigger="mouseenter" //fix auto show after disabled is false
      >
        <button className="">
          <FontAwesomeIcon className="w-6 h-6" icon={faUser} />
        </button>
      </Tippy>
      <Link to="/favorite" className="flex items-center">
        <FontAwesomeIcon className="w-6 h-6" icon={faHeart} />
      </Link>
      <Cart />
    </div>
  );
}
