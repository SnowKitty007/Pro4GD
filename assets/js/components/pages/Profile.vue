<template>
    <div id="root">
    <div v-if="profileUser != null && createdUserString != null">

        <div class="container-fluid">

            <!-- upper profile part -->
            <div class="row bgDarkGrey fontWhite" id="userInfoCnt">
                <div class="col-lg-4" id="userPicCnt">
                    <img class="userPicture" v-bind:src="profileUser.userPic">
                </div>

                <div id="userCnt" class="col-lg-5">
                    <h1>{{ profileUser.firstname}} {{ profileUser.lastname }}</h1>
                    <h2> {{ profileUser.username }}</h2>
                    <p> Rang: {{ profileUser.level }}</p>
                    <p>Sprössling</p>           <!-- Rang Benennung: aus Lvl berechnet -->

                    <button v-if="profileUser==null" id="userButton">Hinzufügen <svg><use href="#plusOnly"></use></svg></button>
                    <button v-else-if="profileUser!=null && editProfile!=true" id="userButton"  v-on:click="changeProfile">Profil bearbeiten</button>
                    <button v-else-if="profileUser!=null && editProfile==true" id="userButton" v-on:click="saveProfile">Profil speichern</button>
                </div>

                <div id="userDataCnt" class="col-lg-3">
                    <ul class="noListStyle">
                        <li>
                            <svg><use href="#profile"></use></svg>
                            seit {{ createdUserString }} Mitglied
                        </li>
                        <li>
                            <svg><use href="#locationPin"></use></svg>
                            {{ profileUser.country }}
                        </li>
                        <li>
                            <svg><use href="#birthday"></use></svg>
                            {{ userAge }}
                        </li>
                        <li>
                            <svg><use href="#calendar"></use></svg>
                            {{ birthdayString }}
                        </li>
                    </ul>
                </div>
            </div>

            <!--lower profile part-->
            <div class="row marginLeftRight">
                <div class="col-lg-8">
                    <div class="left">
                        <div id="description">
                            <h3 class="h3Margin">Über {{ profileUser.username }} </h3>
                            <div class="greenLine"></div>
                            <p v-if="editProfile">
                                <textarea class="smallInput" @blur="saveProfile" v-model="profileUser.description"></textarea>
                            </p>
                            <p v-if="!editProfile">
                                {{ profileUser.description }}
                            </p>

                        </div>

                        <div>
                            <h3 class="h3Margin">Freunde</h3>
                            <div class="greenLine"></div>

                            <div class="containerfluid">

                                <div v-for="(friend, index) in profileUserFriends" class="row friends bgWhiteGrey dropShadow borderRad10">

                                    <div class="col-lg-2 friendsPicture text-center justify-content-center">
                                        <!-- change to friends.userPic when friends are implemented correctly-->
                                        <img class="smallUserPics" v-bind:src="friend.userPic">
                                    </div>

                                    <div class="col-lg-6 friendsInfo selfAlignCenter">
                                        <ul class="noListStyle">
                                            <li>{{ friend.firstName }} {{ friend.lastname }}</li> <!-- {{ profileUser.username }}-->
                                            <li>{{ friend.username }}</li>
                                            <li>Rang: {{ friend.level }}</li> <!-- Rang Benennung: aus Lvl berechnet -->
                                        </ul>
                                    </div>

                                    <div class="col-lg-4 text-right selfAlignCenter friendsButtons justify-content-center">
                                        <span class="userProfileButton">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 455.4 455.4" style="enable-background:new 0 0 455.4 455.4;" xml:space="preserve">
