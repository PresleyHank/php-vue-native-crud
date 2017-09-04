<template>
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
                    <input type="hidden" name="id_user" value="" v-model="newGroup.id_user"/>
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
</template>