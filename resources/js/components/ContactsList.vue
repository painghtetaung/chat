<template>
    <div class="contacts-list">
        <ul>
            <li v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)" :class="{ 'selected' : contact == selected }">
                <div class="avatar">
                    <img :src="contact.profile_image" :alt="contact.name">
                </div>
                <div class="contact">
                    <p class="name">{{ contact.name }}</p>
                    <p class="email">{{ contact.email }}</p>
                </div>
                <span class="unread" v-if="contact.unread">{{ contact.unread }}</span>
                <span class="active" v-if="active(contact.id)">1</span>
            </li>
        </ul>
        
    </div>
</template>

<script>
export default {
    props: {
        contacts: {
            type: Array,
            default:[]
        },
        
    },
    data() {
        return {
            selected: this.contacts.length ? this.contacts[0] : null,
            activeFriends: [],
            index: null
        };
    },


    
    methods: {
        selectContact(contact) {
            this.selected = contact;

            this.$emit('selected', contact);
        },

            active(contactid)
         {

            for(var i=0; i < this.activeFriends.length; i++){
                if( this.activeFriends[i].activeFriend_id == contactid){
                return true
                }
            }
            return false
         } 
     
    },

    mounted() {

            axios.get('/actviefriend/get')
                .then((response) => {
                    this.activeFriends = response.data;
                    console.log('activeUsers',this.activeFriends);
                }),


            Echo.join(`plchat`)
                .here((users) => {
                    console.log('Active Friends',users);
                   
                })
                .joining((user) => {
                    
                    console.log(user.name,'Joined');
                    axios.post('/activefriend/add', {
                        activeFriend_id : user.id
                    }).then((response) => {
                        this.activeFriends.push(response.data);
                        // console.log(this.activeFriends);
                    });
                    
                })
                .leaving((user) => {
                   
                    this.index = this.activeFriends.indexOf(user);
                    this.activeFriends.splice(this.index,1);
                    axios.delete('/activefriend/delete', {params: {
                        'leavingFriend_id' : user.id}
                    })

                   
                    // this.activeFriends.splice(this.activeFriends.indexOf(user),1);
                    console.log(user.name,'Left');
                
                });

                
    },

    computed: {
        sortedContacts() {
            return _.sortBy(this.contacts, [(contact) => {
              if(contact == this.selected) {
                  return Infinity;
              }    
                return contact.unread;
            }]).reverse();
        }
    }
}
</script>

<style lang="scss" scoped>
.contacts-list {
    flex: 2;
    max-height: 600px;
    overflow: scroll;
    border-left: 1px solid #a6a6a6;

    
    ul {
        list-style-type: none;
        padding-left: 0;

        li {
            display: flex;
            padding: 2px;
            border-bottom: 1px solid #aaaaaa;
            height: 80px;
            position: relative;
            cursor: pointer;

            &.selected {
                background: #dfdfdf;
            }

            span.unread {
                background: #82e0a8;
                color: #fff;
                position: absolute;
                right: 11px;
                top: 20px;
                display: flex;
                font-weight: 700;
                min-width: 20px;
                justify-content: center;
                align-items: center;
                line-height: 20px;
                font-size: 12px;
                padding: 0 4px;
                border-radius: 3px; 
            }

            span.active {
                background: #9feb11;
                color: #fff;
                position: absolute;
                left: 11px;
                top: 20px;
                display: flex;
                font-weight: 700;
                min-width: 20px;
                justify-content: center;
                align-items: center;
                line-height: 20px;
                font-size: 12px;
                padding: 0 4px;
                border-radius: 8px; 
            }


            .avatar {
                flex: 1;
                display: flex;
                align-items: center;

                img {
                    width: 35px;
                    border-radius: 50px;
                    margin: 0 auto;
                }
            }

            .contact {
                flex: 3;
                font-size: 11px;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                justify-content: center;

                p {
                    margin: 0;

                    &.name {
                        font-weight: bold;
                    }
                }
            }
        }
    }
}
</style>






