<template>
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
</template>