<template>
  <div>
    <table>
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
          <td>{{ store.balance}}</td>
          <td>
            <router-link :to="{name:'Store', params: {store: store.id}}">Transações</router-link>
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
  }
}
</script>