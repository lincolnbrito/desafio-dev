<template>
  <table class="striped">
    <thead>
      <tr>
        <th>Loja</th>
        <th>Proprietário</th>
        <th>Saldo</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{ store.name }}</td>
        <td>{{ store.owner.name }}</td>
        <td>
          <span :class="getClass(store.balance)">{{ store.balance}}</span>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>

export default {
  props: {
    store: {
      type: Object,
      required: true
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