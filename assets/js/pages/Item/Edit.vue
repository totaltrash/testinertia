<template>
  <div>
    <v-toolbar flat>
      <v-toolbar-title class="font-weight-light my-4 display-1">{{ formTitle }}</v-toolbar-title>
    </v-toolbar>
    <v-form class="white px-2">
      <v-container>
        <v-row>
          <v-col cols="12">
            <v-text-field v-model="form.name" label="Item name" :error-messages="errors.name"></v-text-field>
          </v-col>
          <v-col cols="12" sm="4">
            <v-text-field v-model="form.price" label="Price" :error-messages="errors.price"></v-text-field>
          </v-col>
          <v-col cols="12" class="text-right">
            <v-btn color="blue" text @click="$visitRoute('item_list')">Cancel</v-btn>
            <v-btn color="blue" dark @click="save" :loading="sending">Save</v-btn>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
    
  </div>
</template>

<script>
import Layout from '~/shared/Layout'

export default {
  props: {
    item: {
      required: true,
      type: Object
    },
    errors: {
      required: false,
      type: Object,
      default () {
        return {}
      }
    }
  },
  data () {
    return {
      sending: false,
      form: {
        name: this.item.name,
        price: this.item.price,
      }
    }
  },
  computed: {
    formTitle () {
      return 'Edit Item'
      //return this.form.id === null ? 'New Item' : 'Edit Item'
    },
  },
  methods: {
    save () {
      this.sending = true
      this.$inertia.put(this.$route('item_update', {id: this.item.id}), this.form)
        .then(() => this.sending = false)
    },
  },
  layout: Layout,
}
</script>

<style>

</style>
