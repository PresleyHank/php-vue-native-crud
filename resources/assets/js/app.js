var header = new Vue({
    el: '#fake-nav',
    data: {
        authenticated: false
    },
    methods: {
        open: function (which, e) {
            e.preventDefault();
            signInUpModal.active = which;
        },
        logout: function () {
            signInUpModal.logout();
        }
    }
});

var signInUpModal = new Vue({
    el: '#login-modal',
    data: {
        active: null,
        errors: [],
        modalSuccessMessage: "",
        sessionUserId: "",
        userLogin: {action: "", usernameOrEmail: "", password: ""},
        userLogout: {action: "", userId: ""},
        userRegistration: {action: "", username: "", email: "", password: "", secondaryPassword: ""}
    },
    methods: {
        login: function () {
            signInUpModal.userLogin.action = "login";
            axios.post("../../route/route.php", JSON.stringify(signInUpModal.userLogin))
                .then(function (response) {
                    signInUpModal.clearUserLogin();
                    if (response.data !== "") {
                        console.log(response);
                        if (response.data.error) {
                            signInUpModal.errors = JSON.parse(response.data.error);
                        } else if (response.data.userId) {
                            header.authenticated = true;

                            signInUpModal.sessionUserId = response.data.userId;
                            signInUpModal.modalSuccessMessage = "Success login! Greetings!";

                            groupManagerModule.sessionUser.userId = response.data.userId;
                        }
                        else {
                            signInUpModal.modalErrorMessage = "Undefined login error occurs. Try again later.";
                        }
                    }
                });
        },
        registration: function () {
            signInUpModal.userRegistration.action = "registration";
            axios.post("../../route/route.php", JSON.stringify(signInUpModal.userRegistration))
                .then(function (response) {
                    signInUpModal.clearUserRegistration();
                    if (response.data !== "") {
                        console.log(response);
                        if (response.data.error) {
                            signInUpModal.errors = JSON.parse(response.data.error);
                        } else if (response.data.userId) {
                            header.authenticated = true;

                            signInUpModal.sessionUserId = response.data.userId;
                            signInUpModal.modalSuccessMessage = "Successful registration! Greetings!";

                            groupManagerModule.sessionUser.userId = response.data.userId;
                        }
                        else {
                            signInUpModal.modalErrorMessage = "Undefined registration error occurs. Try again later.";
                        }
                    }
                });
        },
        logout: function () {
            signInUpModal.userLogout.userId = signInUpModal.sessionUserId;
            signInUpModal.userLogout.action = "logout";
            axios.post("../../route/route.php", JSON.stringify(signInUpModal.userLogout))
                .then(function (response) {
                    signInUpModal.clearUserLogout();
                    if (response.data !== "") {
                        if (response.data.error) {
                            groupManagerModule.errorMessage = response.data.error;
                        } else {
                            if (response.data.success) {
                                groupManagerModule.sessionUser.userId = "";
                                header.authenticated = false;
                            } else {
                                groupManagerModule.errorMessage = "Undefined login error occurs. Try again later.";
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
            signInUpModal.userRegistration = {action: "", username: "", email: "", password: "", secondaryPassword: ""};
        },
        clearUserLogin: function () {
            signInUpModal.userLogin = {action: "", usernameOrEmail: "", password: ""};
        },
        clearUserLogout: function () {
            signInUpModal.userLogout = {action: "", userId: ""};
        },
        clearMessages: function () {
            signInUpModal.modalSuccessMessage = "";
            signInUpModal.errors = [];
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
        sessionUser: {userId: ""},
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
            groupManagerModule.newGroup.id_user = groupManagerModule.sessionUser.userId;
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