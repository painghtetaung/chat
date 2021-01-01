<template>
    <div class="conversation">
        <h1>{{ contact ? contact.name: 'Select a Contact' }}</h1>
        <MessagesFeed :contact="contact" :messages="messages" />
        <MessageComposer :contact="contact" v-if='contact' @send = "sendMessage" @fetchMessages="fetchMessages"/>
    </div>
</template>

<script>
    import MessagesFeed from './MessagesFeed';
    import MessageComposer from './MessageComposer';
export default {

    components: {

        MessagesFeed,
        MessageComposer

    },

    props: {
        contact: {
            type: Object,
            default: null
        },
        messages: {
            type: Array,
            default: []
        }
    },
    methods: {
        sendMessage(text) {
            if (!this.contact) 
            {
                return;//should add later console.log or somthing 
            }

            axios.post('/conversation/send', {
                contact_id: this.contact.id,//receiver id
                text: text,
            }).then((response) => {
                this.$emit('new', response.data); 
            })
        },

        fetchMessages(contact) {
                // axios.get(`/conversation/${contact.id}`)
                //     .then((response) => {
                       this.$emit('newFile', this.contact);
                       console.log("emit");
                       console.log(this.contact);
                    
            },

        // sendImage(image) {
        //     if (!this.contact) 
        //     {
        //         return;//should add later console.log or somthing 
        //     }

        //     axios.post('/conversation/send', {
        //         contact_id: this.contact.id,//receiver id
        //         image: image
        //     }).then((response) => {
        //         this.$emit('new', response.data); 
        //     })
        // }
    }

}
</script>

<style lang="scss" scoped>
.conversation {
    flex: 5;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    h1 {
        font-size: 20px;
        padding: 10px;
        margin: 0;
        border-bottom: 1px dashed lightgray;
    }
}
</style>