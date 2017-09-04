var app = new Vue({
    el: '#root',
    data: {
        showingAddModal: false,
        showingEditModal: false,
        showingDeleteModal: false,
        errorMessage: "",
        successMessage: "",
        sessionUser: {userId: ""},
        groups: [],
        newGroup: {id_user: "", title: "", imageLink: ""},
        newUser: {username: "", email: "", password: ""}
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
            axios.post('../../route/route.php?action=addGroup', formData)
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
            var formData = app.toFormData(app.newGroup);
            axios.post('../../route/route.php?action=addGroup', formData)
                .then(function (response) {
                    app.newGroup = {id_user: "", title: "", imageLink: ""};
                    if (response.data !== "") {
                        if (response.data.error) {
                            app.errorMessage = response.data.error;
                        } else {
                            app.getAllGroups();
                        }
                    }
                });
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
        }
    }
});