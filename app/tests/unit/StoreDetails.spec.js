import { shallowMount } from '@vue/test-utils'
import Vue from 'vue';
import StoreDetais from '@/components/StoreDetails.vue'
import VueCurrencyFilter from "vue-currency-filter";

describe('StoreDetail.vue', () => {
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

  it('renders props.store when passed', () => {
    const store = {
      name: 'Store',
      balance: -100,
      owner: {
        name: 'Owner'
      }
    }
    const wrapper = shallowMount(StoreDetais, {
      propsData: { store }
    })
    const spans = wrapper.findAll('span')
    const span = spans.at(0)
    expect(wrapper.text()).toMatch('Store')
    expect(wrapper.text()).toMatch('- R$ 100,00')
    expect(span.classes()).toContain('danger')
  })
})
