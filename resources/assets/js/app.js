var app = new Vue({
    el: '#root',
    data: {
        showingAddModal: false,
        showingEditModal: false,
        showingDeleteModal: false,
        errorMessage: "",
        successMessage: "",
        sessionUser: {userId: "1"}, // Here must to be a php user's id !!!
        groups: [],
        newGroup: {id: "", id_user: "", title: "", imageLink: "", action: ""},
        newUser: {username: "", email: "", password: ""},
        clickedGroup: {}
    },
    mounted: function () {
        console.log('mounted!');
        this.getAllGroups();
    },
    methods: {
        login: function () {
            axios.get('../../route/route.php?action=login')
                .then(function (response) {
                    if (response.data !== "") {
                        if (response.data.error) {
                            app.errorMessage = response.data.error;
                        } else {
                            if (app.sessionUser.userId !== "" && response.data.userId !== "") {
                                app.sessionUser.userId = response.data.userId
                            } else {
                                app.errorMessage = 'Undefined login error occurs. Try again later.';
                            }
                        }
                    }
                });
        },
        registration: function () {
            var formData = app.toFormData(app.newUser);
            axios.post('../../route/route.php?action=registration', formData)
                .then(function (response) {
                    app.newUser = {username: "", email: "", password: ""};
                    if (response.data !== "") {
                        if (response.data.error) {
                            app.errorMessage = response.data.error;
                        } else {
                            if (app.sessionUser.userId !== "" && response.data.userId !== "") {
                                app.sessionUser.userId = response.data.userId
                            } else {
                                app.errorMessage = 'Undefined registration error occurs. Try again later.';
                            }
                        }
                    }
                });
        },
        logout: function () {
            axios.get('../../route/route.php?action=login')
                .then(function (response) {
                    if (response.data !== "") {
                        if (response.data.error) {
                            app.errorMessage = response.data.error;
                        } else {
                            if (response.data.userId !== "") {
                                app.sessionUser.userId = "";
                            } else {
                                app.errorMessage = 'Undefined login error occurs. Try again later.';
                            }
                        }
                    }
                });
        },
        getAllGroups: function () {
            axios.get('../../route/route.php?action=listAllGroups')
                .then(function (response) {
                    if (response.data !== "") {
                        if (response.data.error) {
                            app.errorMessage = response.data.error;
                        } else {
                            app.groups = response.data;
                        }
                    }
                });
        },
        saveGroup: function () {
            app.newGroup.id_user = app.sessionUser.userId; // Here must to be a php user's id !!!
            app.newGroup.action = "saveGroup";
            axios.post('/route/route.php', app.newGroup)
                .then(function (response) {
                    console.log(response.data);
                    app.clearGroup();
                    if (response.data !== "") {
                        if (response.data.error) {
                            app.errorMessage = response.data.error;
                        } else {
                            app.getAllGroups();
                        }
                    } else {
                        app.errorMessage = 'Something goes wrong. The server response is empty.';
                    }
                });
        },
        updateGroup: function () {
            app.clickedGroup.id_user = app.sessionUser.userId; // Here must to be a php user's id !!!
            app.clickedGroup.action = "saveGroup";
            axios.post('/route/route.php', app.clickedGroup)
                .then(function (response) {
                    console.log(response.data);
                    app.clearGroup();
                    if (response.data !== "") {
                        if (response.data.error) {
                            app.errorMessage = response.data.error;
                        } else {
                            app.getAllGroups();
                        }
                    } else {
                        app.errorMessage = 'Something goes wrong. The server response is empty.';
                    }
                });
        },
        deleteGroup: function () {
            app.clickedGroup.id_user = app.sessionUser.userId;
            app.clickedGroup.action = "replaceGroup";
            axios.post('/route/route.php', app.clickedGroup)
                .then(function (response) {
                    console.log(response.data);
                    app.clearGroup();
                    if (response.data !== "") {
                        if (response.data.error) {
                            app.errorMessage = response.data.error;
                        } else {
                            app.successMessage = response.data.success;
                            app.getAllGroups();
                        }
                    } else {
                        app.errorMessage = 'Something goes wrong. The server response is empty.';
                    }
                });
        },
        selectGroup: function (group) {
            app.clickedGroup = group;
        },
        toFormData: function (obj) {
            var formData = new FormData(app.newGroup);
            for (var key in obj) {
                formData.append(key, obj[key]);
            }
            return formData;
        },
        clearMessage: function () {
            app.errorMessage = "";
            app.successMessage = "";
        },
        clearSessionUser: function () {
            app.sessionUser.userId = "";
        },
        clearGroup: function () {
            app.newGroup = {id_user: "", title: "", imageLink: "", action: ""};
        }
    }
});