import Vue from 'vue'
import App from './App.vue'
import router from './router'
import './main.css'
import VueCurrencyFilter from 'vue-currency-filter'
import VueMoment from 'vue-moment'
import { VueMaskFilter } from 'v-mask'

Vue.config.productionTip = false

Vue.use(VueCurrencyFilter,
{
  symbol : ' R$',
  thousandsSeparator: '.',
  fractionCount: 2,
  fractionSeparator: ',',
  symbolPosition: 'front',
  symbolSpacing: true,
  avoidEmptyDecimals: undefined,
})

Vue.use(VueMoment);
Vue.filter('mask', VueMaskFilter);

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
