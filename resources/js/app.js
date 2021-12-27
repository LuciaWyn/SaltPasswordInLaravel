require('./bootstrap');
import { createApp } from 'vue'
import Register from './forms/signup.vue'

createApp({
    components:{
        Register
    }
}).mount('.divbody')