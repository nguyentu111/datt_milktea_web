import { BrowserRouter, Route, Routes } from "react-router-dom";
import "./App.css";
import Home from "./pages/Home";
import DefaultLayout from "./layouts/DefaultLayout";
import Category from "./pages/Category";
import Favorite from "./pages/Favorite";
import Checkout from "./pages/Checkout";
import { SigninContextProvider } from "./contexts/SigninContext";
import { SignupContextProvider } from "./contexts/SignupContext";
import Account from "./pages/Account";
import NoSizebarLayout from "./layouts/NoSizebarLayout";
import { QueryClient, QueryClientProvider } from "react-query";
import Auth from "./components/shared/Auth";
import toastr from "toastr";
import { store } from "./redux/app";
import { Provider } from "react-redux";
const queryClient = new QueryClient();
function App() {
  toastr.options.timeOut = 50;
  return (
    <Provider store={store}>
      <QueryClientProvider client={queryClient}>
        <SigninContextProvider>
          <SignupContextProvider>
            <BrowserRouter>
              <Routes>
                <Route path="/" element={<DefaultLayout />}>
                  <Route index element={<Home />} />
                  <Route path="/favorite" element={<Favorite />} />
                  <Route path="/category" element={<Category />} />
                </Route>
                <Route
                  path="/checkout"
                  element={
                    <Auth>
                      <NoSizebarLayout />
                    </Auth>
                  }
                >
                  <Route index element={<Checkout />} />
                </Route>
                <Route
                  path="/account"
                  element={
                    <Auth>
                      <NoSizebarLayout />
                    </Auth>
                  }
                >
                  <Route index element={<Account />} />
                </Route>
                <Route path="*" element={<DefaultLayout />}>
                  <Route index element={<div>Not found</div>} />
                </Route>
              </Routes>
            </BrowserRouter>
          </SignupContextProvider>
        </SigninContextProvider>
      </QueryClientProvider>
    </Provider>
  );
}

export default App;