<path class="path1" d="M405.5,412.8c-69.7,56.9-287.3,56.9-355.6,0c-69.7-56.9-62.6-300.1,0-364.1s293-64,355.6,0S475.2,355.9,405.5,412.8z"/><g><g><path class="path2" d="M229,16.7c-61.1,0-110.9,49.8-110.9,110.9S167.9,238.5,229,238.5s110.9-49.8,110.9-110.9S290.1,16.7,229,16.7z"/></g></g><path class="path2" d="M366,304.9c-30.4-30.8-70.6-47.8-113.3-47.8h-49.3c-42.7,0-83,17-113.3,47.8c-26,26.4-42,60.2-45.9,96.5c1.9,1.9,3.8,3.7,5.8,5.3c68.3,56.9,285.9,56.9,355.6,0c2.2-1.8,4.3-3.7,6.3-5.9C407.8,364.8,391.9,331.2,366,304.9z"/></svg>
                                        </span>
                                        <span class="addUserButton">
                                            <span class="addUserButton">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 455.4 455.4" style="enable-background:new 0 0 455.4 455.4;" xml:space="preserve"><path class="path1" d="M405.5,412.8c-69.7,56.9-287.3,56.9-355.6,0c-69.7-56.9-62.6-300.1,0-364.1s293-64,355.6,0S475.2,355.9,405.5,412.8z"/><path class="path2" d="M362.8,227.9c0,14.2-11.4,25.6-25.6,25.6h-85.3v85.3c0,14.2-11.4,25.6-25.6,25.6s-25.6-11.4-25.6-25.6v-85.3
	h-85.3c-14.2,0-25.6-11.4-25.6-25.6s11.4-25.6,25.6-25.6h85.3v-85.3c0-14.2,11.4-25.6,25.6-25.6s25.6,11.4,25.6,25.6v85.3h85.3
	C351.4,202.3,362.8,213.7,362.8,227.9z"/></svg>
                            </span>
                                        </span>
                                    </div>
                                </div> <!--v-for ends here-->

                                <div class="row d-flex justify-content-end">
                                    <button class="buttonDarkGreen">Alle Freunde</button>
                                </div>

                            </div>
                        </div> <!-- freinds part end-->

                        <div id="garden">
                            <h3 class="h3Margin">{{ profileUser.username }}s Garten</h3>
                            <div class="greenLine"></div>
                        </div>


                        <div class="container-fluid">
                            <div class="row">

                                <div class="col-lg-6">
                                    <div v-for="(userplant, index) in profileUserplants" class="container-fluid">
                                        <div v-if="index % 2 == 0 || index == 0" class="row paddingNormalize">
                                            <router-link :to="'/userplant/' + userplant.id" class="container-fluid">
                                                <div class="container-fluid plantsProfile dropShadow bgWhiteGrey ">
                                                    <div class="row">
                                                        <div class="col-lg-8 selfAlignCenter plantsProfileInfoCol">
                                                            <ul class="noListStyle">
                                                                <li>{{ userplant.name }}</li>
                                                                <li>{{ userplant.location }}</li>
                                                                <li>level erstellen</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-4 plantsProfileImgCol text-right align-self-center">
                                                            <img class="plantsProfileImg" v-bind:src="'../' + userplant.plant.icon">
                                                        </div>
                                                    </div>
                                                </div>
                                            </router-link>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div v-for="(userplant, index) in profileUserplants" class="container-fluid">
                                        <div v-if="index % 2 !== 0" class="row paddingNormalize">
                                            <router-link :to="'/userplant/' + userplant.id" class="container-fluid">
                                                <div class="container-fluid plantsProfile dropShadow bgWhiteGrey">
                                                    <div class="row">
                                                        <div class="col-lg-8 selfAlignCenter plantsProfileInfoCol">
                                                            <ul class="noListStyle">
                                                                <li>{{ userplant.name }}</li>
                                                                <li>{{ userplant.location }}</li>
                                                                <li>level erstellen</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-4 plantsProfileImgCol text-rigth align-self-center">
                                                            <img class="plantsProfileImg" v-bind:src="'../' + userplant.plant.icon">
                                                        </div>
                                                    </div>
                                                </div>
                                            </router-link>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div id="Besuchernachrichten">
                            <h3 class="h3Margin">Besuchernachrichten</h3>
                            <div class="greenLine"></div>
                            <div>Keine Besuchernachrichten vorhanden</div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="rightBoxes">
                        <h4 class="bgLightGrey rightBoxesPadding h4Box">Erungenschaften</h4>
                        <p class="rightBoxesPadding">Wird nur gezeigt wenn welche vorhanden sind</p>    <!-- Besuchernachrichten auslesen -->
                    </div>

                    <div class="rightBoxes">
                        <h4 class="bgLightGrey rightBoxesPadding h4Box">Forenposts</h4>
                        <p class="rightBoxesPadding">Liste an Forenposts</p> <!-- wird aus dem Forum ausgelesen -->
                    </div>
                </div>

            </div>

        </div>


        <div style="display: none;">
            <!-- plus symbole -->
            <svg height="448pt"  width="448pt" xmlns="http://www.w3.org/2000/svg">
                <symbol id="plusOnly" viewBox="0 0 448 448">
                    <path d="m408 184h-136c-4.417969 0-8-3.582031-8-8v-136c0-22.089844-17.910156-40-40-40s-40 17.910156-40 40v136c0 4.417969-3.582031 8-8 8h-136c-22.089844 0-40 17.910156-40 40s17.910156 40 40 40h136c4.417969 0 8 3.582031 8 8v136c0 22.089844 17.910156 40 40 40s40-17.910156 40-40v-136c0-4.417969 3.582031-8 8-8h136c22.089844 0 40-17.910156 40-40s-17.910156-40-40-40zm0 0"/></symbol></svg>
            <!-- profile symbole -->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
          xml:space="preserve">
    <symbol id="profile" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;">
    <g> <g> <path d="M256,0c-74.4,0-135,60.6-135,135s60.6,135,135,135s135-60.6,135-135S330.4,0,256,0z"/></g></g>
    <g><g><path d="M424,358.2c-37-37.5-86-58.2-138-58.2h-60c-52,0-101,20.7-138,58.2C51.3,395.5,31,444.8,31,497c0,8.3,6.7,15,15,15h420
			c8.3,0,15-6.7,15-15C481,444.8,460.7,395.5,424,358.2z"/></g></g>
    </symbol></svg>
            <!-- location pin -->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         style="enable-background:new 0 0 512 512;" xml:space="preserve">
    <symbol id="locationPin" viewBox="0 0 512 512" >
    <g><g><path d="M256,0C153.755,0,70.573,83.182,70.573,185.426c0,126.888,165.939,313.167,173.004,321.035
			c6.636,7.391,18.222,7.378,24.846,0c7.065-7.868,173.004-194.147,173.004-321.035C441.425,83.182,358.244,0,256,0z M256,278.719
			c-51.442,0-93.292-41.851-93.292-93.293S204.559,92.134,256,92.134s93.291,41.851,93.291,93.293S307.441,278.719,256,278.719z"/>
    </g></g></symbol></svg>
            <!-- birthday symbole -->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     style="enable-background:new 0 0 469.333 469.333;" xml:space="preserve">
    <symbol id="birthday" viewBox="0 0 469.333 469.333" >
    <g><g><g>
   <path d="M234.56,128c23.573,0,42.667-19.093,42.667-42.667c0-8-2.24-15.573-6.08-21.973L234.56,0l-36.587,63.36
	c-3.84,6.4-6.08,13.973-6.08,21.973C191.893,108.907,210.987,128,234.56,128z"/>
    <path d="M362.56,192L362.56,192H255.893v-42.667h-42.667V192H106.56c-35.307,0-64,28.693-64,64v32.853
	c0,23.04,18.773,41.813,41.813,41.813c11.2,0,21.653-4.373,29.547-12.267l45.653-45.547l45.547,45.44
	c15.787,15.787,43.307,15.787,59.093,0l45.653-45.44l45.547,45.44c7.893,7.893,18.347,12.267,29.547,12.267
	c23.04,0,41.813-18.773,41.813-41.813V256C426.56,220.693,397.867,192,362.56,192z"/>
    <path d="M332.587,341.013L332.587,341.013l-22.933-22.933l-23.04,22.933c-27.84,27.84-76.48,27.84-104.32,0L159.36,318.08
	l-23.04,22.933c-13.76,13.973-32.213,21.653-51.947,21.653c-15.467,0-29.867-4.907-41.813-13.12V448
	c0,11.733,9.6,21.333,21.333,21.333h341.333c11.733,0,21.333-9.6,21.333-21.333v-98.453c-11.947,8.213-26.24,13.12-41.813,13.12
	C365.013,362.667,346.56,354.987,332.587,341.013z"/></g></g></g>
    </symbol></svg>
            <!-- calender symbole -->
            <svg height="512pt"  width="512pt" xmlns="http://www.w3.org/2000/svg">
                <symbol id="calendar" viewBox="0 0 512 512"><path d="m80 320h53.332031c8.832031 0 16-7.167969 16-16v-53.332031c0-8.832031-7.167969-16-16-16h-53.332031c-8.832031 0-16 7.167969-16 16v53.332031c0 8.832031 7.167969 16 16 16zm0 0"/><path d="m80 448h53.332031c8.832031 0 16-7.167969 16-16v-53.332031c0-8.832031-7.167969-16-16-16h-53.332031c-8.832031 0-16 7.167969-16 16v53.332031c0 8.832031 7.167969 16 16 16zm0 0"/><path d="m229.332031 320h53.335938c8.832031 0 16-7.167969 16-16v-53.332031c0-8.832031-7.167969-16-16-16h-53.335938c-8.832031 0-16 7.167969-16 16v53.332031c0 8.832031 7.167969 16 16 16zm0 0"/><path d="m229.332031 448h53.335938c8.832031 0 16-7.167969 16-16v-53.332031c0-8.832031-7.167969-16-16-16h-53.335938c-8.832031 0-16 7.167969-16 16v53.332031c0 8.832031 7.167969 16 16 16zm0 0"/><path d="m378.667969 320h53.332031c8.832031 0 16-7.167969 16-16v-53.332031c0-8.832031-7.167969-16-16-16h-53.332031c-8.832031 0-16 7.167969-16 16v53.332031c0 8.832031 7.167969 16 16 16zm0 0"/><path d="m448 64h-21.332031v-42.667969c0-11.773437-9.558594-21.332031-21.335938-21.332031h-21.332031c-11.777344 0-21.332031 9.558594-21.332031 21.332031v42.667969h-213.335938v-42.667969c0-11.773437-9.554687-21.332031-21.332031-21.332031h-21.332031c-11.777344 0-21.335938 9.558594-21.335938 21.332031v42.667969h-21.332031c-35.285156 0-64 28.714844-64 64v320c0 35.285156 28.714844 64 64 64h384c35.285156 0 64-28.714844 64-64v-320c0-35.285156-28.714844-64-64-64zm21.332031 384c0 11.753906-9.578125 21.332031-21.332031 21.332031h-384c-11.753906 0-21.332031-9.578125-21.332031-21.332031v-233.8125h426.664062zm0 0"/>
                </symbol></svg>
        </div>

    </div>
    </div>
