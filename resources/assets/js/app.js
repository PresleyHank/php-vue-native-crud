var header = new Vue({
    el: '#fake-nav',
    data: {
        authenticated: false
    },
    methods: {
        open: function (which, e) {
            e.preventDefault();
            signInUpModal.active = which;
        }
    }
});

var signInUpModal = new Vue({
    el: '#login-modal',
    data: {
        active: null,
        sessionUserId: "",
        userLogin: {action: "", login: "", password: ""},
        userRegistration: {action: "", username: "", email: "", password: ""}
    },
    methods: {
        login: function () {
            signInUpModal.userLogin.action = "login";
            axios.post('../../route/route.php', JSON.stringify(signInUpModal.userLogin))
                .then(function (response) {
                    signInUpModal.clearUserLogin();
                    if (response.data !== "") {
                        if (response.data.error) {
                            groupManagerModule.errorMessage = response.data.error;
                        } else {
                            if (groupManagerModule.sessionUser.userId !== "" && response.data.userId !== "") {
                                groupManagerModule.sessionUser.userId = response.data.userId
                            } else {
                                groupManagerModule.errorMessage = 'Undefined login error occurs. Try again later.';
                            }
                        }
                    }
                });
        },
        registration: function () {
            signInUpModal.userRegistration = "registration";
            axios.post('../../route/route.php', JSON.stringify(signInUpModal.userRegistration))
                .then(function (response) {
                    signInUpModal.clearUserRegistration();
                    if (response.data !== "") {
                        if (response.data.error) {
                            groupManagerModule.errorMessage = response.data.error;
                        } else {
                            if (groupManagerModule.sessionUser.userId !== "" && response.data.userId !== "") {
                                groupManagerModule.sessionUser.userId = response.data.userId
                            } else {
                                groupManagerModule.errorMessage = 'Undefined registration error occurs. Try again later.';
                            }
                        }
                    }
                });
        },
        logout: function () {
            axios.get('../../route/route.php?action=logout')
                .then(function (response) {
                    if (response.data !== "") {
                        if (response.data.error) {
                            groupManagerModule.errorMessage = response.data.error;
                        } else {
                            if (response.data.userId !== "") {
                                groupManagerModule.sessionUser.userId = "";
                            } else {
                                groupManagerModule.errorMessage = 'Undefined login error occurs. Try again later.';
                            }
                        }
                    }
                });
        },
        flip: function (which, e) {
            e.preventDefault();
            if (which !== this.active) {
                this.active = which;
            }
        },
        close: function (e) {
            e.preventDefault();
            if (e.target === this.$el) {
                this.active = null;
            }
        },
        clearUserRegistration: function () {
            signInUpModal.userRegistration = {action: "", username: "", email: "", password: ""}
        },
        clearUserLogin: function () {
            signInUpModal.userLogin = {action: "", login: "", password: ""};
        }
    }
});

var groupManagerModule = new Vue({
    el: '#root',
    data: {
        showingAddModal: false,
        showingEditModal: false,
        showingDeleteModal: false,
        errorMessage: "",
        successMessage: "",
        authenticated: true,
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
        getAllGroups: function () {
            axios.get('../../route/route.php?action=listAllGroups')
                .then(function (response) {
                    if (response.data !== "") {
                        if (response.data.error) {
                            groupManagerModule.errorMessage = response.data.error;
                        } else {
                            groupManagerModule.groups = response.data;
                        }
                    }
                });
        },
        saveGroup: function () {
            groupManagerModule.newGroup.id_user = groupManagerModule.sessionUser.userId; // Here must to be a php user's id !!!
            groupManagerModule.newGroup.action = "saveGroup";
            axios.post('/route/route.php', JSON.stringify(groupManagerModule.newGroup))
                .then(function (response) {
                    console.log(response.data);
                    groupManagerModule.clearGroup();
                    if (response.data !== "") {
                        if (response.data.error) {
                            groupManagerModule.errorMessage = response.data.error;
                        } else {
                            groupManagerModule.getAllGroups();
                        }
                    } else {
                        groupManagerModule.errorMessage = 'Something goes wrong. The server response is empty.';
                    }
                });
        },
        updateGroup: function () {
            groupManagerModule.clickedGroup.id_user = groupManagerModule.sessionUser.userId; // Here must to be a php user's id !!!
            groupManagerModule.clickedGroup.action = "saveGroup";
            axios.post('/route/route.php', JSON.stringify(groupManagerModule.clickedGroup))
                .then(function (response) {
                    console.log(response.data);
                    groupManagerModule.clearGroup();
                    if (response.data !== "") {
                        if (response.data.error) {
                            groupManagerModule.errorMessage = response.data.error;
                        } else {
                            groupManagerModule.getAllGroups();
                        }
                    } else {
                        groupManagerModule.errorMessage = 'Something goes wrong. The server response is empty.';
                    }
                });
        },
        deleteGroup: function () {
            groupManagerModule.clickedGroup.id_user = groupManagerModule.sessionUser.userId;
            groupManagerModule.clickedGroup.action = "replaceGroup";
            axios.post('/route/route.php', JSON.stringify(groupManagerModule.clickedGroup))
                .then(function (response) {
                    console.log(response.data);
                    groupManagerModule.clearGroup();
                    if (response.data !== "") {
                        if (response.data.error) {
                            groupManagerModule.errorMessage = response.data.error;
                        } else {
                            groupManagerModule.successMessage = response.data.success;
                            groupManagerModule.getAllGroups();
                        }
                    } else {
                        groupManagerModule.errorMessage = 'Something goes wrong. The server response is empty.';
                    }
                });
        },
        selectGroup: function (group) {
            groupManagerModule.clickedGroup = group;
        },
        toFormData: function (obj) {
            var formData = new FormData(groupManagerModule.newGroup);
            for (var key in obj) {
                formData.append(key, obj[key]);
            }
            return formData;
        },
        clearMessage: function () {
            groupManagerModule.errorMessage = "";
            groupManagerModule.successMessage = "";
        },
        clearSessionUser: function () {
            groupManagerModule.sessionUser.userId = "";
        },
        clearGroup: function () {
            groupManagerModule.newGroup = {id_user: "", title: "", imageLink: "", action: ""};
        }
    }
});