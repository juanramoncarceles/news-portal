import Home from './components/MyHomeComponent';
import Contact from './components/MyContactComponent';
import NewsByCategory from './views/NewsByCategory';

// Vue routes set up.
export const routes = [
  { path: '/', component: Home },
  { path: '/category/:id', name: 'Category', component: NewsByCategory },
  { path: '/contact', component: Contact }
];