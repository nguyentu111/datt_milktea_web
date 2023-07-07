import { BrowserRouter, Route, Routes } from "react-router-dom";
import "./App.css";
import Home from "./pages/Home";
import DefaultLayout from "./layouts/DefaultLayout";
import Category from "./pages/Category";
import Favorite from "./pages/Favorite";
import { SigninContextProvider } from "./contexts/SigninContext";
import { SignupContextProvider } from "./contexts/SignupContext";
import Account from "./pages/Account";
import UserLayout from "./layouts/UserLayout";
function App() {
  return (
    <SigninContextProvider>
      <SignupContextProvider>
        <BrowserRouter>
          <Routes>
            <Route path="/" element={<DefaultLayout />}>
              <Route index element={<Home />} />
              <Route path="/favorite" element={<Favorite />} />
              <Route path="/category" element={<Category />} />
            </Route>
            <Route path="/account" element={<UserLayout />}>
              <Route index element={<Account />} />
            </Route>
            <Route path="*" element={<DefaultLayout />}>
              <Route index element={<div>Not found</div>} />
            </Route>
          </Routes>
        </BrowserRouter>
      </SignupContextProvider>
    </SigninContextProvider>
  );
}

export default App;
