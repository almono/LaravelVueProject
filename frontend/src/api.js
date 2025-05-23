import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000', // Laravel backend endpoint ( /api )
  withCredentials: true, // Ensures cookies are sent automatically
  withXSRFToken: true,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
});

export default api;
