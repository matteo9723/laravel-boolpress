<template>
  <main class="container">
      <h1>Contatti</h1>
      <h2 v-if="success" class="success">Email inviata correttamente</h2>

        <div class="form">
            <form @submit.prevent="sendForm">
                <div class="field">
                    <label for="name"> Nome</label>
                    <input v-model="name" type="text" id="name" required>
                    <p v-if="errors.name" class="errors">{{ errors.name[0] }}</p>
                </div>
                <div class="field">
                    <label for="">Email</label>
                    <input v-model="email" type="email" required>
                    <p v-if="errors.email" class="errors">{{ errors.email[0] }}</p>
                </div>
                <div class="field">
                    <label for="message">Messaggio</label>
                    <textarea v-model="message"  id="message" cols="30" rows="10" required></textarea>
                    <p v-if="errors.message" class="errors">{{ errors.message[0] }}</p>
                </div>
                <button type="submit" :disabled="sending">
                    {{ sending ? 'Invio in corso...' : 'Invia' }}
                </button>

            </form>
        </div>

  </main>
</template>

<script>
export default {
    name: 'Contacts',
    data(){
        return{
            name:'',
            email:'',
            message:'',
            errors:{},
            sending: false,
            success:  false
        }
    },
    methods:{
        sendForm(){
            this.sending = true;
            this.success = false;
            console.log('invio form');
            axios.post('api/contacts',{
                'name': this.name,
                'email': this.email,
                'message': this.message,
            }).then(res => {
                this.sending = false;
                console.log(res.data);
                if(!res.data.success){
                    this.errors = res.data.errors;
                }else{
                    this.success = true;
                    this.errors = {},
                    this.name = '',
                    this.email = '',
                    this.message = ''
                }
            })
        }
    }
}
</script>

<style lang="scss" scoped>
.container{
    margin-top: 30px;
    margin-bottom: 100px;
    .success{
        color: green;
    }
    .form{
        .field{
            margin-bottom: 20px;
            label{
                display: block;
            }
            input, textarea{
                margin: 10px 0;
                padding: 6px 8px;
                width: 100%;
            }
        }
        button{
            border-radius: 6px;
            border: none;
            padding: 6px;
            cursor: pointer;
            color: cadetblue;
        }
        .errors{
            font-size: 12px;
            color: red;
        }

    }
}
</style>
