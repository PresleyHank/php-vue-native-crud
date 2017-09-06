<template>
    <div id="fake-nav">
        <a href="#register" @click="open('register', $event)">Register</a>
        <a href="#login" @click="open('login', $event)">Login</a>
    </div>
    <div class="user-modal-container" :class="{ 'active': active }" id="login-modal" @click="close">
        <div class="user-modal">
            <ul class="form-switcher">
                <li @click="flip('register', $event)"><a href="" id="register-form">Register</a>

                </li>
                <li @click="flip('login', $event)"><a href="" id="login-form">Login</a>

                </li>
            </ul>
            <div class="form-register" :class="{ 'active': active == 'register' }" id="form-register">
                <div class="error-message" v-text="registerError"></div>
                <input type="text" name="name" placeholder="Name" v-model="registerName"
                       @keyup.enter="submit('register', $event)">
                <input type="email" name="email" placeholder="Email" v-model="registerEmail"
                       @keyup.enter="submit('register', $event)">
                <input type="password" name="password" placeholder="Password" v-model="registerPassword"
                       @keyup.enter="submit('register', $event)">
                <input type="submit" :class="{ 'disabled': submitted == 'register' }"
                       @click="submit('register', $event)" v-model="registerSubmit" id="registerSubmit">
                <div class="links"><a href="" @click="flip('login', $event)">Already have an account?</a>

                </div>
            </div>
            <div class="form-login" :class="{ 'active': active == 'login' }" id="form-login">
                <div class="error-message" v-text="loginError"></div>
                <input type="text" name="user" placeholder="Email or Username" v-model="loginUser"
                       @keyup.enter="submit('login', $event)">
                <input type="password" name="password" placeholder="Password" v-model="loginPassword"
                       @keyup.enter="submit('login', $event)">
                <input type="submit" :class="{ 'disabled': submitted == 'login' }" @click="submit('login', $event)"
                       v-model="loginSubmit" id="loginSubmit">
                <div class="links"><a href="" @click="flip('password', $event)">Forgot your password?</a>

                </div>
            </div>
            <div class="form-password" :class="{ 'active': active == 'password' }" id="form-password">
                <div class="error-message" v-text="passwordError"></div>
                <input type="text" name="email" placeholder="Email" v-model="passwordEmail"
                       @keyup.enter="submit('password', $event)">
                <input type="submit" :class="{ 'disabled': submitted == 'password' }"
                       @click="submit('password', $event)" v-model="passwordSubmit" id="passwordSubmit">
            </div>
        </div>
    </div>
</template>

<script>
    var nav = new Vue({
        el: '#fake-nav',
        methods: {
            open: function (which, e) {
                e.preventDefault();
                modal.active = which;
            }
        }
    });

    var modal_submit_register = 'Register';
    var modal_submit_password = 'Reset Password';
    var modal_submit_login = 'Login';

    var modal = new Vue({
        el: '#login-modal',
        data: {
            active: null,
            submitted: null,

            // Submit button text
            registerSubmit: modal_submit_register,
            passwordSubmit: modal_submit_password,
            loginSubmit: modal_submit_login,

            // Modal text fields
            registerName: '',
            registerEmail: '',
            registerPassword: '',
            loginUser: '',
            loginPassword: '',
            passwordEmail: '',

            // Modal error messages
            registerError: '',
            loginError: '',
            passwordError: ''
        },
        methods: {
            close: function (e) {
                e.preventDefault();
                if (e.target === this.$el) {
                    this.active = null;
                }
            },
            flip: function (which, e) {
                e.preventDefault();
                if (which !== this.active) {
                    this.active = which;
                }
            },
            submit: function (which, e) {
                e.preventDefault();
                this.submitted = which;
                var data = {
                    form: which
                };

                switch (which) {
                    case 'register':
                        data.name = this.registerName;
                        data.email = this.registerEmail;
                        data.password = this.registerPassword;
                        this.$set('registerSubmit', 'Registering...');
                        break;
                    case 'login':
                        data.user = this.loginUser;
                        data.password = this.loginPassword;
                        this.$set('loginSubmit', 'Logging In...');
                        break;
                    case 'password':
                        data.email = this.passwordEmail;
                        this.$set('passwordSubmit', 'Resetting Password...');
                        break;
                }
            }
        }
    });
</script>