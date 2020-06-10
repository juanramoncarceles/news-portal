import Home from './views/HomeView';
import News from './views/NewsView';
import Contact from './views/ContactView';
import NewsByCategory from './views/NewsByCategoryView';
import NotFound from './views/NotFoundView';

// Vue routes set up.
export const routes = [
  { path: '/', component: Home },
  { path: '/news/:id', name: 'News', component: News },
  { path: '/category/:id', name: 'Category', component: NewsByCategory },
  { path: '/contact', component: Contact },
  { path: '*', name: 'NotFound', component: NotFound }
];