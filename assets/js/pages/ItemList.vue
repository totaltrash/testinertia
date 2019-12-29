<template>
  <v-data-table
    :headers="headers"
    :items="items"
    :items-per-page="5"
    class="elevation-1"
  ></v-data-table>
</template>

<script>
import Layout from '../shared/Layout'

export default {
  props: {
    items: {
      required: true,
      type: Array
    }
  },
  data () {
    return {
      headers: [
        {
          text: '#',
          value: 'id'
        },
        {
          text: 'Name',
          value: 'name'
        },
        {
          text: 'Price',
          value: 'price'
        },
      ]
    }
  },
  layout: Layout,
}
</script>

<style>

</style>