</template>

<script>
    class ProfileComment {
        constructor(date, user, message) {
            this.date = date;
            this.user = user;
            this.message = message;
        }

        get date() { return this.date; }
        get user() { return this.user; }
        get message() { return this.message; }
    }


    export default {
        name: "Profile",
        data: function() {
            return {
                profileUser: null,              // object for user
                profileUserplants: null,        // object for userplants
                profileUserFriends: null,

                createdUserString: null,        // date objects and age calculated from date objects
                birthdayString: null,
                userAge: null,

                editProfile: false,             // bool if edit profile is active or not
                userTemp: null,
            }
        },

        mounted: function(){
            //user
            this.$http.get('/api/profile/' + this.$route.params.username)
                .then(response => {
                    this.profileUser = response.data;

                    /*save the created date as string*/
                    this.createdUserString = this.profileUser.dateCreated.date.substr(8,2)
                        + "." + this.profileUser.dateCreated.date.substr(5,2)
                        + "." + this.profileUser.dateCreated.date.substr(0,4);

                    /*save the birtday as string*/
                    this.birthdayString = this.profileUser.dateBirth.date.substr(8,2)
                        + "." + this.profileUser.dateBirth.date.substr(5,2)
                        + "." + this.profileUser.dateBirth.date.substr(0,4);

                    /*calculate the age*/
                    let year = Number(this.profileUser.dateBirth.date.substr(0,4));
                    let month = Number(this.profileUser.dateBirth.date.substr(5,2));
                    let day = Number(this.profileUser.dateBirth.date.substr(8,2));
                    let today = new Date();
                    let age = today.getFullYear() - year;
                    if(today.getMonth() < month || (today.getMonth() == month && today.getDate() < day)) {
                        age--;
                    }
                    this.userAge = age.toString();

                })
                .catch(error => {
                    //alert(error);
                    this.getError(error);
                });


            //userplants
            this.$http.get('/api/profile/' + this.$route.params.username + '/userplants')
                .then(response => {
                    this.profileUserplants = response.data;
                })
                    .catch(error => {
                        this.getError(error);
                });

            //freinds
            this.$http.get('/api/profile/' + this.$route.params.username + '/friends')
                .then(response => {
                    this.profileUserFriends = response.data;
                })
                .catch(error => {
                    this.getError(error);
                })
        },

        methods: {

            changeProfile: function() {
                this.editProfile = true;

                /*this.$nextTick(function() {
                    this.$refs.descriptionInput.select();
                })*/
            },

            saveProfile: function() {
                this.$http.put('/api/profile/' + this.$route.params.username + '/setDescription', this.profileUser.description)
                    .then(response => {
                        this.profileUser.descriptioin = response.data;
                    })
                    .catch(error => {
                        getError(error);
                    });

                this.editProfile = false;
            },

            getError(error) {
                console.log(error);

                let element = document.getElementById("root");
                let div = document.createElement("div");
                div.setAttribute('class', 'text-center errorMsg');

                let p1 = document.createElement("p");
                p1.textContent = "Ups. An error occured.";
                let p2 = document.createElement("p");
                p2.textContent = error;

                element.appendChild(div);
                div.appendChild(p1);
                div.appendChild(p2);
            }
        }
    }
</script>

<style scoped>
    .edit { display: none; }

    /* trigger fields with class editProfile*/
    .smallInput {
        display: block;
        width: 100%;
        height: 200px;
        border: 1px solid #97B753;
        background-color: #F5F5F5;
    }
</style>