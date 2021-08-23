<template>
  <div>
    <table class="striped">
      <thead>
        <tr>
          <th>Loja</th>
          <th>Proprietário</th>
          <th>Saldo</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="store in stores" :key="store.id">
          <td>{{ store.name }}</td>
          <td>{{ store.owner.name }}</td>
          <td>
            <span :class="getClass(store.balance)">{{ store.balance}}</span>
          </td>
          <td>
            <router-link :to="{name:'Store', params: {id: store.id}}">Visualizar</router-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

export default {
  props: {
    stores: {
      type: Array
    }
  },
  methods: {
    getClass(balance) {
      return {
        'danger': balance < 0 ,
        'success': balance > 0
      }
    }
  }
}
</script>