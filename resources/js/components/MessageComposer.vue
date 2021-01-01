<template>
  <dir class="composer">
  
     <file-upload
        :post-action="'/conversation/send/'+contact.id"
        ref='upload'
        v-model="files"
         @input-file="$refs.upload.active = true"
        :headers="{'X-CSRF-TOKEN': token}" 
    >
        Attach File
     </file-upload>
      
      <textarea v-model="message" @keydown.enter="send" placeholder="Message..."></textarea>
  </dir> 
</template>

<script>

export default {

     props: {
        contact: {
            type: Object,
            
        },
        
    },

    data() {
        return {
            message: '',
            messages: [],
            files: [],
            token:document.head.querySelector('meta[name="csrf-token"]').content,
            
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
        },

        
       
        // sendFiles(event) {
        //     this.files=event.target.files[0];
        //     this.files = this.files.name;
        //     console.log(this.files.name);

        //     this.$emit('sendImage', this.files);
        //     this.files = '';
        //     // axios.post('/conversation/imgsend', {
        //     //     image: this.files
        //     // }).then((response) => {
        //     //     console.log("send image") 
        //     // })

        // }

    },

    watch:{
        files:{
            deep:true,
            handler(){
                let success = this.files[0].success;
                if(success){
                     this.$emit('fetchMessages',this.contact);
                     console.log(this.contact);
                }
            }
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