import _ from "lodash";
window._ = _;

import axios from "axios";
window.axios = axios;
import toastr from "toastr";
toastr.options.timeOut = 50;
window.toastr = toastr;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
