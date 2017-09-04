<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="http://localhost:8080/resources/assets/css/style.css">
</head>
<body>
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
                    <button @click="showingEditModal = true;">Edit</button>
                </td>
                <td>
                    <button @click="showingDeleteModal = true;">Delete</button>
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
                            <button @click="showingAddModal = false; saveGroup();">Save</button>
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
                        <th><input type="text" name="" v-model="newGroup.title"></input></th>
                    </tr>
                    <tr>
                        <th>Image link</th>
                        <th>:</th>
                        <th><input type="text" name="" v-model="newGroup.imageLink"></input></th>
                    </tr>
                    <input type="hidden" name="id_user" value="" v-model="newGroup.id_user"/>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>
                            <button @click="showingEditModal = false;">Update</button>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div id="deleteModal" class="modal" v-if="showingDeleteModal">
        <div class="modalContainer">
            <div class="modalHeading">
                <p class="fleft">Delete group</p>
                <button class="fright close" @click="showingDeleteModal = false;">X</button>
                <div class="clear"></div>
            </div>
            <div class="modalContent">
                <p>You are going to delete...</p>
                <br>
                <button @click="showingDeleteModal = false;">Yes</button>
                <button @click="showingDeleteModal = false;">No</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.2/vue.min.js"></script>

<script type="text/javascript" src="http://localhost:8080/resources/assets/js/app.js"></script>
</body>
</html>