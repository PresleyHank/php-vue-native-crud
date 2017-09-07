<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="http://localhost:8080/resources/assets/css/style.css">
    <link rel="stylesheet" href="http://localhost:8080/resources/assets/css/loginAndRegistrationModal.css">
</head>
<body>
<div id="header">

    <div id="fake-nav">
        <div v-show="!authenticated">
            <a href="#login" @click="open('login', $event);">Login</a>
            <a href="#register" @click="open('registration', $event);">Register</a>
        </div>
        <div v-show="authenticated">
            <a href="#logout" @click="logout();">Logout</a>
        </div>
    </div>

    <div id="login-modal" class="user-modal-container" :class="{'active': active}"
         @click="clearMessages(); close($event);">
        <div class="user-modal">
            <ul class="form-switcher">
                <li><a href="" @click="flip('registration', $event);" id="register-form">Register</a>

                </li>
                <li><a href="" @click="flip('login', $event);" id="login-form">Login</a>

                </li>
            </ul>
            <p class="successMessage" v-show="modalSuccessMessage">
                {{modalSuccessMessage}}
            </p>
            <p class="errorMessage" v-show="errors" v-for="error in errors">
                {{error}}
            </p>
            <div class="form-register" id="form-register" :class="{'active': active == 'registration'}">
                <div class="login-error-message"></div>
                <input type="text" name="username" placeholder="Name" v-model="userRegistration.username">
                <input type="email" name="email" placeholder="Email" v-model="userRegistration.email">
                <input type="password" name="password" placeholder="Password" v-model="userRegistration.password">
                <input type="password" name="secondaryPassword" placeholder="Password"
                       v-model="userRegistration.secondaryPassword">
                <input type="submit" id="registerSubmit" @click="registration();">
                <div class="links"><a href="" @click="flip('login', $event);">Already have an account?</a>
                </div>
            </div>
            <div class="form-login" id="form-login" :class="{'active': active == 'login'}">
                <div class="error-message"></div>
                <input type="text" name="user" placeholder="Email or Username" v-model="userLogin.usernameOrEmail">
                <input type="password" name="password" placeholder="Password" v-model="userLogin.password">
                <input type="submit" id="loginSubmit" @click="login();">
                <div class="links"><a href="" @click="flip('password', $event);">Forgot your password?</a>
                </div>
            </div>
            <div class="form-password" id="form-password" :class="{'active': active == 'password'}">
                <div class="error-message"></div>
                <input type="text" name="email" placeholder="Email">
                <input type="submit" id="passwordSubmit">
            </div>
        </div>
    </div>
</div>

<div id="root">
    <div class="container">
        <h1 class="fleft">List of groups</h1>
        <button class="fright addNew" @click="showingAddModal = true;">Add new group</button>
        <div class="clear"></div>
        <p class="errorMessage" v-if="errorMessage">
            {{errorMessage}}
        </p>
        <p class="successMessage" v-if="successMessage">
            {{successMessage}}
        </p>
        <hr>
        <table class="list">
            <tr>
                <th>Group Id</th>
                <th>Title</th>
                <th>Image Link</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <tr v-for="group in groups">
                <td>{{group.id}}</td>
                <td>{{group.title}}</td>
                <td>{{group.imageLink}}</td>
                <td>
                    <button @click="showingEditModal = true; selectGroup(group)">Edit</button>
                </td>
                <td>
                    <button @click="showingDeleteModal = true; selectGroup(group)">Delete</button>
                </td>
            </tr>
        </table>
    </div>
    <div id="addModal" class="modal" v-if="showingAddModal">
        <div class="modalContainer">
            <div class="modalHeading">
                <p class="fleft">Add new group</p>
                <button class="fright close" @click="showingAddModal = false;">X</button>
                <div class="clear"></div>
            </div>
            <div class="modalContent">
                <table class="form">
                    <tr>
                        <th>Title</th>
                        <th>:</th>
                        <th><input type="text" name="" v-model="newGroup.title"></input></th>
                    </tr>
                    <tr>
                        <th>Image link</th>
                        <th>:</th>
                        <th><input type="text" name="" v-model="newGroup.imageLink"></input></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>
                            <button type="submit" @click="showingAddModal = false; saveGroup();">Save</button>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div id="editModal" class="modal" v-if="showingEditModal">
        <div class="modalContainer">
            <div class="modalHeading">
                <p class="fleft">Edit group</p>
                <button class="fright close" @click="showingEditModal = false;">X</button>
                <div class="clear"></div>
            </div>
            <div class="modalContent">
                <table class="form">
                    <tr>
                        <th>Title</th>
                        <th>:</th>
                        <th><input type="text" name="" v-model="clickedGroup.title"></input></th>
                    </tr>
                    <tr>
                        <th>Image link</th>
                        <th>:</th>
                        <th><input type="text" name="" v-model="clickedGroup.imageLink"></input></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>
                            <button @click="showingEditModal = false; updateGroup()">Update</button>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div id="deleteModal" class="modal" v-if="showingDeleteModal">
        <div class="modalContainer">
            <div class="modalHeading">
                <p class="fleft">Are you sure? </p>
                <button class="fright close" @click="showingDeleteModal = false;">X</button>
                <div class="clear"></div>
            </div>
            <div class="modalContent">
                <p>You are going to delete group "{{clickedGroup.title}}"...</p>
                <br>
                <button @click="showingDeleteModal = false; deleteGroup();">Yes</button>
                <button @click="showingDeleteModal = false;">No</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.2/vue.js"></script>

<script type="text/javascript" src="http://localhost:8080/resources/assets/js/app.js"></script>
</body>
</html>