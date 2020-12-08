<template>
  <dir class="composer">
      <textarea v-model="message" @keydown.enter="send" placeholder="Message..."></textarea>
  </dir> 
</template>

<script>
export default {
    data() {
        return {
            message: ''
        };
    },
    methods: {
        send(e) {
            e.preventDefault(); //to prevent when click the enter get a new line which is default browser setting
            if(this.message == '') {
                return;
            }

            this.$emit('send', this.message);
            this.message = '';
        }
    }


}
</script>

<style lang="scss" scoped>

.composer textarea {
    width: 96%;
    margin: 0;
    resize: none;
    border-radius: 3px;
    border: 1px solid lightgray;
    padding: 6px;

}

</style>