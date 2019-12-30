<template>
    <p id="my-para">Testing {{ prop }}</p>
</template>

<script>
import Layout from '~/shared/Layout'

export default {
  props: {
    prop: {
      required: true,
      type: String
    }
  },
  layout: Layout,
}
</script>

<style>

</style>
