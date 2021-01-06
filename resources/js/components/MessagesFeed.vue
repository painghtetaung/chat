<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li v-for="message in messages" :key="message.id" :class="`message${message.to == contact.id ? ' sent' : ' received'}`">
                <div class="text" v-if="message.text">
                    {{ message.text }}
                </div>

                <div class="image-container">
                    <img v-if="message.image" :src="'/storage/'+message.image" alt="">
                </div>

               <!-- <v-flex class="caption font-italic">
                  {{message.created_at}}
                </v-flex>
                <br> -->
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        contact: {
            type: Object
        },
        messages: {
            type: Array,
            required: true
        }
    },
    methods: {
        scrollToBottom() {
            setTimeout(() => {
                this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            }, 50);
        },
    },
    
    watch: {
            contact(contact) {
                this.scrollToBottom();
            },
            messages(messages) {
                this.scrollToBottom();
            }
    } 
    
}
</script>

<style lang="scss" scoped>

.feed {
    background: #f0f0f0;
    height: 100%;
    max-height: 470px;
    overflow: scroll;

    ul {
        list-style-type: none;
        padding: 5px;

        li {
            &.message {
                margin: 10px 0;
                width: 100%;

                .text {
                    max-width: 200px;
                    border-radius: 5px;
                    padding: 12px;
                    display: inline-block;
                }

                img {
                        max-width: 250px;
                        max-height: 200px;
                    }

                &.received {
                    text-align: left;

                    .text {
                        background: #f7e6e6;
                    }
                }

                &.sent {
                    text-align: right;

                    .text {
                        background: #f7f7f7;
                    }
                }
            }
        }
      
    }
}

</style>