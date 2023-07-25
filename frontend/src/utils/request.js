import axios from "axios";

export const axiosClient = axios.create({
  baseURL: "http://127.0.0.1:8000/api",
  headers: {
    "content-type": "application/json",
  },
});
