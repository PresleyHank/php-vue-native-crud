var app = new Vue({
    el: '#root',
    data: {
        showingAddModal: false,
        showingEditModal: false,
        showingDeleteModal: false,
        errorMessage: "",
        successMessage: "",
        groups: []
    },
    mounted: function () {
        console.log('mounted!');
        this.getAllGroups();
    },
    methods: {
        getAllGroups: function () {
            axios.get('../../route/route.php?action=listAllGroups')
                .then(function (response) {
                    console.log(response.data);
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

        }
    }
});