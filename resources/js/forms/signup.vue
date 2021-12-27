<template>
    <form action="/signup" method="post">
        <input type="hidden" name="_token" :value="csrf">
        <div class="row mb-3  justify-content-center">
            <label class='form-label col-sm-5 col-md-3 pe-1' for='email'>E-mail:</label>
            <div class="col-sm-7 col-md-9">
                <input class='form-control' name='email' v-model='email' @input="matchmail" />
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="password" class="form-label col-sm-6 col-md-3 pe-1">Password:</label>
            <div class="col-sm-6 col-md-9">
                <input class='form-control' name='password' v-model='password' type="password" @input="matchpass" />
            </div>
        </div>
        <p class="row warn col-sm-12 ps-3" v-for='err,i in passwordError' v-bind:key='i'>{{err}}</p>
        <div class="row mb-3 justify-content-center">
            <label for="password_confirmation" class="form-label col-sm-6 col-md-3 pe-1">Confirm Password:</label>
            <div class='col-sm-6 col-md-9'>
                <input class='form-control' name='password_confirmation' v-model='cofirm' type="password"  @input="matchpass" />
            </div>
        </div>
        
        <p class="warn col-sm-12 ps-3">{{confirmnotes}}</p>
        <div class="row justify-content-center">
            <div class="col-sm-3 justify-content-center">
                <input class="submit btn btn-primary" type="submit" v-if="(confirmMail == true)&&(confirmpswrd == true)" value='Sign Up'/>
            </div>
        </div>
    </form>
</template>
<script>
export default {
    name:'signup',
    data(){
        return{
            email: '',
            password: '',
            cofirm: '',
            confirmMail: false,
            confirmpswrd: false,
            confirmnotes: '',
            passwordError: [],
            name: '',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    methods:{
        matchmail: function(){
            let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/;
            if(re.test(this.email)){
                this.confirmMail = true;
            }
            else{
                this.confirmMail = false;
            }
        },
        matchpass:function(){
            let lowercase = /[a-z]/;
            this.passwordError = [];
            if(!lowercase.test(this.password)){
                this.passwordError.push('Lowercase letter required.');
            }
            let uppercase = /[A-Z]/;
            if(!uppercase.test(this.password)){
                this.passwordError.push('Upper case letter required.');
            }
            let numbers = /[0-9]/;
            if(!numbers.test(this.password)){
                this.passwordError.push('Number required');
            }
            let others = /[^a-zA-Z0-9]/;
            if(!others.test(this.password)){
                this.passwordError.push('Special Character required.');
            }
            if(this.password.length < 9){
                this.passwordError.push('Password must be at least 9 characters long.')
            }
            if(this.passwordError.length > 0){
                this.passwordError = this.shuffle(this.passwordError);
            }
            if(this.password != this.cofirm){
                this.confirmnotes = 'Password and Confirm Password don\'t match.';
            }
            else{
                this.confirmnotes = '';
            }
            if((this.passwordError.length == 0)&&(this.password == this.cofirm)){
                this.confirmpswrd = true;
            }
            else{
                this.confirmpswrd = false;
            }
        },
        shuffle:function(array) {
            var currentIndex = array.length, temporaryValue, randomIndex;

            // While there remain elements to shuffle...
            while (0 !== currentIndex) {

                // Pick a remaining element...
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex -= 1;

                // And swap it with the current element.
                temporaryValue = array[currentIndex];
                array[currentIndex] = array[randomIndex];
                array[randomIndex] = temporaryValue;
            }

            return array;
        }
    }
}
</script>
<style scoped>

</style>