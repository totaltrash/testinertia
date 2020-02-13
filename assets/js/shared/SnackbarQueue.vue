<template>
  <v-snackbar v-model="display" :timeout="2000">
    {{ message }}
    <v-btn
      color="pink"
      text
      @click="close"
    >
      Close
    </v-btn>
  </v-snackbar>
</template>

<script>
import EventBus from '~/eventbus.js'
export default {
  data: function () {
    return {
      item: null,
      queue: [],
      // displaying: false
    }
  },
  created () {
    EventBus.$on('snackbar', (payload) => {
      console.log(payload)
      this.queue.push(payload)
      this.processQueue()
    })
  },
  computed: {
    display: {
      get: function () {
        return this.item !== null
      },
      set: function (isDisplaying) {
        console.log('Set Called: ' + isDisplaying)
        if (!isDisplaying) {
          console.log('setting item to null')
          this.item = null
        }
        this.processQueue()
      }
    },
    message: function () {
      return this.item ? this.item.message : null
    }
  },
  // watch: {
  //   items: function (newItems) {
  //     for (let type in newItems) {
  //       let messages = newItems[type]
  //       for (let message in messages) {
  //         queue.push({ type, message })
  //       }
  //     }
  //   }
  // },
  methods: {
    close: function () {
      this.item = null
      this.processQueue()
    },
    processQueue: function () {
      if (this.item === null && this.queue.length !== 0) {
        console.log('shifting queue')
        this.item = this.queue.shift()
      }
    }
  }
}

</script>
