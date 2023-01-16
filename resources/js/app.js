import './bootstrap';

import { createApp } from 'vue';
import site from './components/Site/Home/main.vue';
import cp from './components/ControlPanel/Dashboard/main.vue';

var siteComp = createApp({});
siteComp.component('site-app', site);
siteComp.mount("#site-app");

var cpComp = createApp({});
cpComp.component('cp-app', cp);
cpComp.mount("#cp-app");
