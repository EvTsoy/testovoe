import { createRouter, createWebHistory } from 'vue-router';
import BranchList from './components/BranchList.vue';
import WorkerList from './components/WorkerList.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', redirect: '/branches' },
    { path: '/branches', component: BranchList },
    { path: '/branches/:id/workers', component: WorkerList },
  ],
});

export default router;
