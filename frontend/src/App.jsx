import { BrowserRouter, Route, Routes } from "react-router-dom";
import "./App.css";
import Home from "./pages/Home";
import DefaultLayout from "./layouts/DefaultLayout";
import Category from "./pages/Category";
import Favorite from "./pages/Favorite";
import Checkout from "./pages/Checkout";
import { SigninContextProvider } from "./contexts/SigninContext";
import { SignupContextProvider } from "./contexts/SignupContext";
import { AddressModelProvider } from "./contexts/AddressModalContext";
import Account from "./pages/Account";
import NoSizebarLayout from "./layouts/NoSizebarLayout";
import { QueryClient, QueryClientProvider } from "react-query";
import Auth from "./components/shared/Auth";
import toastr from "toastr";
import { store } from "./redux/app";
import { Provider } from "react-redux";
import axios from "axios";
import Notfound from "./pages/Notfound";
const queryClient = new QueryClient();
function App() {
  toastr.options.timeOut = 50;

  return (
    <Provider store={store}>
      <QueryClientProvider client={queryClient}>
        <SigninContextProvider>
          <SignupContextProvider>
            <AddressModelProvider>
              <BrowserRouter>
                <Routes>
                  <Route path="/" element={<DefaultLayout />}>
                    <Route index element={<Home />} />
                    <Route path="/favorite" element={<Favorite />} />
                    <Route path="/category/:slug" element={<Category />} />
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

                  <Route
                    path="/*"
                    element={
                      <NoSizebarLayout>
                        <Notfound></Notfound>
                      </NoSizebarLayout>
                    }
                  />
                </Routes>
              </BrowserRouter>
            </AddressModelProvider>
          </SignupContextProvider>
        </SigninContextProvider>
      </QueryClientProvider>
    </Provider>
  );
}

export default App;
